<?php
namespace App\Helpers;
use App\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HelperImage{

   
    public static function getImages($files, $images = [], $table_id, $table_type) {
        $extensions = ['jpg', 'jpeg', 'png'];
        foreach ($files as $file) {
            $extension = $file->getClientOriginalExtension();
            if(! in_array($extension, $extensions) ){
                continue;
            }
            $model = new Image;
            $name = time().'_'.$file->getClientOriginalName();
            $file->storeAs('/public/images/',$name);
            $model->title = $name;
            $model->user()->associate(Auth::user());
            $model->table_id = $table_id;
            $model->table_type = $table_type;
            $model->save();
            $images[] = $model;
        }
    }
}