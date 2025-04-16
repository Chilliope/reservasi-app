<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required',
            'gender' => 'required',
            'number' => 'required',
            'type' => 'required',
            'price' => 'required',
            'order_date' => 'required',
            'duration' => 'required',
            'is_breakfast' => 'required',
            'total' => 'required'
        ]);

        if($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }

        $order = Order::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'number' => $request->number,
            'type' => $request->type,
            'price' => $request->price,
            'order_date' => $request->order_date,
            'duration' => $request->duration,
            'is_breakfast' => $request->is_breakfast,
            'total' => $request->total
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $order
        ], 201);
    }
}
