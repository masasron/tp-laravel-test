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
        'name', 'email', 'password','api_token'
    ];

   /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','api_token','created_at','updated_at'
    ];

   /**
    * User reviews.
    *
    * @return Collection
    */
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    /**
     * User ratings.
     *
     * @return Collection
     */
     public function ratings()
     {
         return $this->hasMany('App\Rating');
     }
}
