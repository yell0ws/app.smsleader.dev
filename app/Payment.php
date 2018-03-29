<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

	protected $table = 'payment_models';

	protected $fillable = [
    ];


   	public function scopeActive($query, $type){
        return $query->where('active', $type);
    }


    public function scopeAdult($query, $type){
        return $query->where('adult', $type);
    }

    public function scopeBy($query, $column, $sort='asc'){
        return $query->orderBy($column, $sort);
    }

}
