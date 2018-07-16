<?php

//Ce middleware permet de restreindre l'acces aux clients non connectes ou aux invites
//Permettant ainsi aux clients connectes d'avancer dans les prochaines couches de l'application

namespace App\Http\Middleware;

use Closure;

use Auth;

class ClientConnecte
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
        //On verifie si l'utilisateur n'est pas connecte
        //S'il ne l'est pas, il est redirige vers la page de login
        if(!Auth::guard('client')->check()){
            return redirect('/client_login');
        }
        return $next($request);
    }
}
