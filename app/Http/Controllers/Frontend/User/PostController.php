<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        return view('frontend.post.index');
    }
}
