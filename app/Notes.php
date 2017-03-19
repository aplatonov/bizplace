<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    protected $table="notes";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'note_name', 'description', 'to_user_id', 'from_user_id', 'note_category_id', 'active',
    ];

}
