<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'organ_id', 'fist_name', 'last_name'
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
     * appended properties list
     */
  /*  public $appends = [
        'register_date'
    ];*/

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get articles of user
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Get Roles of user
     */
    public function roles()
    {
        return $this->hasMany(Role::class);
    }

    /**
     * Register date
     */
 /*   public function getRegisterDateAttribute()
    {
        return miladiToPersianDateTime($this->created_at);
    }*/
}
