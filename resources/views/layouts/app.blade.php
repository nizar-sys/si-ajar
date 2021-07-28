<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0- 
     alpha/css/bootstrap.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
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
            @if (Auth::user()->role === '1')
                <a class="brand-link" href="/admin">
                    <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">SI AJAR</span>
                </a>
            @elseif(Auth::user()->role === '2')
                <a class="brand-link" href="/guru">
                    <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">SI AJAR</span>
                </a>
            @else
                <a class="brand-link" href="/siswa">
                    <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">SI AJAR</span>
                </a>
            @endif

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @if (Auth::check())
                            @if (Auth::user()->role === '1' || Auth::user()->role === '2')
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-tachometer-alt"></i>
                                        <p>
                                            Master data
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            @if (Auth::user()->role === '1')
                                                <a href="/data-guru" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Data Guru</p>
                                                </a>
                                            @else
                                                <a href="/daftar-guru" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Data Guru</p>
                                                </a>
                                            @endif
                                        </li>
                                        @if (Auth::user()->role === '1')
                                            <li class="nav-item">
                                                <a href="/data-siswa" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Data Siswa</p>
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="/data-kelas" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Data Kelas</p>
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="/data-mapel" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Data Mapel</p>
                                                </a>
                                            </li>
                                        @else
                                            <li class="nav-item">
                                                <a href="/daftar-siswa" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Data Siswa</p>
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="/daftar-kelas" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Data Kelas</p>
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="/daftar-mapel" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Data Mapel</p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-book"></i>
                                        <p>
                                            Pembelajaran
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="/jadwal-ajar" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Jadwal ajar</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/data-absensi" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Data absen</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            {{-- menu siswa --}}
                            @if (Auth::user()->role === '3')
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-book"></i>
                                        <p>
                                            Pembelajaran
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="/jadwal" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Jadwal Rombel</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            <li class="nav-item">
                                <a href="{{ route('profile.show', ['profile' => Auth::user()->id]) }}"
                                    class="nav-link">
                                    <i class="fas fa-user nav-icon"></i>
                                    <p>My profile</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/logout" class="nav-link">
                                    <i class="fas fa-lock nav-icon"></i>
                                    <p>Logout</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">

                @yield('content')

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Muhamad Nizar</b>
            </div>
            <strong>Copyright &copy; 2021 &mdash; {{ date('Y') }}</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    @yield('javascript')
</body>

</html>
