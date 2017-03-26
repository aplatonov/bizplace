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

    public function speciality()
    {
        return $this->belongsTo('App\Speciality', 'speciality_id', 'id');
    }

    public function personTechnologies()
    {
        return $this->belongsToMany('App\Technology', 'personal_has_technology', 'person_id', 'technology_id');
    }

    public function user()
    {
    	return $this->belongsTo('App\Users', 'user_id', 'id');
    }
}
