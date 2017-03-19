<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use UserRelations;

    protected $table="users";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'email', 'password', 'name', 'contact_person', 'phone', 'tarif_id', 'pay_till', 'role_id', 'valid', 'confirmed', 'confirmation_code', 'portfolio', 'logo', 'www',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

}
