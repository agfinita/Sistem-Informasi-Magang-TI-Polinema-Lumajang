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
                        <h1>Logbook Aktivitas Mahasiswa</h1>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-1">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th>Nama</th>
                                                    <th class="text-center">Kelas</th>
                                                    <th>Instansi Magang</th>
                                                    <th>Kategori</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            @php
                                                $no = 1;
                                            @endphp
                                            <tbody>
                                                @foreach ($dataBimbingan as $db)
                                                    <tr>
                                                        <td class="text-center">{{ $no++ }}</td>
                                                        <td>{{ $db->mahasiswa->nama }}</td>
                                                        <td class="text-center">{{ $db->mahasiswa->kelas }}</td>
                                                        <td>{{ $db->dataMagang->pengajuanMagang->instansi_magang }}</td>
                                                        <td>{{ $db->dataMagang->kategori_magang }}</td>
                                                        <td>
                                                            <!-- Lihat detail logbook mahasiswa -->
                                                            <a href="{{ url('/admin/logbook/index', $db->dataMagang->id) }}">
                                                                <button class="btn btn-sm btn-info mx-1">
                                                                    Detail
                                                                </button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Data Tables -->
    <script src="{{ asset('node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/page/modules-sweetalert.js') }}"></script>
</body>

</html>
