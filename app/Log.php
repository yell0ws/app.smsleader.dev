<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{

	protected $fillable = ['user_id', 'type', 'event', 'event_id', 'ip_address', 'public'];

    protected $hidden = [];

    public function scopeLatest($query) {
        return $query->orderBy('created_at', 'asc');
    }

    public function scopeNewest($query) {
        return $query->orderBy('created_at', 'desc');
    }

}
