<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
//Trait pour envoyer des notifications
use Illuminate\Notifications\Notifiable;
//Notifications pour le client
use App\Notifications\ClientResetPasswordNotification;

class Client extends Authenticatable
{
    use Notifiable;

 //Mass assignable attributes
  protected $fillable = [
      'nom', 'prenom', 'num_tel', 'email', 'password', 'cni', 'date_naissance',
  ];

  //hidden attributes
   protected $hidden = [
       'password', 'remember_token',
   ];    

   public function sendPasswordResetNotification($token){
       $this->notify(new ClientResetPasswordNotification($token));
   }
}
