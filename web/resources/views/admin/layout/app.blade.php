<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Labora</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('template') }}/plugins/fontawesome-free/css/all.min.css">
    @yield('style')
    <link rel="stylesheet" href="{{ asset('template') }}/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <img src="{{ asset('template') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Labora Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('template') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Admin</a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ url('dashboard') }}" class="nav-link @if (Request::route()->getName() == 'dashboard') active @endif">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('club.index') }}" class="nav-link @if (Request::route()->getName() == 'club.index') active @endif">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Club
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tournament.index') }}" class="nav-link @if (Request::route()->getName() == 'tournament.index') active @endif">
                                <i class="nav-icon fas fa-trophy"></i>
                                <p>
                                    Turnamen
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register_tournament.index') }}" class="nav-link @if (Request::route()->getName() == 'register_tournament.index') active @endif">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Pendaftaran
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('payment.index') }}" class="nav-link @if (Request::route()->getName() == 'payment.index') active @endif">
                                <i class="nav-icon fas fa-dollar-sign"></i>
                                <p>
                                    Pembayaran
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('master_payment.index') }}" class="nav-link @if (Request::route()->getName() == 'master_payment.index') active @endif">
                                <i class="nav-icon fas fa-dollar-sign"></i>
                                <p>
                                    Metode Pembayaran
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('do_logout') }}" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('page')</h1>
                        </div>
                        {{--  <div class="col-sm-6 text-right">
                            <button type="button" class="btn btn-success">Publish</button>
                        </div>  --}}
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; {{ date('Y') }} <a href="https://benditandayusaputra.github.io">Labora</a>.</strong> All
            rights reserved.
        </footer>
    </div>

    <script src="{{ asset('template') }}/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('template') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('template') }}/dist/js/adminlte.min.js"></script>
    @yield('script')
</body>

</html>