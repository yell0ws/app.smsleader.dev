<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{

    protected $table = 'configurations';

	protected $fillable = [
        'user_id', 'program_id', 'slug', 'title', 'name', 'payment', 'cover_url', 'video_url', 'redirect', 'payment_time', 'viewers', 'comments', 'active'
    ];

    public function program()
    {
        return $this->hasOne('App\Program', 'id', 'program_id');
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeBy($query, $column, $sort='asc'){
        return $query->orderBy($column, $sort);
    }

    public function scopeLatest($query) {
        return $query->orderBy('created_at', 'asc');
    }

    public function scopeNewest($query) {
        return $query->orderBy('created_at', 'desc');
    }

}
