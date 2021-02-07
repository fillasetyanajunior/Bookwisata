<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
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
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?=url('assets/dist/img/AdminLTELogo.png')?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset(Auth::user()->avatar)}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <?php
                    $role = Auth::user()->role;
                    $queryMenu  = DB::table('access_menu')
                                    ->join('menu','menu.id', '=', 'access_menu.menu_id')
                                    ->where('access_menu.role_id', '=' ,$role)
                                    ->get();
            ?>
                <?php   foreach ($queryMenu as $m) :?>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon {{$m->icon}}"></i>
                                <p>
                                    {{$m->menu}}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <?php
                                $menu_id = $m->id;
                                $querySubMenu   = DB::table('menu')
                                                    ->join('sub_menu','sub_menu.menu_id', '=', 'menu.id')
                                                    ->where('sub_menu.menu_id', '=' ,$menu_id)
                                                    ->get();
                            ?>
                            <ul class="nav nav-treeview">
                                <?php foreach ($querySubMenu as $sm) : ?>
                                @if ($sm->menu_id == 0)

                                @else
                                    <li class="nav-item">
                                        <a href="{{route($sm->url)}}" class="nav-link">
                                            <i class="{{$sm->icon}} nav-icon"></i>
                                            <p>{{$sm->sub_menu}}</p>
                                        </a>
                                    </li>
                                @endif
                                <?php endforeach?>
                            </ul>
                        </li>
                <?php endforeach?>
                <li class="nav-header">Logout</li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt  nav-icon"></i>
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>