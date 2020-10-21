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
      $currentuser = Auth::user();

      $openApplications = $this->getQueryBuilder($request)->where('status_id', 1)->orderBy('created_at','desc');
      $closedApplications = $this->getQueryBuilder($request)->where('status_id','!=', 1)->orderBy('created_at','desc');

      if(Auth::user()->hasRole('employee')){
        $openApplications = $openApplications->where('user_id',$currentuser->id);
        $closedApplications = $closedApplications->where('user_id',$currentuser->id);
      }

      return view('/pages/applicationcheck/applicationcheck', ['openApplications'=>$openApplications->paginate(7), 'closedApplications'=>$closedApplications->paginate(7), 'data'=>$request]);
    }

    private function getQueryBuilder($request){
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
      return $applicationdatas;
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
      if($statusupdate->status_id == $request->buttonstatus){
        return redirect()->route('applicationcheck');
      }else{
        $statusupdate->status_id = $request->buttonstatus;
        if($request->formRemark != null){
          $statusupdate->application_status_remark = $request->formRemark;
        }
        $statusupdate->save();
        app('App\Http\Controllers\mailController')->statusUpdate($id);

        if($request->buttonstatus == '2'){
          $newEvent = new Event;
          $newEvent = Event::create([
            'name' => $statusupdate->user->name . ' vrij',
            'startDateTime' => Carbon::parse($statusupdate->date_from),
            'endDateTime' => Carbon::parse($statusupdate->date_till),
          ]);

          $statusupdate->google_calendar_id = $newEvent->id;
          $statusupdate->save();

        }else if($request->buttonstatus == '3'){
          $deletecalanderid = Application::find($id);
          $eventId = $deletecalanderid->google_calendar_id;

          if($eventId != null){
            $event = Event::find($eventId);
            $event->delete();
          }
        }
        return redirect()->route('applicationcheck');

      }
    }
}
