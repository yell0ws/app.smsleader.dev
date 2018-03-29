<?php 

namespace App\Traits\Payout;

use Auth;

trait WithdrawTrait
{

    public function WithdrawBlock()
    {
        $profile = Auth::user()->profile()->first();

        if ($profile) {
            if (empty($profile->first_name) || empty($profile->last_name) || empty($profile->address) || empty($profile->zip_code) || empty($profile->city) || empty($profile->account_type))  {
                return true;
            }

            if ($profile->account_type == 1) {
                if (empty($profile->pesel)) {
                    return true;
                }
            }

            if ($profile->account_type == 2) {
                if (empty($profile->company_name) || empty($profile->nip)) {
                    return true;
                }
            }
        }

        return false;
    }


    public function withdrawID(){
        $withdraw_last_id = Auth()->user()->payout()->orderby('id', 'desc')->first(['payout_id']);
        if ($withdraw_last_id) {
          return $withdraw_last_id->payout_id + 1;
        }

        return 1;
    }
}