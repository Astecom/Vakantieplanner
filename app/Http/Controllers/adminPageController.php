<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Notifications\SetPassword;

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

    // Verstuur de pagina naar useredit met de juiste data.
    public function editUser($user_id){
      $edits = User::find($user_id);
      $roles = Role::all();
      return view('pages/admincontrol/useredit',['edits'=>$edits, 'roles'=>$roles]);

    }

    // Verstuur de data die aangepast word in de editpage naar de database
    public function editSubmit(request $request, $user_id){
      $editrequest = User::find($user_id);

      if($request->password != null){
        $editrequest->password = Hash::make($request->password);
      }

      $editrequest->name = $request->userName;
      $editrequest->email = $request->email;
      $editrequest->save();
      return redirect()->route('adminpage');
    }

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
      $getuserid = User::where('email', $request->email)->first();

      return redirect()->route('adminpage');
    }


    public function endeditrights(request $request, $user_id){
      $user = User::find($user_id);
      $user->removeRole('employee');
      $user->removeRole('employer');
      $user->removeRole('admin');


      if($request->workerType == 1){
        $user->assignRole('employee');
      }
      elseif($request->workerType == 2){
        $user->assignRole('employer');
      }
      elseif($request->workerType == 3){
        $user->assignRole('admin');
      }

      $user->active = $request->active;
      $user->save();

      return redirect()->route('adminpagesendedit', $user_id);

    }

}
