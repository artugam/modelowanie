<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }
    
    public function offers() {
        return $this->hasMany('App\Offer');
    }

    public function friends() {
        return $this->belongsToMany('App\Friend');
    }
}
