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
    /**
 * @OA\Get(
 *      path="/api/regulations",
 *      operationId="getRegulationsList",
 *      tags={"Regulations"},
 *      summary="Get list of regulations",
 *      description="Returns list of regulations",
 *      @OA\Parameter(
 *          name="name[eq]",
 *          in="query",
 *          description="Name of the regulation (equal to the specified value)",
 *          required=false,
 *          @OA\Schema(type="string")
 *      ),
 *      @OA\Parameter(
 *          name="description[eq]",
 *          in="query",
 *          description="Description of regulation (equal to the specified value)",
 *          required=false,
 *          @OA\Schema(type="string")
 *      ),
 *      @OA\Parameter(
 *          name="gender[eq]",
 *          in="query",
 *          description="Gender of regulation (equal to the specified value)",
 *          required=false,
 *          @OA\Schema(type="string")
 *      ),
 *      @OA\Parameter(
 *          name="minimal_requirements[eq]",
 *          in="query",
 *          description="Minimal requirements for regulation (equal to the specified value)",
 *          required=false,
 *          @OA\Schema(type="string")
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *      )
 * )
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
       /**
 * @OA\Post(
 *     path="/api/regulations",
 *     summary="Adds a new regulation",
 *    tags={"Regulations"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Regulations")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *                 @OA\Schema(ref="#/components/schemas/Regulations"),
 *             @OA\Examples(example="regulation", value={
 * "data": {
*"id":1,
*"name":"et",
*"description":"Qui corporis dolores harum rerum a sunt.",
*"minimalRequirements":"alias",
*"gender":"male",
 * }
*}, summary="A regulation object."),
 *         )
 *     ),
 *      @OA\Response(
 *         response=422,
 *         description="Unprocessable request (validation failed)",
 *     )
 * )
 */
    public function store(StoreRegulationsRequest $request)
    {
        $regulation = Regulations::create($request->validated());

        return new RegulationResource($regulation);
    }

    /**
     * Display the specified resource.
     */
    /**
 * @OA\Get(
 *      path="/api/regulations/{id}",
 *      operationId="getRegulation",
 *      tags={"Regulations"},
 *      summary="Get regulation by id",
 *      description="Returns one regulation record by id if it is found",
 *      @OA\Parameter(
 *         description="Id of regulation",
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="string"),
 *         @OA\Examples(example="int", value="1", summary="An int value."),
 *     ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
  *         @OA\JsonContent(
 *                 @OA\Schema(ref="#/components/schemas/Regulations"),
 *             @OA\Examples(example="regulation", value={
                    * "data": {
*"id":1,
*"name":"et",
*"description":"Qui corporis dolores harum rerum a sunt.",
*"minimalRequirements":"alias",
*"gender":"male",
                    * }
                    *}, summary="A regulation object."),
 *         ) 
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Record not found",
 *          
 *      )
 * )
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
     /**
 * @OA\Put(
 *     path="/api/regulations/{id}",
 *     summary="Updates a regulation",
 *      tags={"Regulations"},
 * 
 *     @OA\Parameter(
 *         description="Id of regulation to update",
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="string"),
 *         @OA\Examples(example="int", value="1", summary="An int value."),
 *     ),
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Regulations")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *          @OA\JsonContent(
 *                 @OA\Schema(ref="#/components/schemas/Regulations"),
 *             @OA\Examples(example="regulation", value={
                    * "data": {
*"id":1,
*"name":"et",
*"description":"Qui corporis dolores harum rerum a sunt.",
*"minimalRequirements":"alias",
*"gender":"male",
                    * }
                    *}, summary="A regulation object."),
 *         ),
        *     ),
        *     @OA\Response(
        *         response=404,
        *         description="Regulation not found by id"
        *     )
 * )
 */
    public function update(UpdateRegulationsRequest $request, Regulations $regulation)
    {
        $regulation->update($request->validated());
            return new RegulationResource($regulation);
    }

    /**
     * Remove the specified resource from storage.
     */
    /** 
    * @OA\Delete(
        *     path="/api/regulations/{id}",
        *     summary="Deletes a regulation",
        *      tags={"Regulations"},
        * 
        *     @OA\Parameter(
        *         description="Id of regulation to delete",
        *         in="path",
        *         name="id",
        *         required=true,
        *         @OA\Schema(type="string"),
        *         @OA\Examples(example="int", value="1", summary="An int value."),
        *     ),
        *     @OA\Response(
        *         response=200,
        *         description="Regulation successfully deleted"
        *     ),
        *     @OA\Response(
        *         response=404,
        *         description="Regulation not found by id"
        *     )
        * )
        */
    public function destroy(Regulations $regulation)
    {
        $regulation->delete();
        return response()->json(['message'=>'deleted'],200);
    }
}
