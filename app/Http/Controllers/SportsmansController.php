<?php

namespace App\Http\Controllers;

use App\Models\Sportsmans;
use App\Http\Requests\StoreSportsmansRequest;
use App\Http\Requests\UpdateSportsmansRequest;
use Illuminate\Http\Request;
use App\Filters\SportsmansFilter;
use App\Http\Resources\SportsmansResource;
use App\Http\Resources\SportsmansCollection;

class SportsmansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new SportsmansFilter();
        $queryItems = $filter->transform($request); // ['column', 'operator', 'value']


        $sportsmans = Sportsmans::where($queryItems);


        return new SportsmansCollection($sportsmans->paginate()->appends($request->query()));

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sportsmans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSportsmansRequest $request)
    {
        $sportsman = Sportsmans::create($request->validated());

        return new SportsmansResource($sportsman);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sportsmans $sportsman)
    {
        // $sportsmans= Sportsmans::findOrFail($sportsmans);
        return new SportsmansResource($sportsman);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sportsmans $sportsman)
    {
        // $sportsmans = Sportsmans::findOrFail($sportsmans);
        return view('sportsmans.edit',['sportsmans'=>$sportsman]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSportsmansRequest $request, Sportsmans $sportsman)
    {
        // $sportsmans = Sportsmans::findOrFail($sportsmans);
        $sportsman->update($request->validated());
        return new SportsmansResource($sportsman);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sportsmans $sportsman)
    {
        // $sportsmans = Sportsmans::findOrFail($sportsmans);
        $sportsman->delete();
        return response()->json(['message'=>'deleted'],200);
    }
}