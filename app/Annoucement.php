<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Annoucement extends Model
{
	protected $table = 'annoucements';

    protected $fillable = ['eng_title', 'vie_title', 'eng_content', 'vie_content'];
}
