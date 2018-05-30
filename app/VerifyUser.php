<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
	protected $table = 'verify_users';

	protected $fillable = ['user_id', 'token'];

	protected $guarded = [];
	
	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}
	
	
}
