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
                            <li class="nav-item dropdown active">
                                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                        class="ion ion-android-person"></i> <span>Kelola Pengguna</span></a>
                                    <ul class="dropdown-menu">
                                        <li class="active"><a class="nav-link" href="{{ url('/kelola-pengguna/admin') }}"><span>Admin</span></a></li>
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
                            <li><a class="nav-link" href="{{ url('/admin/data-bimbingan-mahasiswa') }}"><i class="ion ion-android-list"></i><span>Dosen Pembimbing</span></a></li>
                        </li>

                        <li class="menu-header">Aktivitas Magang</li>
                        <li><a class="nav-link" href="{{  url('/admin/logbook') }}"><i class="ion ion-clipboard" data-pack="default" data-tags="write"></i> <span>Logbook</span></a></li>
                        <li><a class="nav-link" href="{{  url('/admin/bimbingan') }}"><i class="fas fa-users"></i> <span>Bimbingan</span></a></li>

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
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>User Admin</h4>
                                    </div>

                                    {{-- <div class="col-md-6 mx-2 my-auto">
                                        <!-- Tambah data -->
                                        <button type="submit" class="btn btn-success">
                                            <a href="{{ url('/kelolaAdmin') }}" class="text-decoration-none text-white">
                                                <span>
                                                    <i class="ion ion-plus-circled" data-pack="default" data-tags="add, include, new, invite, +">
                                                    </i>
                                                </span>
                                                Tambah Data
                                            </a>
                                        </button>
                                    </div> --}}

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example" class="display nowrap" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Nama</th>
                                                        <th class="text-center">Username</th>
                                                        <th>Email</th>
                                                        <th class="text-center">Role</th>
                                                        <th class="text-center">Status</th>
                                                        <th class="text-center">Date Created</th>
                                                        <th class="text-center">Date Updated</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>

                                                @php
                                                    $no = 1;
                                                @endphp
                                                <tbody>
                                                    @foreach ($users as $u)
                                                        <tr>

                                                            <td>{{ $u->nama }}</td>
                                                            <td>{{ $u->username }}</td>
                                                            <td>{{ $u->email }}</td>
                                                            <td>{{ $u->role }}</td>
                                                            <td>
                                                                @if ($u->is_active == 1)
                                                                <div class="badge badge-success">Active</div>
                                                                @else
                                                                <div class="badge badge-danger">Not active</div>
                                                                @endif
                                                            </td>
                                                            <td>{{ $u->created_at }}</td>
                                                            <td>{{ $u->updated_at }}</td>
                                                            <td>
                                                                <div class="d-flex justify-content-center align-items-center">
                                                                    <a href="{{ url('/kelola-pengguna/admin/edit/' . $u->id) }}">
                                                                        <button class="btn btn-sm btn-warning mx-1 edit">
                                                                            <i class="far fa-edit"></i>
                                                                        </button>
                                                                    </a>

                                                                    <form id="delete-form-{{ $u->id }}" action="{{ url('/kelola-pengguna/admin/' . $u->id) }}" method="POST" >
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button type="button" class="btn btn-sm btn-danger mx-1 swal-6 hapus" data-id="{{ $u->id }}">
                                                                            <i class="far fa-trash-alt"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
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
    @include('pages.layouts.datatables')

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/modules-sweetalert.js') }}"></script>
</body>

</html>
