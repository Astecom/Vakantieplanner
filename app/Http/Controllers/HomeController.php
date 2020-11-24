<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

use Carbon\Carbon;


class homeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    use Notifiable;

    public function __construct()
    {
        //$this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

    }

    // Create a new password e-mail and sent it to the users email adress
    public function newpassword(request $request){
      $accountCheck = PasswordReset::where('email',$request->email)->first();
      $user = User::where('email',$request->email)->first();

      if($request->token == $accountCheck->token && $request->email == $accountCheck->email){
        return view('pages/general/newpassword')->with(['user' => $user]);
      }
    }

    // Submit the new hashed password to the database
    public function submitPassword(request $request){
      $pushpassword = User::find($request->userId);
      $pushpassword->password = Hash::make($request->userPassword);
      $pushpassword->save();
      return redirect('login');

    }

    public function forgotPassword(){
      return view('auth\passwords\forgotpassword');
    }

    public function resetPassword(request $request){
      $user = User::where('email',$request->email)->first();
      app('App\Http\Controllers\mailController')->setPassword($user->email);
      return redirect('login');
    }

}
