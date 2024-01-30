<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
/**
 * @OA\Schema(
 *     schema="Sportsmans",
 *     title="Sportsmans Schema",
 *     required={"name", "gender", "category"},
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="The name of the sportsman"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         nullable=true,
 *         description="The email address of the sportsman (optional)"
 *     ),
 *     @OA\Property(
 *         property="gender",
 *         type="string",
 *         enum={"male", "female"},
 *         description="The gender of the sportsman"
 *     ),
 *     @OA\Property(
 *         property="category",
 *         type="string",
 *         enum={"tennis", "marathon", "spear throwing", "athletics"},
 *         description="The category of sports the sportsman participates in"
 *     ),
 *     @OA\Property(
 *         property="sponsor",
 *         type="string",
 *         nullable=true,
 *         description="The sponsor of the sportsman (optional)"
 *     ),
 *      example={"name":"quibusdam","email":"carroll.lesley@gmail.com","gender":"female","category":"marathon","sponsor":null},
 * )
 */

class Sportsmans extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $table = "sportsmans";
    protected $fillalbe = [
        'name','email','gender','category','sponsor'
    ];
    protected $hidden = [
        'updated_at','created_at',
    ];
    protected $guarded = [
        'id','created_at','updated_at',
    ];
    protected $casts = [

    ];
    public function competitions():BelongsToMany{
        return $this->belongsToMany(Competitions::class,'competitions_sportsmans');
    }
    public function regulations():BelongsToMany{ // hasMany or belongsToMany?
        return $this->belongsToMany(Regulations::class,'sportsmans_regulations');
    }
}
