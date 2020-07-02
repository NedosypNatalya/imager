<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $fillable = [
        'title', 'content', 'user_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function images()
    {
        return $this->hasMany('App\Image', 'post_id');
    }
}
