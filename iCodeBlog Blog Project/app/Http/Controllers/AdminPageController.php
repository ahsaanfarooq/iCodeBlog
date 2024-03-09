<?php

namespace App\Http\Controllers;

use App\Models\PostsModel;
use Illuminate\Http\Request;
use App\Models\UserModel;
class AdminPageController extends Controller
{
    public function users(){
        $users = UserModel::all();
        return view("admin_users", compact('users'));
    }
    public function posts(){
        $posts = PostsModel::all();
        return view("admin_posts", compact('posts'));
    }
    public function promoteUser($id){
        try{
            $user = UserModel::find($id);
            $user->is_author = 1;
            $user->save();
            return back();
        }catch(\Exception $error){
            return response()->json(['status'=> 'error','message'=> $error->getMessage()]);
        }
       
    }
    public function demoteUser($id){
        try{
            $user = UserModel::find($id);
            $user->is_author = 0;
            $user->save();
            return back();
        }catch(\Exception $error){
            return response()->json(['status'=> 'error','message'=> $error->getMessage()]);
        }
       
    }
    public function deletePost($id){
        try{
            $post = PostsModel::find($id);
            $post->delete();
            return back();
        }catch(\Exception $error){
            return response()->json(['status'=> 'error','message'=> $error->getMessage()]);
        }
       
    }
}
