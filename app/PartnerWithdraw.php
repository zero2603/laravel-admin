<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartnerWithdraw extends Model
{
    protected $table = 'partner_withdraws';

    protected $fillable = ['partner_id', 'method', 'account_name', 'account_number', 'bank', 'phone',];
}
