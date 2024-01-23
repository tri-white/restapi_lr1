<?php

namespace App\Http\Controllers;

use App\Models\Regulations;
use App\Http\Requests\StoreRegulationsRequest;
use App\Http\Requests\UpdateRegulationsRequest;

class RegulationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regulations = Regulations::all();

        return $regulations;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('regulations.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegulationsRequest $request)
    {
        $regulation = Regulations::create($request->validated());

        return $regulation;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $regulation= Regulations::findOrFail($id);
        return $regulation;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $regulation = Regulations::findOrFail($id);
        return view('regulations.edit',['regulation'=>$regulation]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegulationsRequest $request, $id)
    {
        $regulation = Regulations::findOrFail($id);
        $regulation->update($request->validated());
            return $regulation;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $regulation = Regulations::findOrFail($id);
        $regulation->delete();
        return response()->json(['message'=>'deleted'],200);
    }
}
