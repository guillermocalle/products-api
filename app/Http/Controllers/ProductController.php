<?php

namespace App\Http\Controllers;

use App\Services\ProductService;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
      $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->productService->getAllProducts(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
      $product = $this->productService->createProduct($request->validated());
      return response()->json($product, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      return response()->json($this->productService->getProductById($id), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
      $product = $this->productService->updateProduct($id, $request->validated());
      return response()->json($product, 200);
    }
}
