@extends('layouts.app')
@section('content')
<body>

  <div class="card w-100 d-inline-block" style="height: 75px;">
    <a type="button" href="{{route('application')}}" class="btn float-left btn-success ml-4 mt-3" >Nieuwe Verlofanvraag <i class="fas fa-plus ml-1"></i></a>
    <div class="card-body">
        <span class="float-right mr-2 font-weight-bold">{{Auth::user()->name}} |<i class="fas fa-user ml-1"></i></span>
    </div>
  </div>


  <div class="p-4 mt--3">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <form class="form-inline mr-auto col-12">
              <h1 class="card-title">Overzicht Aanvragen</h1>
                <input class="form-control mr-sm-2 col-11" type="text" placeholder="Zoeken..." name="searchUser" value="{{$data->has('searchUser') ? $data['searchUser'] : ''}}">
                <button href="#!" class="btn btn-primary" type="submit">Search</button>
            </form>
            <table class="table mt-3">
            <form class="form-inline mr-auto">
                <thead>
                  <tr>
                    @if(Auth::user()->hasRole('employer'))
                    <td>Gebruiker</td>
                    @endif
                    <td>Type Aanvraag</td>
                    <td>Status</td>
                    <td>Datum van</td>
                    <td>Datum tot</td>
                    <td>Actie</td>
                  </tr>
                </thead>
                @foreach($applicationdatas as $applicationdata)
                <tbody>
                  <tr>
                    @if(Auth::user()->hasRole('employer'))
                    <td>{{$applicationdata->user->name}}</td>
                    @endif
                    <td class="text-capitalize">{{$applicationdata->application_type->name}}</td>

                    @switch($applicationdata->application_status->id)
                      @case(1)
                        <td><span class="badge badge-info text-capitalize">{{$applicationdata->application_status->name}}</span></td>
                        @break
                      @case(2)
                        <td><span class="badge badge-success text-capitalize">{{$applicationdata->application_status->name}}</span></td>
                        @break
                      @case(3)
                        <td><span class="badge badge-danger text-capitalize">{{$applicationdata->application_status->name}}</span></td>
                        @break
                    @endswitch

                    <td>{{$applicationdata->date_from}}</td>
                    <td>{{$applicationdata->date_till}}</td>

                    @if(Auth::user()->hasRole('employer'))
                    <td>
                      <a href="{{route('applicationcheckedit', $applicationdata->id)}}" class="btn btn-primary" type="button"><i class="fab fa-sistrix text-white"></i></a>
                    </td>
                    @endif

                    @if(Auth::user()->hasRole('employee'))
                    <td>
                      <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Hey"><i class="far fa-comments" style="font-size: 130%"></i></button>
                    </td>
                    @endif

                  </tr>
                </tbody>
                @endforeach
            </form>
          </table>

          <div class="d-table m-auto">
              {{ $applicationdatas->appends([ 'searchUser' => ($data->has('searchUser') ? $data['searchUser'] : '')])->links() }}
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
</body>

@endsection
