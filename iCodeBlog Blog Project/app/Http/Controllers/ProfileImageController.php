<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;

class ProfileImageController extends Controller
{
    public function store(Request $request, $id)
    {
        if ($request->hasFile("image")) {
            $image = $request->file("image");
    
            // Use a unique filename to avoid overwriting existing files
            $imageName = uniqid() . '_' . $image->getClientOriginalName();
    
            // Use public_path() to get the absolute path to the public directory
            $publicPath = public_path('images');
    
            // Move the file to the public/images directory
            $image->move($publicPath, $imageName);
    
            // Generate the URL for the stored image
            $imageLocation = url('') . "/images/" . $imageName;
    
            // Update the user's profile image path in the database
            $user = UserModel::find($id);
            $user->profile_image = $imageLocation;
            $user->save();
    
            // Store the image URL in the session
            session(['profile_image' => $imageLocation]);
    
            return back();
        } else {
            return back();
        }
    }
    
    




}
