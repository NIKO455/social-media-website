<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function index(): \Inertia\Response
    {
        if (auth()->check()) {
            return Inertia::render('Pages/Home');
        }
        return Inertia::render('Auth/Login');
    }
}
