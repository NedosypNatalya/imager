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
     * Display all posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all()->where('user_id', '=', Auth::user()->id);
        $response = (new Post)->getFullPosts($posts);
        return $this->sendResponse($response, 'My posts with images retrieved successfully.');
    }
    /**
     * Display posts of authorized user.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllPosts()
    {
        $posts = Post::all();
        $response = (new Post)->getFullPosts($posts);
        return $this->sendResponse($response, 'All posts with images retrieved successfully.');
    }
    /**
     * Store a new post.
     *
     * @param  \Illuminate\Http\Request  $request
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
        $images = [];
        if(isset($input['images'])) HelperImage::getImages($input['images'], $images,  $post->id, 'App\Post');
        $response = (new Post)->getSingleFullPost($post);
        return $this->sendResponse($response, 'Post created successfully.');
    }
    /**
     * Display the post.
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
        $response = (new Post)->getSingleFullPost($post);
        return $this->sendResponse($response, 'Post retrieved successfully.');
    }
    /**
     * Update post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Post $post
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
        $images = [];
        if(isset($input['images'])) HelperImage::getImages($input['images'], $images,  $post->id, 'App\Post');
        $response = (new Post)->getSingleFullPost($post);
        return $this->sendResponse($response, 'Post updated successfully.');
    }
    /**
     * Delete post.
     *
     * @param  App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $response = (new Post)->getSingleFullPost($post);
        $post->deletePostImages();
        $post->deletePostComments();
        $post->delete();
        return $this->sendResponse($response, 'Post deleted successfully.');
    }
}
