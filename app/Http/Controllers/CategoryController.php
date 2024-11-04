<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
      $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return response()->json($this->categoryService->getAllCategories(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = $this->categoryService->createCategory($request->validated());
      return response()->json($category, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json($this->categoryService->getCategoryById($id), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
      $category = $this->categoryService->updateCategory($id, $request->validated());
      return response()->json($category, 200);
    }
}
