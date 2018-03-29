<?php

namespace App;

use Auth;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{

    protected $fillable = ['title', 'domain', 'active', 'private', 'global', 'adult', 'form'];

    protected $casts = [
        'active' => 'boolean',
        'private' => 'boolean',
        'global' => 'boolean',
        'adult' => 'boolean',
    ];

    public function permit()
    {
        return $this->hasOne('App\Permit', 'id', 'program_id');
    }

   	public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopePrivate($query)
    {
        return $query->where('private', 1);
    }

    public function scopeNotPrivate($query)
    {
        return $query->where('private', 0);
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
