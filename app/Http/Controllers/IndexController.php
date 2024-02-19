<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Post;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function index(): \Inertia\Response
    {
        $user = new UserResource(auth()->user());
        $posts = PostResource::collection(Post::with('attachments')->get());
        if (auth()->check()) {
            return Inertia::render('Pages/Home',compact('user', 'posts'));
        }
        return Inertia::render('Auth/Login');
    }
}
