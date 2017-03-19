<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalHasTechnology extends Model
{
    protected $table="personal_has_technology";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'personal_id', 'technology_id',
    ];
}
