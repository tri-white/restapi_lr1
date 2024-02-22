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
    /**
 * @OA\Get(
 *      path="/api/sportsmans",
 *      operationId="getSportsmansList",
 *      tags={"Sportsmans"},
 *      summary="Get list of sportsmans",
 *      description="Returns list of sportsmans",
 *      @OA\Parameter(
 *          name="name[eq]",
 *          in="query",
 *          description="Name of the competition (equal to the specified value)",
 *          required=false,
 *          @OA\Schema(type="string")
 *      ),
 *      @OA\Parameter(
 *          name="email[eq]",
 *          in="query",
 *          description="Date of the competition event (equal to the specified value)",
 *          required=false,
 *          @OA\Schema(type="datetime", format="date-time")
 *      ),
 *      @OA\Parameter(
 *          name="gender[eq]",
 *          in="query",
 *          description="Location of the competition (equal to the specified value)",
 *          required=false,
 *          @OA\Schema(type="string")
 *      ),
 *      @OA\Parameter(
 *          name="category[eq]",
 *          in="query",
 *          description="Prize pool amount (equal to the specified value)",
 *          required=false,
 *          @OA\Schema(type="integer")
 *      ),
 *      @OA\Parameter(
 *          name="sponsor[eq]",
 *          in="query",
 *          description="Type of sports for the competition (equal to the specified value)",
 *          required=false,
 *          @OA\Schema(type="string", enum={"100m sprint", "3km run", "spear throwing", "football", "tennis"})
 *      ),
 *      @OA\Parameter(
 *          name="includeRegulations",
 *          in="query",
 *          description="Include sportsmans with competitions",
 *          required=false,
 *          @OA\Schema(type="boolean")
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *      )
 * )
 */
    public function index(Request $request)
    {
        $filter = new SportsmansFilter();
        $queryItems = $filter->transform($request); // ['column', 'operator', 'value']
        $includeRegulations = $request->query('includeRegulations');


        $sportsmans = Sportsmans::where($queryItems);

        if($includeRegulations){
            $sportsmans=$sportsmans->with('regulations');
        }
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
           /**
 * @OA\Post(
 *     path="/api/sportsmans",
 *     summary="Adds a new sportsman",
 *    tags={"Sportsmans"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Sportsmans")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *                 @OA\Schema(ref="#/components/schemas/Sportsmans"),
 *             @OA\Examples(example="sportsman", value={
 * "data": {
*   "id": 2,
*   "name": "dolorem",
*   "email": "fwolff@rice.org",
*   "gender": "female",
*   "category": "spear throwing",
*   "sponsor": null
 * }
*}, summary="A sportsman object."),
 *         )
 *     ),
 *      @OA\Response(
 *         response=422,
 *         description="Unprocessable request (validation failed)",
 *     )
 * )
 */
    public function store(StoreSportsmansRequest $request)
    {
        $sportsman = Sportsmans::create($request->validated());

        return new SportsmansResource($sportsman);
    }

    /**
     * Display the specified resource.
     */
  /**
 * @OA\Get(
 *      path="/api/sportsmans/{id}",
 *      operationId="getSportsman",
 *      tags={"Sportsmans"},
 *      summary="Get sportsman by id",
 *      description="Returns one sportsman record by id if it is found",
 *      @OA\Parameter(
 *         description="Id of sportsman",
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
 *                 @OA\Schema(ref="#/components/schemas/Sportsmans"),
 *             @OA\Examples(example="sportsman", value={
                    * "data": {
*   "id": 2,
*   "name": "dolorem",
*   "email": "fwolff@rice.org",
*   "gender": "female",
*   "category": "spear throwing",
*   "sponsor": null
                    * }
                    *}, summary="A sportsman object."),
 *         ) 
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Record not found",
 *          
 *      )
 * )
 */
    public function show(Sportsmans $sportsman)
    {
        // $sportsmans= Sportsmans::findOrFail($sportsmans);
        $sportsman= Sportsmans::with('regulations')->find($sportsman)->first();

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
      /**
 * @OA\Put(
 *     path="/api/sportsmans/{id}",
 *     summary="Updates a sportsman",
 *      tags={"Sportsmans"},
 * 
 *     @OA\Parameter(
 *         description="Id of sportsman to update",
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="string"),
 *         @OA\Examples(example="int", value="1", summary="An int value."),
 *     ),
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Sportsmans")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *          @OA\JsonContent(
 *                 @OA\Schema(ref="#/components/schemas/Sportsmans"),
 *             @OA\Examples(example="sportsman", value={
                    * "data": {
*   "id": 2,
*   "name": "dolorem",
*   "email": "fwolff@rice.org",
*   "gender": "female",
*   "category": "spear throwing",
*   "sponsor": null
                    * }
                    *}, summary="A sportsman object."),
 *         ),
        *     ),
        *     @OA\Response(
        *         response=404,
        *         description="Sportsman not found by id"
        *     )
 * )
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
     /** 
    * @OA\Delete(
        *     path="/api/sportsmans/{id}",
        *     summary="Deletes a sportsman",
        *      tags={"Sportsmans"},
        * 
        *     @OA\Parameter(
        *         description="Id of sportsman to delete",
        *         in="path",
        *         name="id",
        *         required=true,
        *         @OA\Schema(type="string"),
        *         @OA\Examples(example="int", value="1", summary="An int value."),
        *     ),
        *     @OA\Response(
        *         response=200,
        *         description="Sportsman successfully deleted"
        *     ),
           *     @OA\Response(
        *         response=404,
        *         description="Sportsman not found by id"
        *     )
        * )
        */
    public function destroy(Sportsmans $sportsman)
    {
        // $sportsmans = Sportsmans::findOrFail($sportsmans);
        $sportsman->delete();
        return response()->json(['message'=>'deleted'],200);
    }
}
