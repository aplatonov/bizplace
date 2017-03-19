<?php

namespace App;

trait UserRelations
{
    public function isAdmin()
    {
        return ($this->role_id == 1) ? true : false;
    }
}