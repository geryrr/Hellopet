<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pet';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'checkup_id','pet_name', 'pet_age','pet_disease','pet_gender','owner_name','doctor_name','notes',
    ];

} 