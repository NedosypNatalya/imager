<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Image;
use Validator;
use HelperImage;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all()->where('user_id', '=', Auth::user()->id);
        return $this->sendResponse($posts->toArray(), 'My posts retrieved successfully.');
    }
    public function getAllPosts()
    {
        $posts = Post::all();
        return $this->sendResponse($posts->toArray(), 'All posts retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required|max:255',
            'content' => 'required|max:4000',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $post = new Post;
        $post->title = $input['title'];
        $post->content = $input['content'];
        $post->user()->associate(Auth::user());
        $post->save();
        $id_post = $post['id'];
        HelperImage::getImages($request->file(), $id_post);
        return $this->sendResponse($post->toArray(), 'Post created successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if (is_null($post)) {
            return $this->sendError('Post not found.');
        }
        return $this->sendResponse($post->toArray(), 'Post retrieved successfully.');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required|max:255',
            'content' => 'required|max:4000'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $post->title = $input['title'];
        $post->content = $input['content'];
        $post->save();
        return $this->sendResponse($post->toArray(), 'Post updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return $this->sendResponse($post->toArray(), 'Post deleted successfully.');
    }
}
