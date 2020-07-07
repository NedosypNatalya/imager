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
        return $this->belongsTo('App\Post', 'post_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i',
        'updated_at' => 'datetime:d-m-Y H:i',
    ];

    public function images()
    {
        return $this->morphMany('App\Image', 'table');
    }
}
