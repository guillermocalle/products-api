<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiResponse;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $supplier = Supplier::all();
        return Supplier::with('products')->get();

        // $data = [
        //   'products' => $products,
        //   'status' => 200
        // ];

        // return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

      try {
        $request->validate([
          'name' => 'required|unique:suppliers',
          'phone' => 'required',
          'email' => 'email',
          'products' => 'array',
          'products.*.product_id' => 'exists:products,id'
        ]);

        $supplier = Supplier::create($request->all());
        
        if (!empty($request['products'])) {
          $supplier->product()->attach($request['products']);
        }

        return ApiResponse::success('Proveedor creado correctamente', 201, $supplier);

      } catch(ValidationException $e) {
        return ApiResponse::error('Error de validacion: '.$e->getMessage(), 422);
      }

      // $validator = Validator::make($request->all(), [
      //   'name' => 'required|max:255',
      //   'phone' => 'required',
      //   'email' => 'email',
      //   'products' => 'array',
      //   'products.*.product_id' => 'exists:products,id'
      // ]);

      // if ($validator->fails()) {
      //   $data = [
      //     'message' => 'Error en la validación de datos',
      //     'errors' => $validator->errors(),
      //     'status' => 400
      //   ];
      //   return response()->json($data, 400);
      // }

      // $supplier = Supplier::create([
      //   'name' => $request->name,
      //   'phone' => $request->phone,
      //   'email' => $request->email,
      //   'product_id' => $request->product_id
      // ]);

      // $supplier = Supplier::create($data);

      // if (!empty($data['products'])) {
      //   $supplier->products()->attach($data['products']);
      // }

      // if (!$supplier) {
      //   $data = [
      //     'message' => 'Error al crear el proveedor',
      //     'status' => 500
      //   ];

      //   return response()->json($data, 500);
      
      // }

      // $data = [
      //   'supplier' => $supplier,
      //   'status' => 201
      // ];

      // return response()->json($data, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
