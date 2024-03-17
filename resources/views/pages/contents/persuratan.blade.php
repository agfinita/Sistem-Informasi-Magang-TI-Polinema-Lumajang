<!DOCTYPE html>
<html lang="en">

<!-- Head -->
@include('pages.layouts.head')

<body>
    <div id="app">
        <div class="main-wrapper">
            <!-- Navbar -->
            @include('pages.layouts.navbar')

            <!-- Sidebar -->
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ url('/') }}">Admin</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{ url('/') }}">SIMMAG</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li><a class="nav-link" href="{{ url('/') }}"><i class="ion ion-speedometer" data-pack="default" data-tags="travel, accelerate"></i>
                                <span>Dashboard</span></a></li>
                        <li><a class="nav-link" href="{{ url('/pengumuman') }}"><i class="fa fa-bullhorn"></i>
                                <span>Pengumuman</span></a></li>
                        <li class="menu-header">Mahasiswa</li>
                        <li class="nav-item dropdown active">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i> <span>Magang</span></a>
                            <ul class="dropdown-menu">
                                <li class="active"><a class="nav-link" href="{{ url('/pengumuman') }}">Persuratan</a>
                                </li>
                                <li><a class="nav-link" href="{{ url('/data-magang') }}">Data Magang</a></li>
                            </ul>
                        </li>
                        <li class="menu-header">Kelola Pengguna</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fa fa-user"></i> <span>Admin</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="#">Data Admin</a></li>
                                <li><a class="nav-link" href="{{ url('/kelolaAdmin') }}">Users</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fa fa-user"></i> <span>Dosen</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="#">Data Dosen</a></li>
                                <li><a class="nav-link" href="{{ url('/kelolaDosen') }}">Users</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fa fa-graduation-cap"></i> <span>Mahasiswa</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="#">Data Mahasiswa</a></li>
                                <li><a class="nav-link" href="{{ url('/kelolaMahasiswa') }}">Users</a></li>
                            </ul>
                        </li>

                        <li class="menu-header">Lainnya</li>
                        <li>
                            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>

                        <li class="menu-header">Pages</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i>
                                <span>Auth</span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('/forgot') }}">Forgot Password</a></li>
                                <li><a href="{{ url('/login') }}">Login</a></li>
                                <li><a href="{{ url('/reset') }}">Reset Password</a></li>
                            </ul>
                        </li>
                    </ul>

                    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                        <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                            <i class="fas fa-rocket"></i> Documentation
                        </a>
                    </div>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Blank Page</h1>
                    </div>

                    <div class="section-body">
                    </div>
                </section>
            </div>

            <!-- Footer -->
            @include('pages.layouts.footer')

        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="../assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="../node_modules/simpleweather/jquery.simpleWeather.min.js"></script>
    <script src="../node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="../node_modules/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="../node_modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../node_modules/summernote/dist/summernote-bs4.js"></script>
    <script src="../node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

    <!-- Template JS File -->
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
    <script src="../assets/js/page/index-0.js"></script>
</body>

</html>
