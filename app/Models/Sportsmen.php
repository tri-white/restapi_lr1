<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sportsmen extends Model
{
    use HasFactory;
    protected $table = "sportsmen";
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
    public function competitions():belongsToMany{
        return $this->belongsToMany(Competitions::class,'competitions_sportsmen');
    }
    public function regulations():hasMany{ // hasMany or belongsToMany?
        return $this->hasMany(sportsmen_regulations::class);
    }
}
