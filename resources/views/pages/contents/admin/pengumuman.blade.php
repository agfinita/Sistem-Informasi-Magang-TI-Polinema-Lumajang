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
                        <li><a class="nav-link" href="{{ url('/') }}"><i
                            class="ion ion-speedometer" data-pack="default" data-tags="travel, accelerate"></i> <span>Dashboard</span></a></li>
                        <li class="active"><a class="nav-link" href="{{ url('/pengumuman') }}"><i class="fa fa-bullhorn"></i>
                            <span>Pengumuman</span></a></li>


                            <li class="menu-header">Manajemen Pengguna</li>
                            <li class="nav-item-dropdown">
                                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                                    <i class="fa fa-school"></i><span>Data Pengguna</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="nav-link" href="{{ url('/dataAdmin') }}"><span>Admin</span></a></li>
                                    <li><a class="nav-link" href="{{ url('/dataDosen') }}"><span>Dosen</span></a></li>
                                    <li><a class="nav-link" href="{{ url('/dataMahasiswa') }}"><span>Mahasiswa</span></a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                        class="fa fa-user"></i> <span>Kelola Pengguna</span></a>
                                    <ul class="dropdown-menu">
                                        <li><a class="nav-link" href="{{ url('/tableUserAdmin') }}"><span>Admin</span></a></li>
                                        <li><a class="nav-link" href="{{ url('/tableUserDosen') }}"><span>Dosen</span></a></li>
                                        <li><a class="nav-link" href="{{ url('/tableUserMahasiswa') }}"><span>Mahasiswa</span></a></li>
                                    </ul>
                            </li>

                        <li class="menu-header">Pages</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i> <span>Magang</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ url('/persuratan') }}">Persuratan</a></li>
                                <li><a class="nav-link" href="{{ url('/data-magang') }}">Data Magang</a></li>
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
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Pengumuman</h4>
                                </div>

                                <div class="col-md-6 mx-2 my-auto">
                                    <!-- Tambah data -->
                                    <button type="submit" class="btn btn-success">
                                        <a href="{{ url('/formPengumuman') }}" class="text-decoration-none text-white">
                                            <span>
                                                <i class="ion ion-plus-circled" data-pack="default" data-tags="add, include, new, invite, +">
                                                </i>
                                            </span>
                                            Tambah Data
                                        </a>
                                    </button>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-1">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th>Judul</th>
                                                    <th>Deskripsi</th>
                                                    <th>Kategori</th>
                                                    <th>Penulis</th>
                                                    <th>Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            @php
                                                $no = 1;
                                            @endphp
                                            <tbody>
                                                @foreach ($pengumuman as $p)
                                                    <tr>
                                                        <td class="text-center">{{ $no++ }}</td>
                                                        <td>{{ $p->judul }}</td>
                                                        <td>{{ $p->deskripsi }}</td>
                                                        <td>{{ $p->kategori }}</td>
                                                        <td>{{ $p->created_by }}</td>
                                                        <td>{{ $p->created_at }}</td>

                                                        <td>
                                                            <div class="row">
                                                                <a href="#">
                                                                    <button class="btn btn-sm btn-warning mx-1">
                                                                        <i class="ion ion-edit" data-pack="default" data-tags="change, update, write, type, pencil"></i>
                                                                    </button>
                                                                </a>

                                                                <form action="{{ url('/pengumuman/' . $p->id) }}" method="POST" onsubmit="return confirm('Are you sure delete data?')">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button class="btn btn-sm btn-danger mx-1">
                                                                        <i class="ion ion-trash-a" data-pack="default" data-tags="delete, remove, dump"></i>
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

    <!-- Data Tables -->
    <script src="../node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="../assets/js/page/index-0.js"></script>
    <script src="../assets/js/page/modules-datatables.js"></script>
</body>

</html>
