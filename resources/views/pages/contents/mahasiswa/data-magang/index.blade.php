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
                        <a href="{{ url('/mahasiswa/dashboard') }}">{{ Auth::user()->role }}</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{ url('/mahasiswa/dashboard') }}">SIMMAG</a>
                    </div>
                    <!-- Menu Sidebar-->
                    <ul class="sidebar-menu">
                        <li><a class="nav-link" href="{{ url('/mahasiswa/dashboard') }}"><i
                                    class="ion ion-speedometer" data-pack="default" data-tags="travel, accelerate"></i>
                                <span>Dashboard</span></a></li>

                        <li class="menu-header">Magang</li>
                        <li><a class="nav-link" href="{{ url('/mahasiswa/pengajuan-magang') }}"><i class="ion ion-card" data-pack="default"
                                    data-tags="travel, accelerate"></i> <span>Pengajuan Magang</span></a></li>
                        <li class="active"><a class="nav-link" href="{{ url('/mahasiswa/data-magang') }}"><i class="fas fa-columns" data-pack="default"
                                    data-tags="travel, accelerate"></i> <span>Data Magang</span></a></li>

                        <li class="menu-header">Aktivitas Magang</li>
                        <li><a class="nav-link" href="#"><i class="fas fa-users" data-pack="default"
                                    data-tags="travel, accelerate"></i> <span>Bimbingan</span></a></li>
                        <li><a class="nav-link" href="#"><i class="fas fa-columns" data-pack="default"
                                    data-tags="travel, accelerate"></i> <span>Logbook</span></a></li>

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
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Data Magang Mahasiswa</h4>
                                    </div>

                                    {{-- <div class="col-md-6 mx-2 my-auto">
                                        <!-- Tambah data -->
                                        <button type="submit" class="btn btn-success">
                                            <a href="{{ url('/mahasiswa/pengajuan-magang/create') }}" class="text-decoration-none text-white">
                                                <span>
                                                    <i class="ion ion-plus-circled" data-pack="default" data-tags="add, include, new, invite, +">
                                                    </i>
                                                </span>
                                                Data Baru
                                            </a>
                                        </button>
                                    </div> --}}

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="table-1">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            No
                                                        </th>
                                                        <th>NIM</th>
                                                        <th>Nama</th>
                                                        <th>Kelas</th>
                                                        <th>Jurusan</th>
                                                        <th>Instansi Magang</th>
                                                        <th>Alamat Instansi</th>
                                                        <th>Periode</th>
                                                        <th>Tanggal Dimulai</th>
                                                        <th>Tanggal Selesai</th>
                                                    </tr>
                                                </thead>

                                                @php
                                                    $no = 1;
                                                @endphp
                                                <tbody>
                                                    @foreach ( $dm as $dataMagang )
                                                    <tr>
                                                        <td class="text-center">{{ $no++ }}</td>
                                                        <td>{{ $dataMagang->mahasiswa->nim }}</td>
                                                        <td>{{ $dataMagang->mahasiswa->nama }}</td>
                                                        <td>{{ $dataMagang->mahasiswa->kelas }}</td>
                                                        <td>{{ $dataMagang->mahasiswa->jurusan }}</td>
                                                        <td>{{ $dataMagang->pengajuan_magang->instansi_magang }}</td>
                                                        <td>{{ $dataMagang->pengajuan_magang->alamat_magang }}</td>
                                                        <td>{{ $dataMagang->periode }}</td>
                                                        <td>{{ $dataMagang->tanggal_mulai }}</td>
                                                        <td>{{ $dataMagang->tanggal_selesai }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <th class="text-center">
                                                            No
                                                        </th>
                                                        <th>NIM</th>
                                                        <th>Nama</th>
                                                        <th>Kelas</th>
                                                        <th>Jurusan</th>
                                                        <th>Instansi Magang</th>
                                                        <th>Alamat Instansi</th>
                                                        <th>Periode</th>
                                                        <th>Tanggal Dimulai</th>
                                                        <th>Tanggal Selesai</th>
                                                    </tr>
                                                </tfoot>
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
<script src="{{ asset('node_modules/simpleweather/jquery.simpleWeather.min.js') }}"></script>
<script src="{{ asset('node_modules/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('node_modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('node_modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
<script src="{{ asset('node_modules/summernote/dist/summernote-bs4.js') }}"></script>
<script src="{{ asset('node_modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

<!-- Template JS File -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

<!-- Data Tables -->
<script src="{{ asset('node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('assets/js/page/index-0.js') }}"></script>
<script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>

</body>

</html>
