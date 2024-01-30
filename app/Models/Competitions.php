<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
 /**
 * @OA\Schema(
 *  schema="Competitions",
 *  title="Schema of competition record",
 *                  @OA\Property(
                *       property="id",
                *       type="integer",
                *       format="int64"
                *   ),
                *   @OA\Property(
                *       property="name",
                *       type="string"
                *   ),
                *   @OA\Property(
                *       property="event_date",
                *       type="string",
                *       format="date-time"
                *   ),
                *   @OA\Property(
                *       property="event_location",
                *       type="string"
                *   ),
                *   @OA\Property(
                *       property="prize_pool",
                *       type="integer",
                *       format="int64"
                *   ),
                *   @OA\Property(
                *       property="sports_type",
                *       type="string"
                *   ),
 *  example={"id":1,"name":"id","event_date":"1995-09-26T21:52:51.000000Z","event_location":"81767 Heidenreich Ridge\nSouth Lisette, KY 12766","prize_pool":694138,"sports_type":"3km run"}
 * )
 */
class Competitions extends Model
{
    use CrudTrait;
    use HasFactory, SoftDeletes;
    protected $table = "competitions";
    protected $fillalbe = [
        'name','event_date','event_location','prize_pool','sports_type',
    ];
    protected $hidden = [
        'created_at','updated_at','deleted_at'
    ];
    protected $guarded = [
        'id','deleted_at','created_at','updated_at'
    ];
    protected $casts = [
        'event_date'=>'datetime',
    ];
    public function sportsmans():BelongsToMany{
        return $this->belongsToMany(Sportsmans::class, 'competitions_sportsmans');
    }
}
