<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sentence extends Model
{
	protected $table = 'sentence';
	protected $primaryKey = 'sentence_id';
    protected $fillable = [
       'episodes_id','english', 'vietnamese', 'created_at', 'updated_at','numOrder'
    ];
}
