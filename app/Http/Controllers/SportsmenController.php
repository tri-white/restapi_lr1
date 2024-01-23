<?php

namespace App\Http\Controllers;

use App\Models\Sportsmen;
use App\Http\Requests\StoreSportsmenRequest;
use App\Http\Requests\UpdateSportsmenRequest;

class SportsmenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sportsmen = Sportsmen::all();

        return $sportsmen;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sportsmen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSportsmenRequest $request)
    {
        $sportsmen = Sportsmen::create($request->validated());

        return $sportsmen;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sportsmen= Sportsmen::findOrFail($id);
        return $sportsmen;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sportsmen = Sportsmen::findOrFail($id);
        return view('sportsmens.edit',['sportsmen'=>$sportsmen]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSportsmenRequest $request, $id)
    {
        $sportsmen = Sportsmen::findOrFail($id);
        $sportsmen->update($request->validated());
            return $sportsmen;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sportsmen = Sportsmen::findOrFail($id);
        $sportsmen->delete();
        return response()->json(['message'=>'deleted'],200);
    }
}
