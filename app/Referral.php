<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $table = 'referral_earns';

	protected $fillable = ['referral_id', 'user_id', 'payout_id', 'amount'];


	public function user(){
        return $this->hasOne('App\User', 'id', 'referral_id');
    }

}
