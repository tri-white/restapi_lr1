<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Competitions extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "competitions";
    protected $fillalbe = [
        'name','event_date','event_location','prize_pool','sports_type',
    ];
    protected $hidden = [
        'created_at','updated_at'
    ];
    protected $guarded = [
        'id','deleted_at','created_at','updated_at'
    ];
    protected $casts = [
        'event_date'=>'datetime',
    ];
}
