<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $table = 'profiles';

	protected $fillable = ['user_id', 'account_type', 'company_name', 'nip', 'pesel', 'first_name', 'last_name', 'address', 'city', 'zip_code', 'bank_name', 'bank_account', 'paypal', 'gg_number', 'confirm_gg', 'chat_view', 'rank_view', 'lead_sound'];

}
