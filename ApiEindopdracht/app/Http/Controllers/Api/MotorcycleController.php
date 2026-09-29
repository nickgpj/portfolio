<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Motorcycle;
use App\Http\Resources\MotorcycleResource;
use Illuminate\Support\Facades\Validator;

class MotorcycleController extends Controller
{
    public function index()
    {
        $motorcycles = Motorcycle::get();
        if ($motorcycles->count() > 0) {
            return MotorcycleResource::collection($motorcycles);
        } else {
            return response()->json([
                'message' => 'No motorcycles found.'
            ], 200);
        }
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'brand' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'horsepower' => 'required|integer|min:12|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $motorcycle = Motorcycle::create($request->all());

        return response()->json([
            'message' => 'Motorcycle created successfully',
            'motorcycle' => new MotorcycleResource($motorcycle),
        ], 201);
    }

    public function show(Motorcycle $motorcycle)
    {
        return new MotorcycleResource($motorcycle);
    }

    public function update(Request $request, Motorcycle $motorcycle)
    {
        $validator = Validator::make($request->all(), [
            'brand' => 'sometimes|required|string|max:50',
            'model' => 'sometimes|required|string|max:50',
            'year' => 'sometimes|required|integer|min:1900|max:' . date('Y'),
            'horsepower' => 'sometimes|required|integer|min:12|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $motorcycle->update($request->all());

        return response()->json([
            'message' => 'Motorcycle updated successfully',
            'motorcycle' => new MotorcycleResource($motorcycle),
        ], 201);
    }

    public function destroy(Motorcycle $motorcycle)
    {
        $motorcycle->delete();

        return response()->json([
            'message' => 'Motorcycle deleted successfully',
        ], 200);
    }
}
