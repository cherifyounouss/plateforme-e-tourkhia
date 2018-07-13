<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//les clients connectes ne peuvent plus acceder a ces pages
Route::group(['middleware' => 'client_out'], function () {

    //Controller : RegisterController, Fonction : showRegistrationForm, affichage du formulaire d'enregistrement d'un client
    Route::get('/enregistrer_client','Client\RegisterController@showRegistrationForm');
    //Controller : RegisterController, Fonction : register, enregistrer un nouveau client
    Route::post('/enregistrer_client','Client\RegisterController@register');
    //Controller : LoginController, Fonction : showLoginForm, affichage du formulaire de connexion    
    Route::get('/client_login','Client\LoginController@showLoginForm');
    //Controller : LoginController, Fonction : login, connecter un client
    Route::post('/client_login','Client\LoginController@login');
    Route::get('/client_password/reset','Client\ForgotPasswordController@showLinkRequestForm');
    Route::post('/client_password/email','Client\ForgotPasswordController@sendResetLinkEmail');
    Route::get('/client_password/reset/{token}','Client\ResetPasswordController@showResetForm');
    Route::post('/client_password/reset','Client\ResetPasswordController@reset');

});

//Les clients non connectes ne peuvent pas acceder a ces pages
Route::group(['middleware' => 'client_in'], function () {
    
    //Controller : LoginController, Fonction : logout, deconnecter un client
    Route::post('/client_logout','Client\LoginController@logout');
    //Renvoie vers la page d'accueil du client connecte
    Route::get('/accueil_client',function(){
        return view('client.accueil');
    });
});