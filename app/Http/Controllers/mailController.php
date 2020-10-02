<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\SetPassword;
use App\Notifications\ApplicationSent;
use App\Notifications\StatusUpdate;
use App\Models\PasswordReset;
use App\Models\User;
use App\Models\Application;
use Auth;
use Illuminate\Support\Str;

class mailController extends Controller
{


  public function setPassword($email){
    $user = Auth::user();
    $notification = new SetPassword;
    $alreadyExists = PasswordReset::where('email', $email)->first();

    if($alreadyExists == null){
      $token = Str::random(40);

      $passwordInsert = new PasswordReset;

      $passwordInsert->email = $email;
      $passwordInsert->token = $token;
      $passwordInsert->save();
    }
    else{
      $token = $alreadyExists->token;
    }

    $user->notify(new SetPassword($token, $email));

    return $notification->toMail('test@example.com');
  }


  public function applicationSent(){
    $notification = new ApplicationSent;
    $user = User::find(4);
    $user->notify(new ApplicationSent);

    return $notification->toMail('test@example.com');

  }

  public function statusUpdate($applicationid){
    $notification = new StatusUpdate;
    $finduserid = Application::find($applicationid)->value('user_id');
    $application = User::find($finduserid);
    $application->notify(new StatusUpdate);

    return $notification->toMail('text@example.com');
  }


}
