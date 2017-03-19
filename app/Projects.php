<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $table="projects";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_name', 'description', 'speciality_id', 'doc', 'start_date', 'finish_date', 'budget', 'owner_id', 'customer_id', 'active',
    ];
}
