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
                    <!-- Menu Sidebar-->
                    <ul class="sidebar-menu">
                        <li><a class="nav-link" href="{{ url('/') }}"><i class="ion ion-speedometer" data-pack="default" data-tags="travel, accelerate"></i>
                                <span>Dashboard</span></a></li>
                        <li><a class="nav-link" href="{{ url('/pengumuman') }}"><i class="fa fa-bullhorn"></i>
                                <span>Pengumuman</span></a></li>
                        <li class="menu-header">Mahasiswa</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i> <span>Magang</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ url('/persuratan') }}">Persuratan</a></li>
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
                        <li class="nav-item dropdown active">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fa fa-graduation-cap"></i> <span>Mahasiswa</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="#">Data Mahasiswa</a></li>
                                <li class="active"><a class="nav-link" href="{{ url('kelolaMahasiswa') }}">Users</a>
                                </li>
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
                        <h1>Form</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                            <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div>
                            <div class="breadcrumb-item">Form</div>
                        </div>
                    </div>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 col-md col-lg">
                                <!--Horizontal-->
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Create user mahasiswa</h4>
                                    </div>
                                    <form action="{{ url('/kelolaMahasiswa') }}" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="username" class="col-sm-3 col-form-label">Username</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="username" name="username"
                                                        placeholder="Masukkan NIM" autofocus>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        placeholder="Masukkan Email">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password" class="col-sm-3 col-form-label">Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="password" name="password"
                                                        placeholder="Password">
                                                </div>
                                            </div>

                                            <fieldset class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Role</label>
                                                    <div class="col-sm-9">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="gridRadios" id="admin" value="Admin">
                                                            <label class="form-check-label" for="admin">
                                                                Admin
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="gridRadios" id="mahasiswa" value="Mahasiswa" checked>
                                                            <label class="form-check-label" for="mahasiswa">
                                                                Mahasiswa
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="gridRadios" id="dosen" value="Dosen">
                                                            <label class="form-check-label" for="mahasiswa">
                                                                Dosen
                                                            </label>
                                                        </div>
                                                    </div>
                                            </fieldset>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Date Created</label>
                                                <div class="col-sm-9">
                                                    <input type="datetime-local" name="date_created" id="date_created" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" id="kirim" name="kirim" class="btn btn-primary">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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

    <!-- Template JS File -->
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
</body>

</html>
