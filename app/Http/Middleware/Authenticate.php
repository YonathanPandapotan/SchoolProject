<?php

namespace App\Http\Middleware;

use App\UserModel;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        // $auth_token = $request->cookie('auth_token');
        // if($auth_token != null){
            // $user = UserModel::where('auth_token', $auth_token)->first();
            // if(!empty($user)){
                // $request->request->add(['userId' => $user->id]);
            // }
        // }
        // else{
            // return redirect('/login');
        // }

        if(!$request->session()->get('login') == 'true'){
            return redirect('/login');
        }

        return $next($request);
    }
}
