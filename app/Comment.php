<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;

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

    public function getFullComments($comments){
        $response = [];
        foreach($comments as $index => $comment){
            $response[$index] = $this->getSingleFullComment($comment);
        }
        return $response;
    }

    public function getSingleFullComment($comment){
        $response = [];
        $response['comment'] = $comment->toArray();
        $images = [];
        foreach($comment->images as $index => $image){
            $images[$index]['id'] = $image->id;
            $images[$index]['link'] = '/storage/images/'.$image->title;
            $images[$index]['alt'] = $image->title;
        }
        $response['images'] = $images;
        return $response;
    }

    public function deleteComments($post){
        foreach($post->comments as $comment){
            (new Image)->deleteImages($comment);
            $comment->delete();
        }
    }

    public function deleteSingleComment(){
        (new Image)->deleteImages($this);
        $this->delete();
    }
}
