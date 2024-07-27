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
                        <li><a class="nav-link" href="{{ url('/') }}"><i class="ion ion-speedometer" data-pack="default" data-tags="travel, accelerate"></i><span>Dashboard</span></a></li>
                        <li><a class="nav-link" href="{{ url('/pengumuman') }}"><i class="ion ion-speakerphone"></i><span>Pengumuman</span></a></li>

                        <li class="menu-header">Manajemen Pengguna</li>
                        <li class="nav-item dropdown active">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="ion ion-ios-paper"></i> <span>Data Pengguna</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ url('/data-pengguna/admin') }}"><span>Admin</span></a></li>
                                <li class="active"><a class="nav-link" href="{{ url('/data-pengguna/dosen') }}"><span>Dosen</span></a></li>
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
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Magang</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ url('/admin/mahasiswa/pengajuan-magang') }}">Permintaan Magang</a></li>
                                <li><a class="nav-link" href="{{ url('/admin/data-magang') }}">Data Magang</a></li>
                            </ul>
                            <li><a class="nav-link" href="{{ url('/admin/data-bimbingan-mahasiswa') }}"><i class="ion ion-android-list"></i><span>Dosen Pembimbing</span></a></li>
                        </li>

                        <li class="menu-header">Aktivitas Magang</li>
                        <li><a class="nav-link" href="{{  url('/admin/logbook') }}"><i class="ion ion-clipboard" data-pack="default" data-tags="write"></i> <span>Logbook</span></a></li>
                        <li><a class="nav-link" href="{{  url('/admin/bimbingan') }}"><i class="fas fa-users"></i> <span>Bimbingan</span></a></li>

                        <li class="menu-header">Finalisasi Magang</li>
                        <li><a class="nav-link" href="{{ url('/admin/laporan-magang-mahasiswa') }}"><i class="ion ion-ios-book"></i> <span>Laporan Magang</span></a> </li>

                        <li class="menu-header">Lainnya</li>
                        <li>
                            <a class="nav-link" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                        <h1>Data Pengguna</h1>
                    </div>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 col-md col-lg">
                                <!--Horizontal-->
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Update Data Dosen</h4>
                                    </div>
                                    <form id="update-form" action="{{ url('/data-pengguna/dosen/edit/' . $dosen->id) }}" method="POST" autocomplete="off">
                                        @method('patch')
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                                                <div class="col-sm-7">
                                                    <input readonly type="text" class="form-control" id="nip"
                                                        name="nip" placeholder="Masukkan NIM" value={{ $dosen->nip }}>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" id="nama"
                                                        name="nama" placeholder="Masukkan nama" value="{{ $dosen->nama }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-7">
                                                    <input type="email" class="form-control" id="email"
                                                        name="email" placeholder="Masukkan Email" value="{{ $dosen->email }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="telp" class="col-sm-3 col-form-label">No
                                                    Telepon</label>
                                                <div class="col-sm-5">
                                                    <input type="telp" class="form-control" id="telp"
                                                        name="telp" placeholder="Masukkan no telepon aktif" value="{{ $dosen->telp }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" id="alamat"
                                                        name="alamat" placeholder="Masukkan alamat" value="{{ $dosen->alamat }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" id="kirim" name="kirim" class="btn btn-primary m-2">Simpan</button>
                                            <a href="{{ url('/data-pengguna/dosen') }}" class="btn btn-warning m-2">Kembali</a>
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
        var redirectUrl = "{{ url('/data-pengguna/dosen') }}";
    </script>
    <script src="{{ asset('node_modules/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('node_modules/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('node_modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('node_modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('node_modules/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('node_modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/modules-sweetalert.js') }}"></script>
</body>

</html>
