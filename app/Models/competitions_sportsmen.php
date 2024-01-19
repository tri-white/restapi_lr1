<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class competitions_sportsmen extends Model
{
    use HasFactory;
    protected $table = "competitions_sportsmen";
    protected $fillalbe = [
        'sportsman_id','competition_id',
    ];
    protected $hidden = [
        'updated_at','created_at',
    ];
    protected $guarded = [
        'id','created_at','updated_at'
    ];
    protected $casts = [];
}
