<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sportsmans_regulations extends Model
{
    use HasFactory;
    protected $table = "sportsmans_regulations";
    protected $fillalbe = [
        'regulations_id','sportsmans_id','completion_date',
    ];
    protected $hidden = [
        'created_at','updated_at'
    ];
    protected $guarded = [
        'id','created_at','updated_at'
    ];
    protected $casts = [];
}
