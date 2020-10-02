@extends('layouts.app')
@section('content')

<div class="card w-100 d-inline-block" style="height: 75px;">
  <a type="button" href="{{route('adminpage')}}" class="btn float-left btn-success ml-4 mt-3" >Instellingen Profiel <i class="fas fa-unlock ml-1"></i></a>

  <span class="float-right font-weight-bold mt-4 mr-3">{{Auth::user()->name}} |<i class="fas fa-user ml-1"></i></span>
</div>

<div class="col-12 row">
  <p class="col-4 mt-2">Aanvraagformulier</p>
  <div class="col-8">
    <button type="submit" form="pushApplication" class="btn btn-primary mt-1 mr--4 float-right" >Aanvraag versturen <i class="fas fa-angle-double-right"></i></button>
    <a type="button" href="{{route('adminpage')}}" class="btn float-right btn-info mt-1 mr-2" >Terug <i class="fas fa-undo-alt ml-1"></i></a>
  </div>
</div>

<div class="col-12 mt--4">
  <hr>
</div>

<div class="p-3 mtinpu row">

    <div class="col-6">
          <form class="form-inline" action="{{route('applicationpush')}}" method="post" id="pushApplication">
            @csrf
            <div class="form-group col-12 p-0">
              <label class="col-4 text-left d-table font-weight-bold">Type aanvraag</label>
              <select class="form-control col-8" name="formApplication">
                <option value = "1">Verlof</option>
                <option value = "2">Dokter</option>
                <option value = "3">Tandarts</option>
              </select>
            </div>




              <div class="input-daterange datepicker row align-items-center col-12 mt-3">
                <label class="col-4 text-left d-table font-weight-bold">Datum</label>
                <div class="col-4 ml--1">
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input name="formDateFrom" class="form-control" placeholder="Start date" type="text" value="06/18/2020">
                        </div>
                    </div>
                </div>
                <div class="col-4 ml--4">
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input name="formDateTill" class="form-control" placeholder="End date" type="text" value="06/22/2020">
                        </div>
                    </div>
                </div>
                @if($errors->has('formDateFrom') || $errors->has('formDateTill'))
                      <span class="error text-red" >* Datum veld niet gevoerd</span>
                @endif
            </div>
            <div class="form-group col-12 p-0 mt-3">
              <label class="col-4 text-left d-table font-weight-bold">Toelichting</label>
              <textarea class="form-control col-8" name="formRemark" value="" ></textarea>
          </div>
          </form>
    </div>

</div>

@endsection
