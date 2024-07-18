<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function vue()
    {
        $articles = Product::latest()->with('image')->paginate(20);
        return view('welcome', compact('articles'));
    }
}
