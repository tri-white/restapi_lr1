<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
