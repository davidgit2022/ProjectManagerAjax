<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'budget',
        'execution_date',
        'is_active',
        'city_id',
        'company_id',
        'user_id',
    ];

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }
}
