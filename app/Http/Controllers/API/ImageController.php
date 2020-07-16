<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Image;

class ImageController extends BaseController
{
    /**
     * Delete image.
     *
     * @param App\Image $image
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        $image = Image::find($id);
        if(! $image || $image->user_id != Auth::user()->id){
            return $this->sendError('Image not found.');
        }
        $image->delete();
        return $this->sendResponse($image->toArray(), 'Image deleted successfully.');
    }
}
