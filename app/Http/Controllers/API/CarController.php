<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;


class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cars = Car::query()->get();

        return response(['cars' => $cars]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            $car = $request->all();
            Car::query()->insert($car);
        } catch (\Exception  $e) {
            return response(['error' => $e->getMessage()]);
        }
        return response(['message', 'car added']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$cars = Car::query()>where('id', '=', $id)->get();
        //$car = Car::query()->firstOrFail('id', $id)->get();
        try {
            $car = Car::query()->findOrFail($id)->get();
        } catch (\Exception  $e) {
            return response(['error' => $e->getMessage()]);
        }
        return $car;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $car = $request->all();
            Car::query()->firstOrFail($id)->insert($car);
        } catch (\Exception  $e) {
            return response(['error' => $e->getMessage()]);
        }
        return response(['message', 'car updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $car = Car::query()->findOrFail($id)->delete();
        } catch (\Exception  $e) {
            return response(['error' => $e->getMessage()]);
        }
        return response(['message', 'car deleted']);
    }
}
