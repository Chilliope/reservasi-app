<?php

namespace App\Http\Controllers;

use App\Models\Bedroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BedroomController extends Controller
{
    public function index()
    {
        $bedroom = Bedroom::with(['type'])->get();

        return response()->json([
            'data' => $bedroom
        ], 200);
    }

    public function show($id) 
    {
        $bedroom = Bedroom::where('id' ,$id)->with(['type'])->first();

        return response()->json([
            'data' => $bedroom
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'type_id' => 'required',
            'image' => 'required|mimes:png,jpg'
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

    public function update(Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            'type_id' => 'required',
            'image' => 'required|mimes:png,jpg'
        ]);

        if($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }

        $bedroom = Bedroom::where('id', $id)->first();

        if($request->file('image')) {
            Storage::delete($bedroom->image);
            $file = $request->file('image');
            $fileExt = $file->getClientOriginalExtension();
            $random = md5(uniqid(mt_rand(), true));

            $newFileName = $random . '.' . $fileExt;
            $file->move('storage/bedroom', $newFileName);
            $bedroom->image = $newFileName;
        }   

        $bedroom->type_id = $request->type_id;
        $bedroom->save();

        return response()->json([
            'status' => 'success',
            'data' => $bedroom
        ], 201);
    }
}
