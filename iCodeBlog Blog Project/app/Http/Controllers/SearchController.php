<?php

namespace App\Http\Controllers;

use App\Models\PostsModel;
use App\Models\QuestionsModel;
use Illuminate\Http\Request;
use App\Models\CommentsModel    ;
class SearchController extends Controller
{
    public function selectCategory($categoryName){
        $posts = PostsModel::where('category_name', $categoryName)->get();
        $count_comments = CommentsModel::all();
        return view('selected_category', compact('posts', 'count_comments'));
    }
    public function search(Request $request){
        $search = $request->input('search-questions');
        $posts = PostsModel::where('title', 'like', '%'.$search.'%')->get();
        $questions = QuestionsModel::where('question', 'like',  '%'.$search.'%')->get();
        $allPosts = PostsModel::all();
        $count_comments = CommentsModel::all();
        return view('search_results', compact('posts','questions', 'search', 'count_comments', 'allPosts'));
    }
}
