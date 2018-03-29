<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locker extends Model
{

    protected $table = 'locker_widgets';

	protected $fillable = ['user_id', 'name', 'domain', 'payment_model', 'redirect', 'color_background', 'color_button', 'text_intro', 'text_button', 'auto_rule'];

	protected $casts = [
        'payment_model' => 'array',
    ];

}
