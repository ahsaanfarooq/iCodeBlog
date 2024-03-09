<?php

use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\LoginWithGoogle;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileImageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\SitemapController;

use Illuminate\Support\Facades\Auth;
use App\Models\PostsModel;
use App\Models\CommentsModel;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $posts = PostsModel::latest()->take(10)->get();
$count_comments = CommentsModel::all();

    return view('home', compact("posts", "count_comments"));
});
Route::get('/blog', function () {
$posts = PostsModel::latest()->paginate(10);

$count_comments = CommentsModel::all();

    return view('blog', compact("posts", "count_comments"));
});

Route::post('/', [UserController::class, 'signup'])->name('signup.user');
Route::post('/login', [UserController::class, 'login'])->name('login.user');
Route::get('/logout', [UserController::class, 'logout'])->name('logout.user');

Route::post('/check-email', [UserController::class, 'checkEmailAvailability']);
Route::post('/check-username', [UserController::class, 'checkUsernameAvailability']);

Route::get('/post/{title}', [PostsController::class, 'viewSinglePost']);
Route::get('/posts/{title}', [CommentsController::class, 'getComments']);
Route::post('/post/{title}', [CommentsController::class, 'addComment']);

Route::get('/selected_post/{categoryName}', [SearchController::class, 'selectCategory']);
Route::get('/search', [SearchController::class, 'search']);

Route::get('profile', function(){
    return view('profile');
})->middleware('profile_block_middleware');
Route::get('/upload/post', function(){
    return view('create_post');
})->middleware('is_author');


Route::post('/upload/{id}', [ProfileImageController::class, 'store']);
Route::post('/create_post', [PostsController::class, 'createPost']);
Route::post('/update_post/{id}', [PostsController::class, 'updatePost']);
Route::get('/post/{title}/edit', [PostsController::class, 'editPost'])->middleware('is_author');


Route::get('/sitemap.xml', [SitemapController::class, 'index']);

Route::get('/admin/posts', [AdminPageController::class,'posts'])->middleware('is_admin');
Route::get('/admin/users', [AdminPageController::class,'users'])->middleware('is_admin');
Route::post('/promote/{id}', [AdminPageController::class,'promoteUser']);
Route::post('/demote/{id}', [AdminPageController::class,'demoteUser']);
Route::post('/delete/{id}', [AdminPageController::class,'deletePost']);
Route::get('/ip', [PostsController::class,'getCountryInfo']);

// Login with Google
Route::get('auth/google/', [LoginWithGoogle::class, 'loginWithGoogle'])->name('login_with_google');
Route::get('auth/google/callback', [LoginWithGoogle::class, 'googleRedirect'])->name('googleRedirect');