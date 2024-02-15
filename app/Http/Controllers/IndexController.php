<?php

namespace App\Http\Controllers;

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
        $posts = Post::all();
        if (auth()->check()) {
            return Inertia::render('Pages/Home',compact('user', 'posts'));
        }
        return Inertia::render('Auth/Login');
    }
}
