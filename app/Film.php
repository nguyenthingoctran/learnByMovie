<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
	protected $table = 'movie';
	protected $primaryKey = 'movie_id';
    protected $fillable = [
       'movie_id','movie_name_1', 'movie_poster', 'kindId', 'movie_created_at','movie_updated_at'
    ];

	}
