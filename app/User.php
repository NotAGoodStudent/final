<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    public function given_likes()
    {
        return $this->hasMany(Like::class, 'like_giver');
    }

    public function received_likes()
    {
        return $this->hasMany(Like::class, 'like_receiver');
    }

    public function given_match()
    {
        return $this->hasMany(Match::class, 'matcher');
    }

    public function received_match()
    {
        return $this->hasMany(Match::class,'matched');
    }


    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password', 'bio', 'gender','interested_in', 'location','age'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
