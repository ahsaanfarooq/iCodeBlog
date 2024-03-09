<?php

namespace App\Http\Controllers;

use App\Models\PostsModel;
use App\Models\CategoriesModel;

class SitemapController extends Controller
{
    public function index()
    {
        $categories = CategoriesModel::all();
        $posts = PostsModel::all();
        return view('sitemap', compact('categories', 'posts'));

        }
}
