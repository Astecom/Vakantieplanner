@extends('layouts.app')
@section('content')

<div class="card w-100 d-inline-block" style="height: 75px;">
  <a type="button" href="{{route('adminpage')}}" class="btn float-left btn-info ml-4 mt-3" >Terug naar Overzicht <i class="fas fa-undo-alt ml-1"></i></a>
  <div class="card-body">
      <span class="float-right mr-2 font-weight-bold">{{Auth::user()->name}} |<i class="fas fa-user ml-1"></i></span>
  </div>
</div>

<div class="p-3 mtinpu row">

    <div class="col-6">
      <div class="card">
        <div class="card-body">
          <h2 class="card-title">Gebruiker Gegevens</h2>
          <form class="form-inline" action="{{route('adminpagesendeditsubmit', $edits->id)}}" method="post">
            @csrf
            <div class="form-group col-12 p-0 mt-2">
              <label class="col-4 text-left d-table font-weight-bold">Gebruikersnaam</label>
              <input type="text" name="userName" value="{{$edits->name}}" class="form-control col-8">
            </div>
            <div class="form-group col-12 p-0 mt-2">
              <label class="col-4 text-left d-table font-weight-bold">E-mail address</label>
              <input type="text" name="email" value="{{$edits->email}}" class="form-control col-8">
            </div>
            <div class="form-group col-12 p-0 mt-2">
              <label class="col-4 text-left d-table font-weight-bold">Wachtwoord</label>
              <input type="password" name="password" value="" class="form-control col-8">
            </div>
          <div class="col-12 p-0 mt-4">
            <div class="row float-right">
              <div class="col-12">
                  <button class="btn btn-primary w-100" type="submit" name="button">Gegevens Opslaan <i class="fas fa-angle-double-right"></i></button>
              </div>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>






    <div class="col-5">
      <div class="card">
        <div class="card-body">
          <h2 class="card-title">Activiteit Gebruiker</h2>
          <form class="form-inline" action="{{route('adminpageendeditrights', $edits->id)}}" method="post">
            @csrf
            <div class="form-group col-12 p-0">
              <label class="col-4 text-left d-table font-weight-bold">Gebruiker Actief</label>
              <select name="active" class="form-control col-8" value"{{$edits->active}}">
                <option value = "1" {{$edits->active == 1 ? "selected='selected'" : ""}}>Actief</option>
                <option value = "0" {{$edits->active == 0 ? "selected='selected'" : ""}}>Non-actief</option>
              </select>
            </div>

            <div class="form-group col-12 p-0 mt-2">
              <label class="col-4 text-left d-table font-weight-bold">Type Gebruiker</label>
              <select class="form-control col-8" name="workerType">
                @foreach($roles as $role)
                <option {{$role->id === $edits->roles->pluck('id')[0] ? "selected='selected'" : ""}} value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-12 p-0 mt-4">
              <div class="row float-right">
                <div class="col-6">
                    <button class="btn btn-primary" type="submit" name="button">Opslaan <i class="fas fa-angle-double-right"></i></button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>


@endsection
