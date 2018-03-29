<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activation extends Model
{
    protected $table = 'account_activations';

	protected $fillable = [
        'user_id', 'token'
    ];

    public $timestamps = false;
}
