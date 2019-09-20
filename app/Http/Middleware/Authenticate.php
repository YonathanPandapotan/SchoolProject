<?php

namespace App\Http\Middleware;

use App\UserModel;
use Closure;
use Illuminate\Support\Facades\Session;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        // $user = UserModel::where('email', $request->email)->first();
        if(!Session::get('login')){
            return redirect('/login');
        }
        return $next($request);
    }
}
