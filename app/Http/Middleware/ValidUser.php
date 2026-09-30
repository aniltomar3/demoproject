<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ValidUser
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $email): Response
    {
        echo "<h3 class='text-primary'>We are now in valid user middleware ".$email."</h3>";
        
        if(Auth::check() && Auth::user()->email==$email){
            return $next($request);
        }else{
        return redirect()->route('login')->withErrors(['email'=>'Unauthorise attempt for login']);;
        }
    }

    public function terminate(Request $request, Response $response):void{
        echo "<h3 class='text-danger'>We are now terminating valid user middleware</h3>";
    }
}
