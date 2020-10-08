<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;
use App\Models\Application;
use Carbon\Carbon;
use Auth;

class applicationFormController extends Controller
{

    // Load the standard page for usage
    public function index(){
      $userinfo = Auth::user();
      return view('pages/general/application', ['userinfo'=>$userinfo]);
    }


    // Sent the application to the database
    public function applicationpush(Request $request){
        $validatedData = $request->validate([
        'formApplication' => 'required',
        'formDateFrom' => 'required',
        'formDateTill' => 'required',
        ]);

        $verlofreq = new Application;
        $verlofreq->user_id = Auth::user()->id;
        $verlofreq->status_id = '1';
        $verlofreq->type_id = $request->formApplication;
        $verlofreq->remark = $request->formRemark;
        $verlofreq->date_from = Carbon::parse($request->formDateFrom . ' ' . $request->timeFrom);
        $verlofreq->date_till = Carbon::parse($request->formDateTill . ' ' . $request->timeTill);
        $verlofreq->save();
        app('App\Http\Controllers\mailController')->applicationSent();


        return redirect()->route('applicationcheck');
    }

}
