<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    public function index()
    {
        $type = Type::get();

        return response()->json([
            'data' => $type
        ], 200);
    }

    public function show($id)
    {
        $data = Type::where('id' ,$id)->first();

        return response()->json([
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'type' => 'required',
            'type_price' => 'required'
        ]);

        if($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }

        $type = Type::create([
            'type' => $request->type,
            'type_price' => $request->type_price
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $type
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            'type' => 'required',
            'type_price' => 'required'
        ]);

        if($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }

        $type = Type::where('id', $id)->first();
        if(!$type) {
            return response()->json([
                'status' => 'not found'
            ], 403);
        }

        $type->type = $request->type;
        $type->type_price = $request->type_price;
        $type->save();

        return response()->json([
            'status' => 'success',
            'data' => $type
        ], 201);
    }
}
