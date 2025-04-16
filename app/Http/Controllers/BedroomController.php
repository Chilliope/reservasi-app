<?php

namespace App\Http\Controllers;

use App\Models\Bedroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BedroomController extends Controller
{
    public function index()
    {
        return 'running';
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'type_id' => 'required',
            'image' => 'required'
        ]);

        if($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }

        if($request->file('image')) {
            $file = $request->file('image');
            $fileExt = $file->getClientOriginalExtension();
            $random = md5(uniqid(mt_rand(), true));

            $newFileName = $random . '.' . $fileExt;
            $file->move('storage/bedroom', $newFileName);
        }

        $bedroom = Bedroom::create([
            'type_id' => $request->type_id,
            'image' => $newFileName
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $bedroom
        ], 201);
    }
}
