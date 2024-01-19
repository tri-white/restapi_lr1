<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sportsmen_regulations extends Model
{
    use HasFactory;
    protected $table = "sportsmen_regulations";
    protected $fillalbe = [
        'regulation_id','sportsman_id','completion_date',
    ];
    protected $hidden = [
        'created_at','updated_at'
    ];
    protected $guarded = [
        'id','created_at','updated_at'
    ];
    protected $casts = [];
}
