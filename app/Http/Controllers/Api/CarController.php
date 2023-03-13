<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Http\Requests\CarRequest;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all();

        return response()->json([
            'success' => true,
            'data' => $cars
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand' => 'required|max:255',
            'variant' => 'required|max:255',
            'license_plate' => 'required|max:255',
            'fuel_type' => 'required|max:255',
            'price' => 'required|integer',
            'sales_type' => 'required|max:255',
            'reserved' => 'nullable|boolean',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $car = Car::create($request->all());
        return response()->json([
            'success' => true,
            'data' => $car
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::find($id);

        if (!$car) {
            return response()->json([
                'success' => false,
                'message' => 'Car not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $car
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $car = Car::find($id);

        if (!$car) {
            return response()->json([
                'success' => false,
                'message' => 'Car not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'brand' => 'required|max:255',
            'variant' => 'required|max:255',
            'license_plate' => 'required|max:255',
            'fuel_type' => 'required|max:255',
            'price' => 'required|integer',
            'sales_type' => 'required|max:255',
            'reserved' => 'nullable|boolean',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }      

        $car->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $car
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Car::find($id);

        if (!$car) {
            return response()->json([
                'success' => false,
                'message' => 'Car not found'
            ], 404);
        }

        $car->delete();

        return response()->json([
            'success' => true,
            'message' => 'Car deleted successfully'
        ], 200);
    }
}