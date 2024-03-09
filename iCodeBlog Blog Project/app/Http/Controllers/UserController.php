<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\UserModel;

class UserController extends Controller
{
   public function signup(Request $request)
{
    $request->validate([
        'username' => 'required|unique:users',

        'email_sign' => 'required|email|unique:users,email',
    ]);
    try {

        $user = new UserModel();
        $user->username = $request['username'];
        $user->email = $request['email_sign'];
        $user->password = bcrypt($request['password_sign']);
        $user->user_ip = $request->ip();
        $user->save();

        // Check if the user was successfully saved before setting session variables
        if ($user->exists) {
            // Access the user_id after the user has been saved
            session([
                'username' => $user->username,
                'email' => $user->email,
                'user_id' => $user->user_id, // Access user_id here
                'profile_image' => 'https://icodeblog.great-site.net/storage/images/user-default.avif',
                'is_author' => $user->is_author,
            ]);

            return response()->json(['success' => true]);
        }
    } catch (\Exception $e) {
        return response()->json(['error' => 'Internal Server Error', $e->getMessage()]);
    }
}

    
    public function login(Request $request)
{
    try {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = UserModel::where('email', $request->email)->first();
            session(['username' => $user->username, 'email' => $user->email, 'user_id' => $user->user_id, 'profile_image' => $user->profile_image, 'is_author' => $user->is_author]);
            return response()->json(['success' => 'passed']);
        }else{

            \Illuminate\Support\Facades\Log::info('Attempting to authenticate with credentials:', $credentials);

        }

        return response()->json(['success' => 'failed']);
    } 
    catch (\Exception $e) {
        // Log the error details using Laravel's logger
        \Illuminate\Support\Facades\Log::error('An error occurred during login: ' . $e->getMessage());

        // Return a generic error response
        return response()->json(['success' => 'second_failed', 'error' => 'Internal Server Error']);
    }
}

    public function logout(){
        session()->flush();
        return redirect('/');
    }

}
