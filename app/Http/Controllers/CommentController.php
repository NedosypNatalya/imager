<?php

namespace App\Http\Controllers;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request){
        $input = $request->all();
        $comment = new Comment;
        $comment->text = $input['text'];
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $input['post_id'];
        $comment->save();
        $response = array(
            'status' => 'success',
            'data' => [
                'text' => $comment->text,
                'user_name' => $comment->user->name,
                'comment_id' => $comment->id
            ]
        );
        return response()->json($response);
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
