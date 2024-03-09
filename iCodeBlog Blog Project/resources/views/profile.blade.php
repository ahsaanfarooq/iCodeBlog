@extends('layouts.main')
@section('main-section')
<style>
    footer{
        position: absolute;
        bottom: 0;
        width: 100%;
    }
</style>
    <div id="profile-picture-container">
        <form action="/upload/{{ session('user_id') }}" method="post" enctype="multipart/form-data">
            @csrf
        
            <input name="image" type="file" id="profile-picture-input" accept="image/*" style="display: none;"
                onchange="previewProfilePicture(event)">
        
            <label for="profile-picture-input" id="profile-picture-label" style="cursor: pointer;">
                <div class="clickToChange"><span style="opacity: 100%;">Change profile picture</span></div>
                <img id="profile-picture-preview" src="{{ session('profile_image') }}"
                    style="border-radius: 400px; overflow: hidden; width:115px; height:115px; border:2px solid #2f2fdf;">
            </label>
        
            <h2>{{ session('username') }}</h2>
            <div class="email" style="color: rgb(172, 172, 172); margin:0;padding:0;margin-bottom: 15px;">
            {{ session('email') }}
            </div>
            <button  class="uploadBtn" type="submit" disabled>Upload</button>
        </form>

    </div>
@endsection
