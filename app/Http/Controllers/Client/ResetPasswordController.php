<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{

    protected $redirectTo = '/accueil_client';

    //trait pour gerer la reinitialisation du mot de passe
    use ResetsPasswords;

    //retourne la vue sur le formulaire de saisie du nouveau mot de passe
    public function showResetForm(Request $request, $token = null)
    {
        return view('client.password.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function broker(){
        return Password::broker('clients');
    }

    protected function guard(){
        return Auth::guard('client');
    }
}
