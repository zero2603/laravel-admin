<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
	protected $table = 'order_statuses';

    protected $fillable = ['order_id', 'order_total', 'interest', 'checked_partners', 'checked_products', 'status'];
}
