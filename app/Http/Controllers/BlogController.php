<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function pre(){
        $blog = new Blog();

        $data = $blog->all();

        return view('blog.preview', compact('data'));
    }
}
