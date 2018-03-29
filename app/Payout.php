<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{

	protected $fillable = ['user_id', 'payout_id', 'amount', 'priority', 'priority_provision', 'form', 'cancel_reason', 'status', 'token', 'paid_at'];

    protected $hidden = [];

    protected $dates = [
        'paid_at',
    ];

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function getWithdrawStatus(){
        if ($this->status == 'cancel') return ['important', 'Anulowana'];
    	if ($this->status == 'notconfirm') return ['inverse', 'Niepotwierdzona'];
        if ($this->status == 'wait') return ['warning', 'Oczekuje na realizację'];
    	if ($this->status == 'pay') return ['success', 'Zrealizowana'];
    }

    public function getWithdrawPriority(){
        if ($this->priority == 'standard') return 'Standardowa';
        if ($this->priority == 'express') return 'Ekspresowa';
    }

    public function getWithdrawForm(){
        if ($this->form == 'bank') return 'Przelew bankowy';
        if ($this->form == 'paypal') return 'Paypal';
    }

    public function getWithdrawTime(){
    	$paid_at = Carbon::parse($this->paid_at);
    	$created_at = Carbon::parse($this->created_at);

        if ($this->status == 'cancel') return '-';
    	if ($this->status == 'pay') return $paid_at->diffForHumans($created_at,true);

    	return $this->created_at->diffForHumans(Carbon::now(),true);
    }

    public function scopeNotConfirm($query){
        return $query->where('status', 'notconfirm');
    }

    public function scopeWait($query){
        return $query->where('status', 'wait');
    }

    public function scopePay($query){
        return $query->where('status', 'pay');
    }

    public function scopeCancel($query){
        return $query->where('status', 'cancel');
    }

    public function scopeLatest($query) {
        return $query->orderBy('created_at', 'asc');
    }

    public function scopeNewest($query) {
        return $query->orderBy('created_at', 'desc');
    }

}
