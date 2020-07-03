<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
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
    public function comments()
    {
        return $this->hasMany('App\Comment', 'post_id');
    }

   /* public function getMyDateFormat()
    {
        return Carbon::createFromFormat($this->attributes['created_at'], 'd.m.y G:i')->toDateTimeString();
    }*/

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
      ];


    public function getCreatedAtAttribute($value)
    {
       // return Carbon::createFromFormat('d-m-Y H:i', $value)->toDateTimeString();
       return $this->created_at->format('d-m-Y H:i');
    }

   /* public function getUpdatedAtAttribute($value)
    {
       // return Carbon::createFromFormat('d-m-Y H:i', $value)->toDateTimeString();
       return $this->updated_at->format('d-m-Y H:i');
    }*/

    /*public function getCreatedAtAttribute($date)
    {
        //return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
        return date('d.m.y G:i', $date);
    }

    public function getUpdatedAtAttribute($date)
    {
        //return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
        return date('d.m.y G:i', $date);
    }*/
}
