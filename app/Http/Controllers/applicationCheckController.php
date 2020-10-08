<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\ApplicationStatus;
use Spatie\GoogleCalendar\Event;
use App\Models\User;
use Auth;
use Carbon\Carbon;

class applicationCheckController extends Controller
{

    // Sent data to the standard page with pagination and multiple search function as active users only
    public function index(Request $request){
      $getuserinfo = User::where('active',0)->get();
      $applicationdatas = Application::query();
      $applicationstatus = ApplicationStatus::pluck('name');

      if($request->has('searchUser')){
        $applicationdatas->whereHas('user', function ($query) use ($request) {
          return $query->where('name', 'like', '%' . $request->searchUser . '%');
        });
      }

      $applicationdatas->whereHas('user', function ($query) {
        return $query->where('active', 1);
      });

      $currentuser = Auth::user();

      if(Auth::user()->hasRole('employer')){
        $result = $applicationdatas->orderBy('status_id','ASC')->paginate(7);
      }
      else if(Auth::user()->hasRole('employee')){
        $result = $applicationdatas->orderBy('status_id','ASC')->where('user_id',$currentuser->id)->paginate(7);
      }


      return view('/pages/applicationcheck/applicationcheck', ['applicationdatas'=>$result, 'data'=>$request]);
    }


    // Function to sent to right detials to the edit application page
    public function editapplication($get_id){
      $statuses = ApplicationStatus::where('active',1)->get();
      $applicationinfo = Application::find($get_id);
      return view('/pages/applicationcheck/applicationcheckedit',['applicationinfo'=>$applicationinfo, 'statuses'=>$statuses]);
    }


    // Function to edit the status with the 2 active buttons on the edit application page
    public function status(request $request, $id){
      $statusupdate = Application::find($id);
      $statusupdate->status_id = $request->buttonstatus;
      $statusupdate->application_status_remark = $request->formRemark;
      $statusupdate->save();
      app('App\Http\Controllers\mailController')->statusUpdate($id);

      if($request->buttonstatus == '2'){
        $newEvent = new Event;
        $newEvent = Event::create([
          'name' => 'Verlof '. Auth::user()->name,
          'startDateTime' => Carbon::parse($statusupdate->date_from),
          'endDateTime' => Carbon::parse($statusupdate->date_till),
        ]);

        $statusupdate->google_calander_id = $newEvent->id;
        $statusupdate->save();

      }else if($request->buttonstatus == '3'){
        $deletecalanderid = Application::find($id);
        $eventId = $deletecalanderid->google_calander_id;

        if($eventId != null){
          $event = Event::find($eventId);
          $event->delete();
        }

      }

      return redirect()->route('applicationcheckedit',$id );
    }


    // Function to set a remark as employer
    public function pushremark(request $request, $applid){
      $updateremark = Application::find($applid);
      $updateremark->application_status_remark = $request->formRemark;
      $updateremark->save();
      return redirect()->route('applicationcheckedit',$applid );

    }
}
