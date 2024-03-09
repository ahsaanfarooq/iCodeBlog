<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="google-site-verification" content="Vp0r-PXde2E_lcO7SsguOkt76zylciYhityiSSQ3TKA" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ url('') . '/Styles_and_logics/images/favicon.png' }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ url('') . '/Styles_and_logics/' }}style.css">
    <link rel="stylesheet" href="{{ url('') . '/Styles_and_logics/' }}mobile.css" media="screen and (max-width: 763px)">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>

    <div class="header">
        <nav class="header-nav">
            <div>
                <a class="hdr-nv-a logo" href="{{ url('/') }}">iC0deBlog</a>
                <a class="hdr-nv-a active-1 underline-effect" href="{{ url('/') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="latest-svg" width="14" height="13"
                        viewBox="0 0 16 16">
                        <path fill="white"
                            d="M1.5 0A1.5 1.5 0 0 0 0 1.5v2A1.5 1.5 0 0 0 1.5 5h13A1.5 1.5 0 0 0 16 3.5v-2A1.5 1.5 0 0 0 14.5 0zm1 2h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1m9.927.427A.25.25 0 0 1 12.604 2h.792a.25.25 0 0 1 .177.427l-.396.396a.25.25 0 0 1-.354 0zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5" />
                    </svg>
                    Latest<div class="line-progress l-p1"></div></a>
                <a class="hdr-nv-a active-2 underline-effect topics" id="topics">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 20 20"
                        class="topics-svg">
                        <path fill="white"
                            d="M3.497 15.602a.7.7 0 1 1 0 1.398H.7a.7.7 0 1 1 0-1.398zm15.803 0a.7.7 0 1 1 0 1.398H5.529a.7.7 0 1 1 0-1.398zM3.497 9.334a.7.7 0 1 1 0 1.399H.7a.7.7 0 1 1 0-1.399zm15.803 0a.7.7 0 1 1 0 1.399H5.528a.7.7 0 1 1 0-1.399zM3.497 3a.7.7 0 1 1 0 1.398H.7A.7.7 0 1 1 .7 3zM19.3 3a.7.7 0 1 1 0 1.398H5.528a.7.7 0 1 1 0-1.398z" />
                    </svg>
                    Topics<div class="line-progress l-p2"></div></a>
                <a class="hdr-nv-a active-9 underline-effect" class="latest-svg" href="{{ url('/blog') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="13" viewBox="0 0 16 16">
                        <path fill="#ffffff"
                            d="M6 0v1.5a8.46 8.46 0 0 1 6.01 2.489a8.472 8.472 0 0 1 2.489 6.01h1.5c0-5.523-4.477-10-10-10z" />
                        <path fill="#ffffff"
                            d="M6 3v1.5c1.469 0 2.85.572 3.889 1.611S11.5 8.531 11.5 10H13a7 7 0 0 0-7-7m1.5 3l-1 1L3 8l-3 6.5l.396.396l3.638-3.638a1 1 0 1 1 .707.707l-3.638 3.638l.396.396l6.5-3l1-3.5l1-1l-2.5-2.5z" />
                    </svg>
                    Blog<div class="line-progress l-p9"></div></a>
                @php
                    use App\Models\UserModel;
                    $another_user = UserModel::find(session('user_id') ?? 1);

                @endphp
                @if ($another_user->is_author == 1)
                    <a href="{{ url('/') }}/upload/post" class="createPostBtn">Add Post</a>
                    <a href="{{ url('/') }}/admin/posts" class="createPostBtn2">Admin</a>
                @endif
            </div>
            <div class="search-container">
                <label for="search-questions">
                    <svg class="search-svg" xmlns="http://www.w3.org/2000/svg" width="64" height="64"
                        viewBox="0 0 24 24">
                        <path fill="white"
                            d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396l1.414-1.414l-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8s3.589 8 8 8m0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6s-6-2.691-6-6s2.691-6 6-6" />
                        <path fill="white"
                            d="M11.412 8.586c.379.38.588.882.588 1.414h2a3.977 3.977 0 0 0-1.174-2.828c-1.514-1.512-4.139-1.512-5.652 0l1.412 1.416c.76-.758 2.07-.756 2.826-.002" />
                    </svg></label>
                <form action="/search" method="get" id="searchform" onsubmit="return validateForm()">
                    <input type="search" value="{{ isset($search) ? $search : '' }}" name="search-questions"
                        id="search-questions" class="search-questions" placeholder="Search posts">
                </form>

                <script>
                    function validateForm() {
                        var searchInput = document.getElementById('search-questions').value.trim();
                        if (searchInput === '') {
                            return false;
                        }
                        return true;
                    }
                </script>

                @if (session()->has('user_id'))
                    <div class="user-profile-menu" id="profile-btn">
                        <img src="{{ session('profile_image') }} ">
                    </div>
                @else
                
                  

                    <div class="accountBtns2" id="btn1">
                        <svg style="margin-right: 4px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                            viewBox="0 0 512 512">
                            <path fill="white"
                                d="M256 288c79.5 0 144-64.5 144-144S335.5 0 256 0S112 64.5 112 144s64.5 144 144 144m128 32h-55.1c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16H128C57.3 320 0 377.3 0 448v16c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48v-16c0-70.7-57.3-128-128-128" />
                        </svg> Login
                    </div>
                    <div id="btn3" class="accountBtns">Join</div>
                @endif



            </div>
        </nav>

    </div>
    <div class="profile-menu-box" id="profile-menu-box">
        <div class="profile_username_email_container">
            <div class="user-profile-menu2">
                <img src="{{ session('profile_image') }}">
            </div>
            <div class="username_and_email">
                <div class="profile_username" href="#">{{ session('username') }}</div>
                <div class="profile_email" href="#">{{ session('email') }}</div>
            </div>
        </div>
        <hr class="sep">
        <div id="profile_btn" class="pofile_btn profile_menu_btn"><a style="color: white; text-decoration:none;"
                href="{{ url('/profile') }}">Profile</a></div>
        <div id="logout_btn" class="logout_btn profile_menu_btn" href="#">Logout</div>
    </div>
    <div class="topics-box" id="topics-box">

        @php
            use App\Models\CategoriesModel;

            $categories = CategoriesModel::all();
        @endphp

        @foreach ($categories as $category)
            <a href="{{ url('/selected_post') . '/' . $category->category }}" class="topics-box-a">
                <div>{{ $category->category }}</div>
            </a>
        @endforeach


    </div>
    <div id="overlay"></div>
    <div id="modal">
        <div class="login-modal">
            <h2 style="text-align: center;margin-top: 30px;">Login</h2>
            <form action="/login" method="post" id="loginForm">
                @csrf
                <div class="login-form">

                    <div id="credentials_error"></div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="email" placeholder="Email"
                        required>
                </div>

                <div class="login-form">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="password" placeholder="Password"
                        required>
                </div>
                <div id="remember-me-checkbox">
                    <input type="checkbox" id="remember-me" name="remember-me">
                    <label for="remember-me" id="remember-me-label">Remember Me</label>
                </div>
                <button id="loginButton" type="submit" class="login-button">Login</button>
                <button onclick="closeModel()" class="login-button"
                    style="background-color: rgb(202, 3, 3);margin-left: 6px;">Close</button>
<button onclick="window.location.href = '{{ route('login_with_google') }}'" type="button" class="login-with-google-btn" >
                        Sign in with Google
                        </button>
            </form>
        </div>
    </div>
    <div id="modal-2">
        <div class="signup-modal" id="signup_modal">
            <div id="success-message"
                style="display: none; text-align: center; margin-top: 20px; margin: auto 0; width: 50%;">
                <p style="font-size: 18px; padding: 10px; margin-bottom: 5px; color: green;">Your account has been
                    successfully created!</p>
                <button id="go-to-home"
                    style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">Go
                    to Home</button>
            </div>
            <h2 id="createH" style="text-align: center;margin-top: 10px;margin-bottom: 10px;">Create New Account
            </h2>
            <form action="/" method="post" id="signupForm">
                @csrf


                <div class="signup-form">

                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" class="username"
                        placeholder="Enter your full name" required>
                    <div id="username_err" style="color: red;"> </div>

                </div>
                <div class="signup-form">

                    <label for="email_sign">Email:</label>
                    <input type="email" id="email_sign" name="email_sign" class="email_sign"
                        placeholder="Enter your email" required>
                    <div id="email_err" style="color: red;"> </div>

                </div>

                <div class="signup-form">

                    <label for="password_sign">Password:</label>
                    <input type="password" id="password_sign" name="password_sign" class="password_sign"
                        placeholder="Password" required>
                </div>
                <div class="signup-form">

                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="password_confirmation" placeholder="Type your password again" required>
                    <div id="confirm-error">Password do not match</div>
                </div>


                <button type="submit" id="signup_btn" class="signup-button">Create</button>
                <button id="signupBtn" onclick="closeModel2()" class="login-button"
                    style="background-color: rgb(202, 3, 3);margin-left: 6px;">Close</button>

                    <button onclick="closeModel()" class="login-button"
                    style="background-color: rgb(202, 3, 3);margin-left: 6px;">Close</button>
<button onclick="window.location.href = '{{ route('login_with_google') }}'" type="button" class="login-with-google-btn" >
                        Sign up with Google
                        </button>
            </form>
        </div>
    </div>

    <div id="logoutShade" class="shade">
        <p>Logging Out...</p>
    </div>
