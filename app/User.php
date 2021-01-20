<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table='users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function comments()
    {
        return $this->hasMany('App\Comment','from_user');
    }

    public function posts()
    {
        return $this->hasMany('App\Post','author_id');
    }
    public function getAvatarsPath($id)
    {
        $path = "uploads/avatars/id{$id}";
        if ( !file_exists($path) )
            mkdir($path, 0777,true);
        return "/$path/";
    }
    public function clearAvatars($id)
    {
        $path = "uploads/avatars/id{$id}";

        if ( file_exists( public_path("/$path") ) )
        {
            foreach ( glob( public_path("/$path/*") ) as $avatar )
                unlink($avatar);
        }
    }
}

