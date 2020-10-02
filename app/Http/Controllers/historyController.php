<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\User;
use App\Models\status;
use App\Models\applicationStatus;
use Auth;
use Illuminate\Support\Facades\Hash;

class historyController extends Controller
{
    public function index(Request $request){
      $userid = Auth::user()->id;
      $applicationdatas = Application::where('user_id', $userid);

      if($request->has('searchUser')){
        $applicationdatas->whereHas('application_type', function ($query) use ($request) {
          return $query->where('name', 'like', '%' . $request->searchUser . '%');
        });
      }

      $result = $applicationdatas->orderBy('status_id','ASC')->paginate(7);

      return view('pages/history/history',['applicationdatas'=>$result, 'data'=>$request]);
    }

    public function historyview($get_id){
      $statuses = ApplicationStatus::where('active',1)->get();
      $applicationinfo = Application::find($get_id);
      return view('pages/history/historyview',['applicationinfo'=>$applicationinfo, 'statuses'=>$statuses]);
    }

}
