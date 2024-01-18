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
    public function regulations():belongsToMany{ // or maybe hasMany is fine too, because table sportsmen_regulations is not usual pivot table, it also has another fields, but I can get them either way I think, so relationship here can be both hasMany and belongsToMany?
        return $this->belongsToMany(Regulations::class,'sportsmen_regulations');
    }
}
