<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartnerTransaction extends Model
{
    protected $table = 'partner_transactions';

    protected $fillable = ['partner_id', 'balance_change', 'content', 'status', 'note'];
}
