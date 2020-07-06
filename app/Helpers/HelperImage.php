<?php
namespace App\Helpers;
use App\Image;

class HelperImage{
    public static function getImages($files, $id_post) {
        foreach ($files as $file) {
            foreach ($file as $f) {
                $model = new Image;
                $name = $id_post.'_'.$f->getClientOriginalName();
                $f->move(storage_path('app/public/images/'.$id_post), $name);
                $model->title = $name;
                $model->post_id = $id_post;
                $model->save();
            }
        }
    }
}