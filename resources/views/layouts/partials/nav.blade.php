@guest
@else
    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="background: #26b4d7;width: 20% !important;" id="navmenu">
        <div class="container-fluid d-flex flex-column p-0">
            <div id="logodiv" class="logodiv" style="margin-right: 60px;">
                <a class="navbar-brand sidebar-brand m-0" href="#">
                    <img id="logo" class="logo" src="{{URL::asset('/image/logo_guarderia.png')}}" style="width: 81px;">
                </a>
            </div>
            <div id="menu-peek" class="menu-peek" style="margin-right: 62px;">
                <ul class="navbar-nav text-light" id="accordionSidebar" style="padding-top: 38px;">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fa fa-home"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    @foreach (Auth::user()->dataPerfil(Auth::user()->contacto_id) as $user)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route($user->prefijo) }}">
                                <i class="{{ $user->icon }}"></i>
                                <span>{{ $user->nombremenu }}</span>
                            </a>
                        </li>
                    @endforeach
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i>
                            <span>{{ __('Logout') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
            {{-- <div class="text-center d-none d-md-inline">
                <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
            </div> --}}

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </nav>
@endguest

