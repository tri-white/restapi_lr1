<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regulations extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $table = "regulations";
    protected $fillalbe = [
        'name','description','minimal_requirements','gender',
    ];
    protected $hidden = [
        'updated_at','created_at',
    ];
    protected $guarded = [
        'id','created_at','updated_at',
    ];
    protected $casts = [
        
    ];
    public function sportsmen():BelongsToMany{ // belongsToMany/hasMany?
        return $this->hasMany(Sportsmen::class,'sportsmen_regulations');
    }
}
