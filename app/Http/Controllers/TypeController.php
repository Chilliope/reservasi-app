<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
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
}
