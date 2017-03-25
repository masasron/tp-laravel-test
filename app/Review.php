<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject','body', 'post_id'
    ];

   /**
    * Review owner.
    *
    * @return Collection
    */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
