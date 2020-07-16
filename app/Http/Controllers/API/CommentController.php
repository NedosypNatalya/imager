<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Comment;
use Validator;
use HelperImage;

class CommentController extends BaseController
{
    /**
     * Display all comments.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAllComments(){
        $comments = Comment::all();
        $response = (new Comment)->getFullComments($comments);
        return $this->sendResponse($response, 'All comments retrieved successfully.');
    }

    /**
     * Display all comments of post.
     *
     * @param int $post_id
     * @return \Illuminate\Http\Response
     */
    public function showCommentsSinglePost($post_id){
        $post = Post::find($post_id);
        if(! $post){
            return $this->sendError('Post not found.');
        }
        $comments = Post::find($post_id)->comments;
        $response = (new Comment)->getFullComments($comments);
        return $this->sendResponse($response, 'Comments of post - '.$post_id.' retrieved successfully.');
    }

    /**
     * Store a new comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $post_id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id){
        $comment = new Comment;
        $data = $request->all();
        $validator = Validator::make($data, [
            'text' => 'required|max:255'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $comment->text = $data['text'];
        $comment->post_id = $post_id;
        $comment->user()->associate(Auth::user());
        $comment->save();
        $images = [];
        if(isset($data['images'])) HelperImage::getImages($data['images'], $images,  $comment->id, 'App\Comment');
        $response = (new Comment)->getSingleFullComment($comment);
        return $this->sendResponse($response, 'Comment created successfully.');
    }

    /**
     * Update comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $post_id
     * @param  int $comment_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post_id, $comment_id){
        $comment = Comment::find($comment_id);
        if(! $comment){
            return $this->sendError('Comment not found.');
        }
        if($comment->user->id != Auth::user()->id){
            return $this->sendError('Нельзя изменить чужой комментарий.');
        }
        $data = $request->all();
        $validator = Validator::make($data, [
            'text' => 'required|max:255'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $comment->text = $data['text'];
        $comment->save();
        $images = [];
        if(isset($data['images'])) HelperImage::getImages($data['images'], $images,  $comment->id, 'App\Comment');
        $response = (new Comment)->getSingleFullComment($comment);
        return $this->sendResponse($response, 'Comment updated successfully.');
    }

    /**
     * Delete comment.
     *
     * @param  int $post_id
     * @param  int $comment_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id, $comment_id){
        $comment = Comment::find($comment_id);
        if(! $comment){
            return $this->sendError('Comment not found.');
        }
        if($comment->user->id != Auth::user()->id){
            return $this->sendError('Нельзя удалить чужой комментарий.');
        }
        $response = (new Comment)->getSingleFullComment($comment);
        $comment->deleteSingleComment();
        return $this->sendResponse($response, 'Comment deleted successfully.');
    }
}
