<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-dark navbardarkcolor" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/logo-header.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </form>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>


            <h6 class="navbar-heading text-muted">navigatie menu</h6>
            <hr class="my-3">

            <!-- Navigation -->
            <ul class="navbar-nav">

              @if(Auth::user()->hasRole('employer') || Auth::user()->hasRole('employee'))
                <li class="nav-item">
                    <a class="nav-link" href="{{route('applicationcheck')}}">
                        <i class="fas fa-history"></i> {{ __('Aanvragen Overzicht') }}
                    </a>
                </li>
              @endif

              @if(Auth::user()->hasRole('employee'))
                <li class="nav-item">
                    <a class="nav-link" href="{{route('application')}}">
                        <i class="far fa-envelope text-grey"></i> {{ __('Nieuwe Aanvraag') }}
                    </a>
                </li>
              @endif

              @if(Auth::user()->hasRole('employer'))
                <li class="nav-item">
                    <a class="nav-link" href="{{route('adminpage')}}">
                        <i class="fas fa-user-lock text-grey"></i> {{ __('Admin Overzicht') }}
                    </a>
                </li>
              @endif

                <li class="nav-item mb-5 bg-danger w-100" style="position: absolute; bottom: 0;">
                  <a href="{{ route('logout') }}" class="nav-link te" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                      <i class="ni ni-user-run"></i>
                      <span>{{ __('Uitloggen') }}</span>
                  </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
