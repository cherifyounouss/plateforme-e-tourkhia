<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//trait
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

//Password Broker Facade
use Illuminate\Support\Facades\Password;

use Auth;

class ForgotPasswordController extends Controller
{
    //
    use SendsPasswordResetEmails;

    public function showLinkRequestForm(){
        return view('client.password.email');
    }
    //On redefinie la methode broker
    protected function broker(){
        return Password::broker('clients');
    }


}
