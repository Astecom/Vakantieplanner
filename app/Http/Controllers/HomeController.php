<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Notifications\Notifiable;
use Auth;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Hash;


class HomeController extends Controller
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

      dd('test');
        //
        // auth()->user()->assignRole('admin');
        // auth()->user()->assignRole('employer');
        // auth()->user()->assignRole('employee');

    }

    public function newpassword(request $request){
      $accountCheck = PasswordReset::where('email',$request->email)->first();
      $user = User::where('email',$request->email)->first();

      if($request->token == $accountCheck->token && $request->email == $accountCheck->email){
        return view('pages/general/newpassword')->with(['user' => $user]);
      }
    }

    public function submitPassword(request $request){
      $pushpassword = User::find($request->userId);
      $pushpassword->password = Hash::make($request->userPassword);
      $pushpassword->save();
      return redirect('login');

    }

}
