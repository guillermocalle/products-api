<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        $data = [
          'categories' => $categories,
          'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'name' => 'required|max:255'
        ]);

        if ($validator->fails()) {
          $data = [
            'message' => 'Error en la validacion de datos',
            'errors' => $validator->errors(),
            'status' => 400
          ];
          return response()->json($data, 400);
        }

        $category = Category::create([
          'name' => $request->name
        ]);

        if (!$category) {
          $data = [
            'message' => 'Error al crear la categoria',
            'status' => 500
          ];
          return response()->json($data, 500);
        }

        $data = [
          'category' => $category,
          'status' => 201
        ];

        return response()->json($data, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
          $data = [
            'message' => 'Categoria no encontrada',
            'status' => 404
          ];
          return response()->json($data, 404);
        }

        $data = [
          'category' => $category,
          'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      $category = Category::find($id);
      
      if (!$category) {
        $data = [
          'message' => 'Categoria no encontrada',
          'status' => 404
        ];
        return response()->json($data, 404);
      }
        
      $validator = Validator::make($request->all(), [
        'name' => 'required|max:255'
      ]);

      if ($validator->fails()) {
        $data = [
          'message' => 'Error en la validacion de los datos',
          'errors' => $validator->errors(),
          'status' => 400
        ];

        return response()->json($data, 400);
      }
          
      $category->name = $request->name;

      $category->save();

      $data = [
        'message' => 'La categoria ha sido actualizada',
        'category' => $category,
        'status' => 200
      ];

      return response()->json($data, 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
          $data = [
            'message' => 'Categoria no encontrada',
            'status' => 404
          ];
          return response()->json($data, 404);
        }

        $category->delete();

        $data = [
          'message' => 'La categoria ha sido eliminada',
          'status' => 200
        ];
        return response()->json($data, 200);

    }
}
