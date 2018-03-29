<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{

	protected $fillable = [
        'user_id', 'program_id', 'amount'
    ];

    public function configuration()
    {
        return $this->hasOne('App\Configuration', 'id', 'configuration_id', 'notification', 'created_at');
    }


    public function scopeOrderby($query, $column, $sort='asc'){
        $query->orderBy($column, $sort);
    }
}
