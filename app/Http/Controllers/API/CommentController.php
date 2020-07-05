<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Comment;
use App\User;
use Validator;

class CommentController extends BaseController
{
    /**
     * Просмотр всех комментариев
     */
    public function showAllComments(){
        $comments = Comment::all();
        return $this->sendResponse($comments->toArray(), 'All comments retrieved successfully.');
    }
    /**
     * Просмотр комментариев определённого поста
     */
    public function showCommentsSinglePost($post_id){
        $comments = Post::find($post_id)->comments;
        return $this->sendResponse($comments->toArray(), 'Comments of post - '.$post_id.' retrieved successfully.');
    }

    /**
     * Добавление комментария
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
        return $this->sendResponse($comment->toArray(), 'Comment created successfully.');
    }

    /**
     * Редактирование комментария
     */
    public function update(Request $request, $post_id, $comment_id){
        $comment = Comment::find($comment_id);
        $data = $request->all();
        $validator = Validator::make($data, [
            'text' => 'required|max:255'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        if($comment->user->id != Auth::user()->id){
            return $this->sendError('Нельзя изменить чужой комментарий.');
        }
        $comment->text = $data['text'];
        $comment->save();
        return $this->sendResponse($comment->toArray(), 'Comment updated successfully.');
    }

    /**
     * Удаление комментария
     */
    public function destroy($post_id, $comment_id){
        $comment = Comment::find($comment_id);
        if($comment->user->id != Auth::user()->id){
            return $this->sendError('Нельзя удалить чужой комментарий.');
        }
        $comment->delete();
        return $this->sendResponse($comment, 'Comment deleted successfully.');
    }
}
