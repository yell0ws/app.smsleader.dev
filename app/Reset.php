<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reset extends Model
{
    protected $table = 'password_resets';

	protected $fillable = [
        'user_id', 'password', 'token'
    ];
}
