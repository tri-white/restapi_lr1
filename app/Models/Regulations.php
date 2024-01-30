<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 *     schema="Regulation",
 *     title="Regulation Schema",
 *     required={"name", "description", "minimal_requirements"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         format="int64",
 *         description="The unique identifier for the regulation"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="The name of the regulation"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         description="The description of the regulation"
 *     ),
 *     @OA\Property(
 *         property="minimal_requirements",
 *         type="string",
 *         description="The minimal requirements of the regulation"
 *     ),
 *     @OA\Property(
 *         property="gender",
 *         type="string",
 *         enum={"male", "female", "unisex"},
 *         default="unisex",
 *         description="The gender for which the regulation applies"
 *     ),
 * example = {"id":1,"name":"et","description":"Qui corporis dolores harum rerum a sunt.","minimalRequirements":"alias","gender":"male"},
 * )
 */

class Regulations extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $table = "regulations";
    protected $fillalbe = [
        'name','description','minimal_requirements','gender',
    ];
    protected $hidden = [
        'updated_at','created_at',
    ];
    protected $guarded = [
        'id','created_at','updated_at',
    ];
    protected $casts = [
        
    ];
    public function sportsmen():BelongsToMany{ // belongsToMany/hasMany?
        return $this->hasMany(Sportsmen::class,'sportsmen_regulations');
    }
}
