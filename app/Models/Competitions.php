<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Competitions extends Model
{
    use CrudTrait;
    use HasFactory, SoftDeletes;
    protected $table = "competitions";
    protected $fillalbe = [
        'name','event_date','event_location','prize_pool','sports_type',
    ];
    protected $hidden = [
        'created_at','updated_at','deleted_at'
    ];
    protected $guarded = [
        'id','deleted_at','created_at','updated_at'
    ];
    protected $casts = [
        'event_date'=>'datetime',
    ];
    public function sportsmen():BelongsToMany{
        return $this->belongsToMany(Sportsmen::class, 'competitions_sportsmen');
    }
}
