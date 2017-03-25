<?php

namespace App;

use Cache;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'stars', 'post_id'
    ];

   /**
    * Rating owner.
    *
    * @return Collection
    */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
