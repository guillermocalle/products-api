<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        $data = [
          'products' => $products,
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
          'name' => 'required|max:255',
          'price' => 'required|numeric|min:0',
          'stock' => 'required|integer|min:0',
          'category_id' => 'required|exists:categories,id'
        ]);

        if ($validator->fails()) {
          $data = [
            'message' => 'Error en la validacion de datos',
            'errors' => $validator->errors(),
            'status' => 400
          ];
          return response()->json($data, 400);
        }

        $product = Product::create([
          'name' => $request->name,
          'price' => $request->price,
          'stock' => $request->stock,
          'category_id' => $request->category_id
        ]);

        if (!$product) {
          $data = [
            'message' => 'Error al crear el producto',
            'status' => 500
          ];
          return response()->json($data, 500);
        }

        $data = [
          'product' => $product,
          'status' => 201
        ];

        return response()->json($data, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      $product = Product::find($id);

      if (!$product) {
        $data = [
          'message' => 'Producto no encontrado',
          'status' => 404
        ];
        return response()->json($data, 404);
      }

      $data = [
        'product' => $product,
        'status' => 200
      ];
      return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      $product = Product::find($id);

      if (!$product) {
        $data = [
          'message' => 'Producto no encontrado',
          'status' => 404
        ];
        return response()->json($data, 404); 
      }

      $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'category_id' => 'required|exists:categories,id'
      ]);

      if ($validator->fails()) {
        $data = [
          'message' => 'Error en la validacion de los datos',
          'errors' => $validator->errors(),
          'status' => 400
        ];
        return response()->json($data, 400);
      }

      $product->name = $request->name;
      $product->price = $request->price;
      $product->stock = $request->stock;
      $product->category_id = $request->category_id;

      $product->save();

      $data = [
        'message' => 'El producto ha sido actualizado',
        'product' => $product,
        'status' => 200
      ];

      return response()->json($data, 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $product = Product::find($id);

      if (!$product) {
        $data = [
          'message' => 'Producto no encontrado',
          'status' => 404
        ];
        return response()->json($data, 404);
      }

      $product->delete();

      $data = [
        'message' => 'El producto ha sido eliminado',
        'status' => 200
      ];
      return response()->json($data, 200);

    }
}
