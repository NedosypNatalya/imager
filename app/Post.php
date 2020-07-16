<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Comment;
use App\Image;

class Post extends Model
{
    protected $fillable = [
        'title', 'content', 'user_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment', 'post_id');
    }

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i',
        'updated_at' => 'datetime:d-m-Y H:i',
    ];

    public function images()
    {
        return $this->morphMany('App\Image', 'table');
    }

    public function deletePostImages(){
        (new Image)->deleteImages($this);
    }

    public function deletePostComments(){
        (new Comment)->deleteComments($this);
    }

    public function getSingleFullPost($post){
        $response = [];
        $response['post'] = $post->toArray();
        $images = [];
        foreach($post->images as $index => $image){
            $images[$index]['id'] = $image->id;
            $images[$index]['link'] = '/storage/images/'.$image->title;
            $images[$index]['alt'] = $image->title;
        }
        $response['images'] = $images;
        $response['comments'] = (new Comment)->getFullComments($post->comments);
        return $response;
    }

    public function getFullPosts($posts){
        $response = [];
        foreach($posts as $index => $post){
            $response[$index] = $this->getSingleFullPost($post);
        }
        return $response;
    }
}
