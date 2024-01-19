<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
    public function competitions():BelongsToMany{
        return $this->belongsToMany(Competitions::class,'competitions_sportsmen');
    }
    public function regulations():BelongsToMany{ // hasMany or belongsToMany?
        return $this->hasMany(Regulations::class,'sportsmen_regulations');
    }
}
