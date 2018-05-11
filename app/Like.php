<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function user()
    {
    	$this->belongsTo('App\User');

    }
    //one post has many likes 
    public function likes()
    {
    	return $this->hasMany('App\Like')
    }

    
}
