<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    protected $connection = 'mysql';
    protected $table = 'images';
    protected $fillable = ['user_id', 'path'];
    public $timestamps = true;
}
