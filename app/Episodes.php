<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episodes extends Model
{
	protected $table = 'episodes';
	protected $primaryKey = 'episodes_id';
    protected $guarded = [];
}
