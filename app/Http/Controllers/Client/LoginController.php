<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//Auth facade
use Auth;

class LoginController extends Controller
{
    protected $redirectTo = '/accueil_client';

    //Trait
    use AuthenticatesUsers;

    // protected $redirectAfterLogout = '/enregistrer_client';


    //Overriding guard method because we logout a customer not a user

    protected function guard(){
        return Auth::guard('client');
    }

    public function showLoginForm(){
        return view('client.auth.login');
    }

}
