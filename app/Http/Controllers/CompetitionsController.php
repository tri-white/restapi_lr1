<?php

namespace App\Http\Controllers;

use App\Models\Competitions;
use App\Http\Requests\StoreCompetitionsRequest;
use App\Http\Requests\UpdateCompetitionsRequest;

class CompetitionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $competitions = Competitions::all();

        return $competitions;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('competitions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompetitionsRequest $request)
    {
        $competition = Competitions::create($request->validated());

            return $competition;

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $competition= Competitions::findOrFail($id);
        return $competition;
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $competition = Competitions::findOrFail($id);
        return view('competitions.edit',['competition'=>$competition]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompetitionsRequest $request, $id)
    {
        $competition = Competitions::findOrFail($id);
        $competition->update($request->validated());
            return $competition;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $competition = Competitions::findOrFail($id);
        $competition->delete();
        return response()->json(['message'=>'deleted'],200);
    }
}
