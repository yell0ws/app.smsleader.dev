<?php

namespace App;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Earn extends Model
{

	protected $fillable = ['user_id', 'amount'];

    protected $hidden = [];

	public function user(){
        return $this->HasOne('App\User', 'id', 'user_id');
    }

}
