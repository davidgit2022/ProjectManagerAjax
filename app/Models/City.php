<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function projects(){
        return $this->hasMany(Project::class);
    }

    public function getFormatNameAttribute()
    {
        $name = $this->attributes['name'];
        return ucfirst($name);     
    }
}
