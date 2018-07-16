<?php

//Ce middleware permet de resteindre l'acces aux clients connectes

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckClientConnecte
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Si le client connecte essaies d'acceder aux pages de login ou de registration on le redirige vers l'accueil
        if(Auth::guard('client')->check()){
            return redirect('/accueil_client');
        }
        return $next($request);

    }
}
