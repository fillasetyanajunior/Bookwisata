<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <div class="id_user" content="{{Auth::user()->id}}"></div>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge countNotif">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/" class="brand-link">
        <img src="{{url('assets/utama/img/icon/icon.png')}}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Bookwisata</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            @if (Auth::user()->avatar == '-')
            @else
            <div class="image">
                <img src="{{asset('profile/' . Auth::user()->avatar)}}" class="img-circle elevation-2" alt="User Image">
            </div>
            @endif
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @php
                $role = Auth::user()->role;
                    $queryMenu = DB::table('access_menu')
                    ->join('menu','menu.id', '=', 'access_menu.menu_id')
                    ->where('access_menu.role_id', '=' ,$role)
                    ->get();
                    @endphp
                @foreach ($queryMenu as $m)
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon {{$m->icon}}"></i>
                        <p>
                            {{$m->menu}}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    @php
                        $menu_id = $m->id;
                        $querySubMenu = DB::table('menu')
                        ->join('sub_menu','sub_menu.menu_id', '=', 'menu.id')
                        ->where('sub_menu.menu_id', '=' ,$menu_id)
                        ->get();
                    @endphp
                    <ul class="nav nav-treeview">
                        @foreach ($querySubMenu as $sm)
                        @if ($sm->menu_id == 0)

                        @else
                        <li class="nav-item">
                            <a href="{{route($sm->url)}}" class="nav-link url" content="{{$sm->url}}">
                                <i class="{{$sm->icon}} nav-icon"></i>
                                <p>{{$sm->sub_menu}}</p>
                            </a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </li>
                @endforeach
                <li class="nav-header">Logout</li>
                <li class="nav-item">
                    <a class="nav-link url" href="{{ route('logout') }} " content="{{'logout'}}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt  nav-icon"></i>
                        <p>{{ __('Logout') }}</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>
