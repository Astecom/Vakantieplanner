@extends('layouts.app')
@section('content')

<div class="card w-100 d-inline-block" style="height: 75px;">
  <a type="button" href="{{route('adminpage')}}" class="btn float-left btn-info ml-4 mt-3" >Terug naar Overzicht <i class="fas fa-undo-alt ml-1"></i></a>
  <div class="card-body">
      <span class="float-right mr-2 font-weight-bold text-capitalize">{{Auth::user()->name}} |<i class="fas fa-user ml-1"></i></span>
  </div>
</div>

  <div class="col-12 mt-2">

    <div class="card">
      <div class="card-body">

        <div class="col-6 float-left">
          <h2 class="card-title">Bewerken Gebruiker {{$edits->name}}</h2>
            <form class="form-inline" action="{{route('adminpagesendeditsubmit', $edits->id)}}" method="post">
              @csrf
                  <div class="form-group col-10 p-0 mt-2">
                    <label class="col-4 text-left d-table font-weight-bold">Gebruikersnaam</label>
                    <input type="text" name="userName" value="{{$edits->name}}" class="form-control col-8">
                  </div>

                  <div class="form-group col-10 p-0 mt-2">
                    <label class="col-4 text-left d-table font-weight-bold">E-mail Adres</label>
                    <input type="text" name="email" value="{{$edits->email}}" class="form-control col-8">
                  </div>

                  <div class="form-group col-10 p-0 mt-2">
                    <label class="col-4 text-left d-table font-weight-bold">Wachtwoord</label>
                    <input type="password" name="password" value="" class="form-control col-8">
                  </div>

        </div>


            <div class="col-6 float-right mt-5">
                  <div class="form-group col-10 p-0 row">
                    <label class="col-4 text-left d-table font-weight-bold">Gebruiker Actief</label>
                    <select name="active" class="form-control col-6" value"{{$edits->active}}">
                      <option value = "1" {{$edits->active == 1 ? "selected='selected'" : ""}}>Actief</option>
                      <option value = "0" {{$edits->active == 0 ? "selected='selected'" : ""}}>Non-actief</option>
                    </select>
                  </div>

                  <div class="form-group col-10 p-0 row mt--3">
                    <label class="col-4 text-left d-table font-weight-bold">Type Gebruiker</label>
                    <select class="form-control col-6" name="workerType">
                      @foreach($roles as $role)
                      <option {{$role->id === $edits->roles->pluck('id')[0] ? "selected='selected'" : ""}} value="{{$role->id}}">{{trans('common.' . $role->name)}}</option>
                      @endforeach
                    </select>
                  </div>

                    <div class="form-group col-10 p-0 row">
                      <label class="col-4 text-left d-table font-weight-bold mt--1"></label>
                      <button class="btn btn-primary col-6 mt--2" type="submit" name="button">Aanpassingen Opslaan <i class="fas fa-angle-double-right"></i></button>
                    </div>
                    <div class="form-group col-10 p-0 row">
                      <button  hidden class="btn btn-primary col-6 mt--2" type="" name="button">Nothing <i class="fas fa-angle-double-right"></i></button>
                    </div>

              </form>
            </div>

          </div>
        </div>

      </div>





@endsection
