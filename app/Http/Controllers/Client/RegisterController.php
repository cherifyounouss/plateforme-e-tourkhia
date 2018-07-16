<?php

namespace App\Http\Controllers\Client;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Client Model
use App\Client;
//Auth
use Auth;

//Controlleur pour permettre l'enregistrement de nouveaux clients
class RegisterController extends Controller
{
    //redirection vers la page d'accueil
    protected $redirectPath = '/accueil_client';

    //
    public function showRegistrationForm(){
        return view('client.auth.register');
    }

    public function register(Request $request){
        
        //Valider les donnees
        $this->validator($request->all())->validate();
        //Enregistrer les donnees
        $client = $this->create($request->all());
        //Login user
        Auth::guard('client')->login($client);        
        //Redirection
        return redirect($this->redirectPath);

    }

    protected function validator(array $data){
    //messages
        $messages = [
            'alpha' => 'Veuillez entrer un :attribute valide',
            'num_tel.digits' => 'Veuillez entrer un numero valide',
            'confirmed' => 'Les deux mots de passe ne sont pas identiques',
        ];        
        return Validator::make($data, [
            'nom' => 'required|max:100|alpha',
            'prenom' => 'required|max:100|alpha',
            'email' => 'email',
            'num_tel' => 'digits:9',
            'cni' => 'numeric',
            'password' => 'required|min:6 confirmed',

        ], $messages);
    }

    protected function create(array $data){
        return Client::create([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'num_tel' => $data['num_tel'],
            'cni' => $data['cni'],
            'date_naissance' => $data['birth'],
            'password' => bcrypt($data['password']),
        ]);
    }

    //Guard pour l'authentification des clients
    protected function guard(){
        return Auth::guard('client');
    }
}
