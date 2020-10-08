@extends('layouts.app')
@section('content')

<div class="card w-100 d-inline-block" style="height: 75px;">
  <span class="float-right font-weight-bold mt-4 mr-3">{{Auth::user()->name}} |<i class="fas fa-user ml-1"></i></span>
</div>

<div class="col-12 mt-2">


<div class="card">
  <div class="card-body">
    <div class="col-12 row">
      <h1 class="col-4 mt-2">Aanvragen Verlof</h1>
      <div class="col-8">
        <button type="submit" form="pushApplication" class="btn btn-primary mt-1 mr--4 float-right" >Aanvraag versturen <i class="fas fa-angle-double-right"></i></button>
        <a type="button" href="{{route('applicationcheck')}}" class="btn float-right btn-info mt-1 mr-2" >Terug <i class="fas fa-undo-alt ml-1"></i></a>
      </div>
    </div>

    <div class="col-12 mt--4">
      <hr>
    </div>

    <div class="p-3 mtinpu row">

      <div class="col-6 mt-2">
          <form class="form-inline" action="{{route('applicationpush')}}" method="post" id="pushApplication">
            @csrf
            <div class="form-group col-12 p-0">
              <p class="col-4 text-left d-table font-weight-bold">Type aanvraag</p>
              <select class="form-control col-8" name="formApplication">
                <option value = "1">Verlof</option>
                <option value = "2">Bijzonder Verlof</option>
              </select>
            </div>

              <div class="form-group p-0 col-12 mt-3">
                <p class="col-4 text-left d-table font-weight-bold">Datum</p>
                    <input type="text" name="formDateFrom" value="" class="form-control datepicker col-4">
                      <input type="text" name="formDateTill" value="" class="form-control datepicker col-4">
                @if($errors->has('formDateFrom') || $errors->has('formDateTill'))
                      <span class="error text-red" >* Datum veld niet gevoerd</span>
                @endif
            </div>
            <div class="form-group col-12 p-0 mt-3">
              <p class="col-4 text-left d-table font-weight-bold">Vanaf & Tot</p>
              <input type="text" class="form-control col-4" placeholder="HH:MM" name="timeFrom" value="">
              <input type="text" class="form-control col-4" placeholder="HH:MM" name="timeTill" value="">
            </div>
              <div class="form-group col-12 p-0 mt-3">
                <p class="col-4 text-left d-table font-weight-bold">Toelichting</p>
                <textarea class="form-control col-8" name="formRemark" value="" ></textarea>
            </div>
          </form>
        </div>

        </div>
          <div class="col-12 mt--4">
            <hr>
        </div>

        </div>
    </div>
</div>
@endsection
