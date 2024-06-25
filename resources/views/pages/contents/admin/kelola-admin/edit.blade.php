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
                        <a href="{{ url('/') }}">SIMAG</a>
                    </div>
                    <!-- Menu Sidebar-->
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li><a class="nav-link" href="{{ url('/') }}"><i
                            class="ion ion-speedometer" data-pack="default" data-tags="travel, accelerate"></i> <span>Dashboard</span></a></li>
                        <li><a class="nav-link" href="{{ url('/pengumuman') }}"><i class="ion ion-speakerphone"></i>
                            <span>Pengumuman</span></a></li>


                            <li class="menu-header">Manajemen Pengguna</li>
                            <li class="nav-item-dropdown">
                                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                                    <i class="ion ion-ios-paper"></i><span>Data Pengguna</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="nav-link" href="{{ url('/data-pengguna/admin') }}"><span>Admin</span></a></li>
                                    <li><a class="nav-link" href="{{ url('/data-pengguna/dosen') }}"><span>Dosen</span></a></li>
                                    <li><a class="nav-link" href="{{ url('/data-pengguna/mahasiswa') }}"><span>Mahasiswa</span></a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                        class="ion ion-android-person"></i> <span>Kelola Pengguna</span></a>
                                    <ul class="dropdown-menu">
                                        <li><a class="nav-link" href="{{ url('/kelola-pengguna/admin') }}"><span>Admin</span></a></li>
                                        <li><a class="nav-link" href="{{ url('/kelola-pengguna/dosen') }}"><span>Dosen</span></a></li>
                                        <li><a class="nav-link" href="{{ url('/kelola-pengguna/mahasiswa') }}"><span>Mahasiswa</span></a></li>
                                    </ul>
                            </li>

                        <li class="menu-header">Manajemen Magang</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i> <span>Magang</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ url('/admin/mahasiswa/pengajuan-magang') }}">Permintaan Magang</a></li>
                                <li><a class="nav-link" href="{{ url('/admin/data-magang') }}">Data Magang</a></li>
                            </ul>
                            <li><a class="nav-link" href="{{ url('/admin/data-bimbingan-mahasiswa') }}"><i class="ion ion-android-list"></i><span>Data Bimbingan</span></a></li>
                            <li><a class="nav-link" href="{{  url('/admin/logbook/index') }}"><i class="ion ion-clipboard" data-pack="default" data-tags="write"></i> <span>Logbook</span></a></li>
                        </li>

                        <li class="menu-header">Finalisasi Magang</li>
                        <li><a class="nav-link" href="{{ url('/admin/laporan-magang-mahasiswa') }}"><i class="ion ion-ios-book"></i> <span>Laporan Magang</span></a> </li>

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
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Kelola Pengguna</h1>
                    </div>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 col-md col-lg">
                                <!--Horizontal-->
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Update user admin</h4>
                                    </div>
                                    <form id="update-form" action="{{ url('/kelola-pengguna/admin/edit/' . $users->id) }}" method="POST">
                                        @method('patch')
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="username" class="col-sm-3 col-form-label">Username</label>
                                                <div class="col-sm-9">
                                                    <input disabled type="text" class="form-control" id="username" name="username"
                                                        placeholder="Masukkan NIP" value="{{ $users->username }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        placeholder="Masukkan Email" value="{{ $users->email }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password" class="col-sm-3 col-form-label">Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="password" name="password"
                                                        placeholder="Password" disabled value="{{ $users->password }}">
                                                </div>
                                            </div>

                                            <fieldset class="form-group row">
                                                <label class="col-sm-3 col-form-label">Status</label>
                                                <div class="col-sm-9">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="gridRadios-status" id="gridRadios-status-1" value="1" {{ $users->is_active == 1? 'checked' : '' }}>
                                                        <label class="form-check-label" for="gridRadios-status">
                                                            Active
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="gridRadios-status" id="gridRadios-status-2" value="0" {{ $users->is_active == 0? 'checked' : '' }}>
                                                        <label class="form-check-label" for="gridRadios-status">
                                                            Non-active
                                                        </label>
                                                    </div>
                                                </div>
                                        </fieldset>

                                            <fieldset class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Role</label>
                                                    <div class="col-sm-9">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="gridRadios" id="admin" value="Admin" checked>
                                                            <label class="form-check-label" for="admin">
                                                                Admin
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="gridRadios" id="mahasiswa" value="Mahasiswa" disabled>
                                                            <label class="form-check-label" for="mahasiswa">
                                                                Mahasiswa
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="gridRadios" id="dosen" value="Dosen" disabled>
                                                            <label class="form-check-label" for="dosen">
                                                                Dosen
                                                            </label>
                                                        </div>
                                                    </div>
                                            </fieldset>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Date Created</label>
                                                <div class="col-sm-9">
                                                    <input type="datetime-local"  name="date_created" id="date_created" class="form-control" value="{{ $users->created_at }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Date Updated</label>
                                                <div class="col-sm-9">
                                                    <input type="datetime-local"  name="date_updated" id="date_updated" class="form-control" value="{{ $users->updated_at }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <div class="row">
                                                <button type="submit" id="kirim" name="kirim" class="btn btn-primary m-2">Simpan</button>
                                                <a href="{{ url('/kelola-pengguna/admin/') }}" class="btn btn-warning m-2">Batal</a>
                                            </div>
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
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script>
        var redirectUrl = "{{ url('/kelola-pengguna/admin') }}";
    </script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/modules-sweetalert.js') }}"></script>
</body>

</html>
