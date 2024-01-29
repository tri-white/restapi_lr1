<?php

namespace App\Http\Controllers;

use App\Models\Competitions;
use App\Http\Requests\StoreCompetitionsRequest;
use App\Http\Requests\UpdateCompetitionsRequest;
use App\Filters\CompetitionsFilter;
use App\Http\Resources\CompetitionResource;
use App\Http\Resources\CompetitionCollection;
use Illuminate\Http\Request;

class CompetitionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $filter = new CompetitionsFilter();
        $queryItems = $filter->transform($request); // ['column', 'operator', 'value']

        $includeSportsmen = $request->query('includeSportsmen');

        $competitions = Competitions::where($queryItems);

        if($includeSportsmen){
            $competitions=$competitions->with('sportsmen');
        }
        return new CompetitionCollection($competitions->paginate()->appends($request->query()));
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

            return new CompetitionResource($competition);

    }

    /**
     * Display the specified resource.
     */
    public function show(Competitions $competition)
    {
        return new CompetitionResource($competition);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Competitions $competition)
    {
        // $competition = Competitions::findOrFail($competition);
        return view('competitions.edit',['competition'=>$competition]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompetitionsRequest $request, Competitions $competition)
    {
        // $competition = Competitions::findOrFail($competition);
        $competition->update($request->validated());
            return new CompetitionResource($competition);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Competitions $competition)
    {
        // $competition = Competitions::findOrFail($competition);
        $competition->delete();
        return response()->json(['message'=>'deleted'],200);
    }
}
