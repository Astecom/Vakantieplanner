@extends('layouts.app')
@section('content')

<div class="card w-100 d-inline-block" style="height: 75px;">
  <a type="button" href="{{route('history')}}" class="btn float-left btn-info ml-4 mt-3" >Terug naar Overzicht <i class="fas fa-undo-alt ml-1"></i></a>
  <div class="card-body">
      <span class="float-right mr-2 font-weight-bold">{{Auth::user()->name}} |<i class="fas fa-user ml-1"></i></span>
  </div>
</div>



<div class="p-3 mtinpu row">

    <div class="col-6">
      <div class="card">
        <div class="card-body">
          <h2 class="card-title">Aanvraag <span class="ml-1">{{$applicationinfo->user->name}}</span></h2>

          <form class="form-inline">

            <div class="form-group col-12 p-0 mt-3">
              <label class="col-4 text-left d-table font-weight-bold">Status:</label>
              @switch($applicationinfo->application_status->id)
                  @case(1)
                      <span class="badge badge-info text-capitalize">{{$applicationinfo->application_status->name}}</span>
                      @break
                  @case(2)
                      <span class="badge badge-success text-capitalize">{{$applicationinfo->application_status->name}}</span>
                      @break
                  @case(3)
                      <span class="badge badge-danger text-capitalize">{{$applicationinfo->application_status->name}}</span>
                      @break
              @endswitch
            </div>

            <div class="form-group col-12 p-0 mt-3">
              <label class="col-4 text-left d-table font-weight-bold">Type verlof:</label>
              <label class="text-capitalize">{{$applicationinfo->application_type->name}}</label>
            </div>
            <div class="form-group col-12 p-0 mt-3">
              <label class="col-4 text-left d-table font-weight-bold">Vanaf:</label>
              <label>{{$applicationinfo->date_from}}</label>
            </div>
            <div class="form-group col-12 p-0 mt-3">
              <label class="col-4 text-left d-table font-weight-bold">Tot:</label>
              <label>{{$applicationinfo->date_till}}</label>
            </div>

            @if($applicationinfo->remark != null)
            <div class="form-group col-12 p-0 mt-4">
              <label class="col-4 text-left d-table font-weight-bold">Toelichting:</label>
              <label>{{$applicationinfo->remark}}</label>
            </div>
            @endif
          </form>
        </div>
      </div>
    </div>


    <div class="col-5">
      <div class="card">
        <div class="card-body">
          <h2 class="card-title">Gebruiker Gegevens</h2>
          <form class="form-inline row" action="{{route('pushremark', $applicationinfo->id)}}" method="post">
            @csrf
            <div class="form-group col-12 p-0">
              <label class="col-4 text-left d-table font-weight-bold">Werknemer:</label>
              <label class="col-4 d-table">{{$applicationinfo->user->name}}</label>
            </div>
            <div class="form-group col-12 p-0 mt-3">
              <label class="col-4 text-left d-table font-weight-bold">E-mail adress:</label>
              <label class="col-4 d-table text-capitalize">{{$applicationinfo->user->email}}</label>
            </div>
            @if($applicationinfo->application_status_remark != null)
            <div class="form-group col-12 p-0 mt-3">
              <label class="col-4 text-left d-table font-weight-bold">Opmerking Werkgever:</label>
              <label class="col-4 text-left d-table font-weight-bold">{{$applicationinfo->application_status_remark}}</label>
            </div>
            @endif
          </form>
        </div>
      </div>
    </div>


</div>

@endsection
