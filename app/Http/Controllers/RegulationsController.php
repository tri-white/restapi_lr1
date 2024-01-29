<?php

namespace App\Http\Controllers;

use App\Models\Regulations;
use App\Http\Requests\StoreRegulationsRequest;
use App\Http\Requests\UpdateRegulationsRequest;
use Illuminate\Http\Request;
use App\Filters\RegulationsFilter;
use App\Http\Resources\RegulationResource;
use App\Http\Resources\RegulationCollection;

class RegulationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new RegulationsFilter();
        $queryItems = $filter->transform($request); // ['column', 'operator', 'value']


        $regulations = Regulations::where($queryItems);


        return new RegulationCollection($regulations->paginate()->appends($request->query()));
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

        return new RegulationResource($regulation);
    }

    /**
     * Display the specified resource.
     */
    public function show(Regulations $regulation)
    {
        // $regulation= Regulations::findOrFail($regulation);
        return new RegulationResource($regulation);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Regulations $regulation)
    {
        // $regulation = Regulations::findOrFail($regulation);
        return view('regulations.edit',['regulation'=>$regulation]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegulationsRequest $request, Regulations $regulation)
    {
        // $regulation = Regulations::findOrFail($regulation);
        $regulation->update($request->validated());
            return new RegulationResource($regulation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Regulations $regulation)
    {
        // $regulation = Regulations::findOrFail($regulation);
        $regulation->delete();
        return response()->json(['message'=>'deleted'],200);
    }
}
