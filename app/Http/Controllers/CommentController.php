<?php

namespace App\Http\Controllers;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use HelperImage;

class CommentController extends Controller
{
    public function store(Request $request){
      /*  $input = $request->all();
        $comment = new Comment;
        $comment->text = $input['text'];
        $comment->user()->associate(Auth::user());
        $comment->post()->associate($input['post_id']);*/
      //  $comment->save();
      //  $images = [];
      //  HelperImage::getImages($input['images'], $images, $comment->id, 'App\Comment');
        
       
        $response = array(
            'status' => 'success',
            'data' => [
                /*'text' => $comment->text,
                'user_name' => $comment->user->name,
                'comment_id' => $comment->id,
                'images' => $images*/
                'message' => 'upload'
            ]
        );
        return response()->json($response);
      
        /*$response = array(
            'status' => 'success',
            'data' => [
                'text' => $comment->text,
                'user_name' => $comment->user->name,
                'comment_id' => $comment->id,
                'images' => $input['images']
            ]
        );
        return response()->json($response);*/
       
    }

    public function edit($id){
        $comment = Comment::find($id);
        if (is_null($comment)) {
            return 'Comment not found.';
        }
        return view('formEditComment', ['comment' => $comment]);
    }
    public function update(Request $request, $id){
        $input = $request->all();
        $comment = (new Comment)->find($id);
        $comment->text = $input['content'];
        $comment->save();
        return view('formEditComment', ['message' => 'Изменения сохранены', 'comment' => $comment]);
    }
    public function destroy($id){
        $comment = Comment::find($id);
        $comment->delete();
        //return redirect()->route('my_posts.show', ['my_post' => $comment->post_id]);
        return redirect()->back();
    }
}
