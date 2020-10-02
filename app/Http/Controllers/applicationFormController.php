<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\User;
use Auth;

use Carbon\Carbon;

class applicationFormController extends Controller
{
    public function index(){
      $userinfo = Auth::user();
      return view('pages/general/application', ['userinfo'=>$userinfo]);
    }


    // Verstuur de appilication naar de database met daarin 2 verplichte kolommen
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
        $verlofreq->date_from = Carbon::parse($request->formDateFrom);
        $verlofreq->date_till = Carbon::parse($request->formDateTill);
        $verlofreq->save();
        app('App\Http\Controllers\mailController')->applicationSent();
        return redirect()->route('history');
    }



    public function applicationback(){
      return redirect()->back();
    }
}
