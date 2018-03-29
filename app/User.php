<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username', 'email', 'password', 'referral_id', 'referral', 'referral_provision', 'balance', 'admin', 'active', 'ban', 'reset_token', 'reset_at',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'reset_at',
    ];

    protected $casts = [
        'active' => 'boolean',
        'admin' => 'boolean',
        'ban' => 'boolean',
    ];

    public function activation(){
        return $this->HasOne('App\Activation', 'user_id');
    }

    public function referral(){
        return $this->HasOne('App\Referral', 'user_id');
    }

    public function reset(){
        return $this->HasMany('App\Reset', 'user_id');
    }

    public function session(){
        return $this->HasMany('App\Session', 'user_id');
    }

    public function profile()
    {
        return $this->HasOne('App\Profile', 'user_id');
    }

    public function locker()
    {
        return $this->HasOne('App\Locker', 'user_id');
    }

    public function log(){
        return $this->HasMany('App\Log', 'user_id');
    }

    public function lead()
    {
        return $this->HasMany('App\Lead', 'user_id');
    }

    public function permit_program()
    {
        return $this->HasMany('App\Permit', 'user_id');
    }

    public function earn()
    {
        return $this->HasMany('App\Earn', 'user_id');
    }

    public function tier()
    {
        return $this->HasOne('App\Tier', 'user_id');
    }

    public function program(){
        return $this->hasMany('App\Program', 'private_user_id');
    }

    public function configuration()
    {
        return $this->hasMany('App\Configuration', 'user_id');
    }

    public function view()
    {
        return $this->hasMany('App\View', 'user_id');
    }

    public function payout()
    {
        return $this->hasMany('App\Payout', 'user_id');
    }

    public function scopeBan($query, $type){
        return $query->where('ban', $type);
    }

    public function scopeActive($query, $type){
        return $query->where('active', $type);
    }
}
