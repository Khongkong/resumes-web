<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillable = [];
    
    public function tags() 
    {
        return $this->belongsToMany('App\Tag');
    }

    public function user() 
    {
        return $this->belongsTo('App\User');
    }
    
    public function comments() {
        return $this->hasMany('App\Comment');
    }
}
