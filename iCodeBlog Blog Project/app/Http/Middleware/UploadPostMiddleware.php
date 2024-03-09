<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UserModel;

class UploadPostMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $another_user = UserModel::find(session('user_id') ?? 1);
   
        if($another_user->is_author == 1){
            return $next($request);
        }else{
            return redirect('/');
        }
    }
}
