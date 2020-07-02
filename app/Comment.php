<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'text', 'post_id', 'user_id'
    ];
    public function post()
    {
        return $this->belongsTo('App\Posts', 'post_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}