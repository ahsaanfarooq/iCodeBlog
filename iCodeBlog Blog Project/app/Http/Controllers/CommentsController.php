<?php

namespace App\Http\Controllers;

use App\Models\CommentsModel;
use Illuminate\Http\Request;
use App\Models\PostsModel;

class CommentsController extends Controller
{
    public function addComment(Request $request, $postTitle){
        
        $postTitle = basename(url()->current());
        $title = str_replace('_', ' ', $postTitle);
        $post = PostsModel::where('title', $title)->first();
        $comment = new CommentsModel();
        $comment->comment = $request->comment;
        $comment->username = session('username');
        $comment->profile_image = session('profile_image');
        $comment->post_id = $post->post_id;
        $comment->save();

    
        return response()->json($comment);
        
    
}
    public function getComments($postTitle){
        $title = str_replace('_', ' ', $postTitle);
        $post = PostsModel::where('title', $title)->first();
        $comments = CommentsModel::where('post_id', $post->post_id)->orderBy('created_at', 'desc')->get();
        return  response()->json($comments);
    }
}
