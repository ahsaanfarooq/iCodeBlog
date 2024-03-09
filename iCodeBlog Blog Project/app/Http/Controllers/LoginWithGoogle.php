<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginWithGoogle extends Controller
{
    public function loginWithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleRedirect()
    {
        try {
            $user = Socialite::driver('google')->user();
            $isUser = UserModel::where('email', $user->getEmail())->first();
            if (!$isUser) {
                $newUser = new UserModel();
                $newUser->google_id = $user->getId();
                $newUser->username = $user->getName();
                $newUser->email = $user->getEmail();
                $newUser->password = Hash::make($user->getName() . '@' . $user->getId());
                $newUser->save();
                if($newUser->exists()){
                session([
                    'username' => $newUser->username,
                    'email' => $newUser->email,
                    'user_id' => $newUser->user_id,
                    'profile_image' => 'https://icodeblog.great-site.net/storage/images/user-default.avif',
                    'is_author' => $newUser->is_author
                ]);
                }
                return redirect('/');
            } else {
                UserModel::where('email', $user->getEmail())->update(['google_id' => $user->getId()]);

                session([
                    'username' => $isUser->username,
                    'email' => $isUser->email,
                    'user_id' => $isUser->user_id, // Access user_id here
                    'profile_image' => 'https://icodeblog.great-site.net/storage/images/user-default.avif',
                    'is_author' => $isUser->is_author,
                ]);
                return redirect('/');
            }


        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
