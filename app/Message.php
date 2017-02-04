<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $fillable = ['message'];
	// protected $appends = ['user'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    // public function getUserAttribute()
    // {
    // 	return $this->user();
    // }
}
