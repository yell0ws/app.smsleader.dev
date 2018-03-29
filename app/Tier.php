<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tier extends Model
{

	protected $fillable = ['user_id'];


    public function rate($rate, $name){

    	$type = explode(' ', strtolower($name));

        return round($this->{$type[0]}+$rate, 2);
    }
}
