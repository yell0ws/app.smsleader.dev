<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
     protected $fillable = [
        'user_id', 'title', 'slug', 'image', 'message'
    ];


    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
