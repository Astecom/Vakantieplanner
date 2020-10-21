<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Auth;


// Sent data to the standard admin page with pagination and active users only
class adminPageController extends Controller
{
    public function index(Request $request){
      $getusers = User::query();

      if($request->has('searchUser')){
        $getusers->where('email', 'like', '%' . $request->searchUser . '%');
      }

      $result = $getusers->where('active',1)->paginate(7);

      return view('pages/admincontrol/adminpage', ['getusers'=>$result ,'data'=>$request]);
    }


    // Edit, Delete  and Submit the user
    public function deleteUser($user_id){

      $userdelete = User::find($user_id);
      $userdelete->delete();
      return redirect()->route('adminpage');

    }

    // Edit the selected user with the right parameters
    public function editUser($user_id){
      $edits = User::find($user_id);
      $roles = Role::all();
      return view('pages/admincontrol/useredit',['edits'=>$edits, 'roles'=>$roles]);

    }



    // Sent the edit information of the selected user to the database
    public function editSubmit(request $request, $user_id){
      $user = User::find($user_id);
      $user->removeRole('employee');
      $user->removeRole('employer');

      if($request->workerType == 1){
        $user->assignRole('employee');
      }
      elseif($request->workerType == 2){
        $user->assignRole('employer');
      }

      if($request->password != null){
        $user->password = Hash::make($request->password);
      }

      $user->name = $request->userName;
      $user->email = $request->email;
      $user->active = $request->active;
      $user->save();

      return redirect()->route('adminpage');
    }


    // Add a new user to the database
    public function adminpagesadd(request $request){
      $validatedDataColums = $request->validate([
        'userName' => ['required', 'min:3', 'max:30'],
        'email' => ['required', 'min:5', 'max:30', 'email'],
      ]);


      $addrequest = new User;
      $addrequest->name = $request->userName;
      $addrequest->email = $request->email;
      $addrequest->password = 'NotActive';
      $addrequest->active = '1';
      $addrequest->save();
      $addrequest->assignRole('employee');
      app('App\Http\Controllers\mailController')->setPassword($request->email);
      $userMail = User::where('email', $request->email)->first();

      return redirect()->route('adminpage');
    }




}
