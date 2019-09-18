<?php

namespace App\Http\Middleware;

use App\UserModel;
use Closure;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        $user = UserModel::where('email', $request->email)->first();
        if($user == null){
            return redirect('/login');
            // return response('its working');
        }
        return $next($request);
    }
}
