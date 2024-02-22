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
    /**
 * @OA\Get(
 *      path="/api/competitions",
 *      operationId="getCompetitionsList",
 *      tags={"Competitions"},
 *      summary="Get list of competitions",
 *      description="Returns list of competitions",
 *      @OA\Parameter(
 *          name="name[eq]",
 *          in="query",
 *          description="Name of the competition (equal to the specified value)",
 *          required=false,
 *          @OA\Schema(type="string")
 *      ),
 *      @OA\Parameter(
 *          name="event_date[eq]",
 *          in="query",
 *          description="Date of the competition event (equal to the specified value)",
 *          required=false,
 *          @OA\Schema(type="datetime", format="date-time")
 *      ),
 *      @OA\Parameter(
 *          name="event_date[gt]",
 *          in="query",
 *          description="Date of the competition event (greater than the specified value)",
 *          required=false,
 *          @OA\Schema(type="datetime", format="date-time")
 *      ),
 *      @OA\Parameter(
 *          name="event_date[lt]",
 *          in="query",
 *          description="Date of the competition event (less than the specified value)",
 *          required=false,
 *          @OA\Schema(type="datetime", format="date-time")
 *      ),
 *      @OA\Parameter(
 *          name="event_location[eq]",
 *          in="query",
 *          description="Location of the competition (equal to the specified value)",
 *          required=false,
 *          @OA\Schema(type="string")
 *      ),
 *      @OA\Parameter(
 *          name="prize_pool[eq]",
 *          in="query",
 *          description="Prize pool amount (equal to the specified value)",
 *          required=false,
 *          @OA\Schema(type="integer")
 *      ),
 *      @OA\Parameter(
 *          name="prize_pool[gt]",
 *          in="query",
 *          description="Prize pool amount (greater than the specified value)",
 *          required=false,
 *          @OA\Schema(type="integer")
 *      ),
 *      @OA\Parameter(
 *          name="prize_pool[lt]",
 *          in="query",
 *          description="Prize pool amount (less than the specified value)",
 *          required=false,
 *          @OA\Schema(type="integer")
 *      ),
 *      @OA\Parameter(
 *          name="sports_type[eq]",
 *          in="query",
 *          description="Type of sports for the competition (equal to the specified value)",
 *          required=false,
 *          @OA\Schema(type="string", enum={"100m sprint", "3km run", "spear throwing", "football", "tennis"})
 *      ),
 *      @OA\Parameter(
 *          name="includeSportsmans",
 *          in="query",
 *          description="Include sportsmans with competitions",
 *          required=false,
 *          @OA\Schema(type="boolean")
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          
 *      )
 * )
 */
    public function index(Request $request)
    {
        $filter = new CompetitionsFilter();
        $queryItems = $filter->transform($request); // ['column', 'operator', 'value']

        $includeSportsmans = $request->query('includeSportsmans');

        $competitions = Competitions::where($queryItems);

        if($includeSportsmans){
            $competitions=$competitions->with('sportsmans');
        }
        return new CompetitionCollection($competitions->paginate()
            ->appends($request->query())
        );
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
        /**
 * @OA\Post(
 *     path="/api/competitions",
 *     summary="Adds a new competition",
 *    tags={"Competitions"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Competitions")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *                 @OA\Schema(ref="#/components/schemas/Competitions"),
 *             @OA\Examples(example="competition", value={
 * "data": {
 *   "id": 122,
 *   "name": "EventX",
*    "eventDate": "1995-09-26T21:52:51.000000Z",
    *"eventLocation": "81767 Heidenreich Ridge\\nSouth Lisette, KY 12766",
   * "prizePool": 694138,
  *  "sportsType": "3km run"
 * }
*}, summary="A competition object."),
 *         )
 *     ),
 *      @OA\Response(
 *         response=422,
 *         description="Unprocessable request (validation failed)",
 *     )
 * )
 */
    public function store(StoreCompetitionsRequest $request)
    {
        $competition = Competitions::create($request->validated());

            return new CompetitionResource($competition);

    }

    /**
     * Display the specified resource.
     */
      /**
 * @OA\Get(
 *      path="/api/competitions/{id}",
 *      operationId="getCompetition",
 *      tags={"Competitions"},
 *      summary="Get competition by id",
 *      description="Returns one competition record by id if it is found",
 *      @OA\Parameter(
 *         description="Id of competition",
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
 *                 @OA\Schema(ref="#/components/schemas/Competitions"),
 *             @OA\Examples(example="competition", value={
                    * "data": {
                    *   "id": 122,
                    *   "name": "EventX",
                    *    "eventDate": "1995-09-26T21:52:51.000000Z",
                        *"eventLocation": "81767 Heidenreich Ridge\\nSouth Lisette, KY 12766",
                    * "prizePool": 694138,
                    *  "sportsType": "3km run"
                    * }
                    *}, summary="A competition object."),
 *         ) 
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Record not found",
 *          
 *      )
 * )
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
        return view('competitions.edit',['competition'=>$competition]);
    }

    /**
     * Update the specified resource in storage.
     */
     /**
 * @OA\Put(
 *     path="/api/competitions/{id}",
 *     summary="Updates a competition",
 *      tags={"Competitions"},
 * 
 *     @OA\Parameter(
 *         description="Id of competition to update",
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="string"),
 *         @OA\Examples(example="int", value="1", summary="An int value."),
 *     ),
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Competitions")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *          @OA\JsonContent(
 *                 @OA\Schema(ref="#/components/schemas/Competitions"),
 *             @OA\Examples(example="competition", value={
                    * "data": {
                    *   "id": 122,
                    *   "name": "EventX",
                    *    "eventDate": "1995-09-26T21:52:51.000000Z",
                        *"eventLocation": "81767 Heidenreich Ridge\\nSouth Lisette, KY 12766",
                    * "prizePool": 694138,
                    *  "sportsType": "3km run"
                    * }
                    *}, summary="A competition object."),
 *         ),
        *     ),
        *     @OA\Response(
        *         response=404,
        *         description="Competition not found by id"
        *     )
 * )
 */
    public function update(UpdateCompetitionsRequest $request, Competitions $competition)
    {
        $competition->update($request->validated());
            return new CompetitionResource($competition);
    }

    /**
     * Remove the specified resource from storage.
     */
    /** 
    * @OA\Delete(
        *     path="/api/competitions/{id}",
        *     summary="Deletes a competition",
        *      tags={"Competitions"},
        * 
        *     @OA\Parameter(
        *         description="Id of competition to delete",
        *         in="path",
        *         name="id",
        *         required=true,
        *         @OA\Schema(type="string"),
        *         @OA\Examples(example="int", value="1", summary="An int value."),
        *     ),
        *     @OA\Response(
        *         response=200,
        *         description="Competition successfully deleted"
        *     ),
           *     @OA\Response(
        *         response=404,
        *         description="Competition not found by id"
        *     )
        * )
        */
    public function destroy(Competitions $competition)
    {
        $competition->delete();
        return response()->json(['message'=>'deleted'],200);
    }
}
