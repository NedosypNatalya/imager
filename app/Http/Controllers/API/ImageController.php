<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Image;
use Validator;

class ImageController extends BaseController
{
    public function store(Request $request){
        foreach ($request->file() as $file) {
            foreach ($file as $f) {
                $model = new Image;
                $name = time().'_'.$f->getClientOriginalName();
                $f->move(storage_path('app/public/images'), $name);
                $model->title = $name;
                $model->user_id = 1;
                $model->save();
            }
        }
        return $this->sendResponse($request->toArray(), 'Images loaded successfully.');
    }
}
