<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dateFormat = 'U';
}
