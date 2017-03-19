<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersHasTechnology extends Model
{
    protected $table="users_has_technology";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'technology_id',
    ];
}
