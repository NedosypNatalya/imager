<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Posts;
use App\User;
use App\Http\Requests\PostRequest;
use App\Image;
use Validator;
use App\Exports\PostsExport;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\ArrayToXml\ArrayToXml;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use SoapBox\Formatter\Formatter;
use Response;

class PostController extends Controller
{
    public function index()
    {
        $posts = Posts::all()->where('user_id', '=', Auth::user()->id);
        //$images = Posts::find(1)->images()->where('user_id', '=', Auth::user()->id);
        foreach ($posts as $post) {
           // $post['images'] = Posts::find($post->id)->images();
            $post['images'] = Image::all()->where('post_id', '=', $post->id);
            
        }
        
        return view('posts', ['posts' => $posts]);
    }

    public function create(){
        return view('formCreatePost');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $post = Posts::create($input);
        $id_post = $post['id'];
        foreach ($request->file() as $file) {
            foreach ($file as $f) {
                $model = new Image;
                $name = $id_post.'_'.$f->getClientOriginalName();
                $f->move(storage_path('app/public/images/'.$id_post), $name);
                $model->title = $name;
                $model->post_id = $id_post;
                $model->save();
            }
        }
        return redirect()->route('posts.index');
    }

    public function show($id)
    {
        $post = Posts::find($id);
        if (is_null($post)) {
            return 'Post not found.';
        }
        $post['images'] = Image::all()->where('post_id', '=', $post->id);
        return view('formEditPost', ['post' => $post]);
    }

    public function update(Request $request)
    { 
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required|max:255',
            'content' => 'required|max:1000'
        ]);
        if($validator->fails()){
            return 'Validation Error.'.$validator->errors();       
        }
        $post = (new Posts)->find($input['id']);
        $id_post = $post['id'];
        foreach ($request->file() as $file) {
            foreach ($file as $f) {
                $model = new Image;
                $name = $id_post.'_'.$f->getClientOriginalName();
                $f->move(storage_path('app/public/images/'.$id_post), $name);
                $model->title = $name;
                $model->post_id = $id_post;
                $model->save();
            }
        }

        $post->title = $input['title'];
        $post->content = $input['content'];
        $post->save();
        $post['images'] = Image::all()->where('post_id', '=', $post->id);
        return view('formEditPost', ['message' => 'Изменения сохранены', 'post' => $post]);
    }

    public function destroy($id)
    {
        $post = Posts::find($id);
        $post->delete();
        return redirect()->route('posts.index');
    }

    public function imageDelete($post_id, $image_id){
        $image = Image::find($image_id);
        $image->delete();
        return redirect()->route('posts.show', ['post' => $post_id]);
    }

    public function exportExcel(){
        return Excel::download(new PostsExport, 'posts.xlsx');
    }
    public function exportCSV(){
        return Excel::download(new PostsExport, 'posts.csv', \Maatwebsite\Excel\Excel::CSV);
    }
    public function exportXML(){
        $posts = Posts::all()->where('user_id', '=', Auth::user()->id)->toArray();
        //$result = ArrayToXml::convert(['__numeric' => $posts]);
        $formatter = Formatter::make($posts, Formatter::XML);
        //$export = var_export($formatter->toXml());
        // $export = var_export($formatter->toArray());
        // dd($formatter->toXml());
        // return var_export($formatter->toXml());\
        // Storage::putFile($formatter, new File('app/public/files/posts.xml'), 'posts.xml');
        Storage::put("app/public/files/posts.xml", $formatter);
        return response()->download(/*storage_path(*/'app/public/files/'/*)*/.'posts.xml')->deleteFileAfterSend();
        //return Response::download($formatter->toXml(), 'export.xml', ['Content-Type: text/xml']);

      
    }
}
