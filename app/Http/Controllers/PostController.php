<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Image;
use App\Comment;
use App\Http\Requests\PostRequest;
use Validator;
use App\Exports\PostsExport;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\ArrayToXml\ArrayToXml;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use SoapBox\Formatter\Formatter;
use Response;
use HelperImage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all()->where('user_id', '=', Auth::user()->id);
        return view('posts', ['posts' => $posts]);
    }

    public function getAll(){
        $posts = Post::paginate(5);
        return view('posts_all', ['posts' => $posts]);
    }

    public function create(){
        return view('formCreatePost');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required|max:255',
            'content' => 'required|max:4000',
        ]);
        if($validator->fails()){
            return view('formCreatePost', ['message' => 'Validation Error.'.$validator->errors()]);
        }
        $post = new Post;
        $post->user()->associate(Auth::user());
        $post->title = $input['title'];
        $post->content = $input['content'];
        $post->save();
        $images = [];
        HelperImage::getImages($request->images, $images, $post->id, 'App\Post');
        return redirect()->route('my_posts.index');
    }

    public function show($id)
    {
        $post = Post::find($id);
        if (is_null($post)) {
            return 'Post not found.';
        }
        return view('formEditPost', ['post' => $post]);
    }

    public function showPost($id){
        $post = Post::find($id);
        if (is_null($post)) {
            return 'Post not found.';
        }
        return view('post', ['post' => $post]);
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required|max:255',
            'content' => 'required|max:4000'
        ]);
        if($validator->fails()){
            return 'Validation Error.'.$validator->errors();
        }
        $post = (new Post)->find($input['id']);
        $id_post = $post['id'];
        HelperImage::getImages($request->file(), $id_post);
        $post->title = $input['title'];
        $post->content = $input['content'];
        $post->save();
        return view('formEditPost', ['message' => 'Изменения сохранены', 'post' => $post]);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('my_posts.index');
    }

    public function imageDelete($post_id, $image_id){
        $image = Image::find($image_id);
        $image->delete();
        return redirect()->route('my_posts.show', ['my_post' => $post_id]);
    }

    public function exportExcel(){
        return Excel::download(new PostsExport, 'posts.xlsx');
    }
    public function exportCSV(){
        return Excel::download(new PostsExport, 'posts.csv', \Maatwebsite\Excel\Excel::CSV);
    }
    public function exportXML(){
        $user_id = Auth::user()->id;
        $posts = Post::all()->where('user_id', '=', $user_id)->toArray();
        $formatter = Formatter::make($posts, Formatter::XML);
        Storage::disk('local')->put('posts-'.$user_id.'.xml', $formatter->toXml());
        return response()->download(storage_path('app/posts-').$user_id.'.xml')->deleteFileAfterSend();
    }
}
