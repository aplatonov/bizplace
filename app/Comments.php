<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table="comments";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'user_id', 'company_id', 'author_name', 'author_position', 'active', 'visible_on_main', 'raiting',
    ];
}
