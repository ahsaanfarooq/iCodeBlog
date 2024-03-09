<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostsModel;
use App\Models\QuestionsModel;
use App\Models\CommentsModel;
use Illuminate\Support\Facades\Http;
class PostsController extends Controller
{
    public function createPost(Request $request){
        try {
            $post = new PostsModel();
            $post->title = $request->post_title;
            $post->desc = $request->post_description;
            $post->category_name = $request->post_category;
            $post->author_name = session('username');
            $post->save();
            return redirect('/');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while creating the post');
        }
    }
    
    public function updatePost(Request $request, $id){
        try {
            $post = PostsModel::find($id);
            $post->title = $request->post_title;
            $post->desc = $request->post_description;
            $post->category_name = $request->post_category;
            $post->author_name = session('username');
            $post->save();
            $title = str_replace(' ', '_', $post->title);
            $postLink =  url('') .'/post/'. $title;
            return redirect($postLink);
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while creating the post');
        }
    }
    
    public function postView(Request $request){
        $posts = PostsModel::latest()->take(10)->get();
        $count_comments = CommentsModel::all();

        return view("home", compact("posts", $count_comments));
    }
    public function viewSinglePost($postTitle){
        $title = str_replace('_', ' ', $postTitle);

        $post = PostsModel::where('title', $title)->first();
        $questions = QuestionsModel::where('post_id', $post->post_id)->get();
        return view('read_post', compact('post', 'questions'));
    }
    
    public function editPost(Request $request, $postTitle){
        $title = str_replace('_', ' ', $postTitle);
        $post = PostsModel::where('title', $title)->first();
        return view('edit_post', compact('post'));
    }

    public function getCountryInfo(Request $request) {
        $apiKey = 'e6f07bcd0c9b8d9f1ac30d0d74a0367e';
        $ipAddress = $request->ip();
    
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->get("https://api.freegeoip.app/json/{$ipAddress}");
    
        $data = $response->json();
        return $data;
        
    }
    
}
