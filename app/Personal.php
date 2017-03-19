<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $table="personal";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'person_name', 'description', 'speciality_id', 'experience', 'images', 'resume', 'hour_rate', 'user_id', 'free_since', 'active',
    ];
}
