<?php

namespace App\Exports;

use App\Posts;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Auth;

class PostsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Posts::all()->where('user_id', '=', Auth::user()->id);
    }
}
