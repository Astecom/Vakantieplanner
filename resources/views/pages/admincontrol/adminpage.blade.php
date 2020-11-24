@extends('layouts.app')
@section('content')

<div class="card w-100 d-inline-block" style="height: 75px;">
  <div data-route="{{route('addUser')}}" class="btn btn-addit float-left btn-success ml-4 mt-3">Gebruiker Toevoegen<i class="fas fa-user-plus ml-3"></i></div>
  <div class="card-body">
      <span class="float-right mr-2 font-weight-bold text-capitalize">{{Auth::user()->name}} |<i class="fas fa-user ml-1"></i></span>
  </div>
</div>

<div class="p-4">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <form class="form-inline mr-auto col-12">
            <h1 class="card-title">Overzicht Actieve Gebruikers</h1>
              <input class="form-control mr-sm-2 col-11" type="text" placeholder="Zoeken..." name="searchUser" value="{{$data->has('searchUser') ? $data['searchUser'] : ''}}">
              <button href="#!" class="btn btn-primary" type="submit">Search</button>
          </form>
          <table class="table mt-3">
            <thead>
              <tr>
                <th>Gebruiker</th>
                <th>E-mail</th>
                <th>Lid sinds</th>
                <th>Actie</th>
              </tr>
            </thead>

            <tbody>
              @foreach($getusers as $getuser)
              <tr>
                <td class="text-capitalize" >{{$getuser->name}}</td>
                <td>{{$getuser->email}}</td>
                <td>{{$getuser->created_at}}</td>
                <td>
                  <a href="{{route('adminpagesendedit', $getuser->id)}}" type="button" class="btn btn-primary"><i class="fas fa-cogs" style="font-size: 140%"></i></a>
                  @if($getuser->email != 'directie@astecom.nl')
                  <button data-route="{{route('adminpagedelete', $getuser->id)}}" type="button" class="btn btn-primary btn-deleteit"><i class="far fa-trash-alt" style="font-size: 140%"></i></button>
                  @endif
                </td>
              </tr>

              <div class="modal fade" id="addit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form action="{{route('addUser')}}" method="post">
                    @csrf

                  <div class="modal-content">
                    <div class="modal-header">
                      <h2 class="modal-title">Aanmaken Gebruiker</h2>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="ml-4 mt-3">
                      <label class="">Naam:</label>
                      <input type="text" name="userName" value="" class="form-control col-8">
                    </div>
                    <div class="ml-4 mt-2">
                      <label class="">Email Adres:</label>
                      <input type="text" name="email" value="" class="form-control col-8">
                    </div>
                    <div class="modal-footer mt-3">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuleren</button>
                      <button type="submit" class="btn btn-success addit">Toevoegen</button>
                    </div>
                  </div>
                  </form>
                </div>
              </div>

              <div class="modal fade" id="deleteit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form method="post">
                    @csrf
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Gebruiker verwijderen?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Weet u zeker dat u deze gebuiker wilt verwijderen? <br>Hiermee worden alle relaties en gegevens verloren
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuleren</button>
                      <button type="submit" class="btn btn-primary deleteit">Verwijderen</button>
                    </div>
                  </div>
                  </form>
                </div>
              </div>

              @endforeach
            </tbody>
          </table>
          <div class="d-table m-auto">

              {{ $getusers->appends([ 'searchUser' => ($data->has('searchUser') ? $data['searchUser'] : '')])->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection
