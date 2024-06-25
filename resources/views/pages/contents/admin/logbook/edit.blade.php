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
                        <a href="{{ url('/dosen/dashboard') }}">{{ Auth::user()->role }}</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{ url('/dosen/dashboard') }}">SIMMAG</a>
                    </div>
                    <!-- Menu Sidebar-->
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li><a class="nav-link" href="{{ url('/') }}"><i class="ion ion-speedometer"
                                    data-pack="default" data-tags="travel, accelerate"></i> <span>Dashboard</span></a>
                        </li>
                        <li><a class="nav-link" href="{{ url('/pengumuman') }}"><i class="ion ion-speakerphone"></i>
                                <span>Pengumuman</span></a></li>


                        <li class="menu-header">Manajemen Pengguna</li>
                        <li class="nav-item-dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                                <i class="ion ion-ios-paper"></i><span>Data Pengguna</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ url('/data-pengguna/admin') }}"><span>Admin</span></a>
                                </li>
                                <li><a class="nav-link" href="{{ url('/data-pengguna/dosen') }}"><span>Dosen</span></a>
                                </li>
                                <li><a class="nav-link"
                                        href="{{ url('/data-pengguna/mahasiswa') }}"><span>Mahasiswa</span></a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="ion ion-android-person"></i> <span>Kelola Pengguna</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link"
                                        href="{{ url('/kelola-pengguna/admin') }}"><span>Admin</span></a></li>
                                <li><a class="nav-link"
                                        href="{{ url('/kelola-pengguna/dosen') }}"><span>Dosen</span></a></li>
                                <li><a class="nav-link"
                                        href="{{ url('/kelola-pengguna/mahasiswa') }}"><span>Mahasiswa</span></a></li>
                            </ul>
                        </li>

                        <li class="menu-header">Manajemen Magang</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Magang</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link"
                                        href="{{ url('/admin/mahasiswa/pengajuan-magang') }}">Permintaan Magang</a>
                                </li>
                                <li><a class="nav-link" href="{{ url('/admin/data-magang') }}">Data Magang</a></li>
                            </ul>
                            <li><a class="nav-link" href="{{ url('/admin/data-bimbingan-mahasiswa') }}"><i class="ion ion-android-list"></i><span>Data Bimbingan</span></a></li>
                            <li class="active"><a class="nav-link" href="{{  url('/admin/logbook/index') }}"><i class="ion ion-clipboard" data-pack="default" data-tags="write"></i> <span>Logbook</span></a></li>
                        </li>

                        <li class="menu-header">Finalisasi Magang</li>
                        <li ><a class="nav-link" href="{{ url('/admin/laporan-magang-mahasiswa') }}"><i class="ion ion-ios-book"></i> <span>Laporan Magang</span></a> </li>

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
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Log Book Aktivitas Mahasiswa</h1>
                    </div>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 col-md col-lg">
                                <div class="card">
                                    <!-- Head Logbook -->
                                    <div class="logbook-header text-center font-weight-bold mb-5 mt-5">
                                        VERIFIKASI LOG BOOK AKTIVITAS HARIAN
                                    </div>

                                    <form id="update-form" action="{{ url ('/dosen/logbook-mahasiswa/edit/' . $logbook->id) }}" method="POST" enctype="multipart/form-data">
                                        @method('patch')
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="verif" class="col-sm-3 col-form-label">Verifikasi Dosen</label>
                                                <div class="col-sm-5">
                                                    <select class="form-control" id="verif_dosen" name="verif">
                                                        <option value="" disabled>- Pilih status log book -</option>
                                                        <option value="0" {{ $logbook->verifikasi_dosen == 0 ? 'selected' : '' }}>Belum diverifikasi</option>
                                                        <option value="1" {{ $logbook->verifikasi_dosen == 1 ? 'selected' : '' }}>Verified</option>
                                                    </select>
                                                </div>
                                            </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <button type="submit" id="kirim" name="kirim" class="btn btn-primary m-2">Kirim</button>
                                                <button type="button" class="btn btn-warning m-2" onclick="window.history.back();">Batal</button>
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
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script> --}}
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script>
        var redirectUrl = "{{ url('/dosen/logbook-mahasiswa') }}";
    </script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/modules-sweetalert.js') }}"></script>
</body>

</html>