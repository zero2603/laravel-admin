<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartnerRecord extends Model
{
    protected $table = 'partner_records';
    
    protected $fillable = ['partner_id', 'order_id', 'value', 'order_secret_key',];
}
