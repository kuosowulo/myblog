<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class users extends Authenticatable
{
    protected $connection = 'mysql';
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password'];
    public $timestamps = 'true';
}
