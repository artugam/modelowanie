<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'surname' ,'email', 'password', 'telefon', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts() {
        return $this->hasMany('App\Post');
    }
    public function categories() {
        return $this->hasMany('App\Category');
    }
    public function comments() {
        return $this->hasMany('App\Comment');
    }
    public function offers() {
        return $this->hasMany('App\Offer');
    }
    public function friends() {
        return $this->hasMany('App\Friend', 'user_id_1');
    }
    public function friends1() {
        return $this->hasMany('App\Friend', 'user_id_2');
    }
}
