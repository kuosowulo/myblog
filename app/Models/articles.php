<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class articles extends Model
{
    protected $connection = 'mysql';
    protected $table = 'articles';
    protected $fillable = ['author', 'title', 'subtitle', 'date', 'content'];
    public $timestamps = true;

    public function users()
    {
        return $this->hasOne('App\Models\users', 'id', 'author');
    }
}
