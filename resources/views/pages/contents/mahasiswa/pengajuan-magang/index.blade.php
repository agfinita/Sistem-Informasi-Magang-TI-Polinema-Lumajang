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
                        <a href="{{ url('/mahasiswa/dashboard') }}">SIMAG</a>
                    </div>
                    <!-- Menu Sidebar-->
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li><a class="nav-link" href="{{ url('/mahasiswa/dashboard') }}"><i
                                    class="ion ion-speedometer" data-pack="default" data-tags="travel, accelerate"></i>
                                <span>Dashboard</span></a></li>

                        <li class="menu-header">Magang</li>
                        <li class="active"><a class="nav-link" href="{{ url('/mahasiswa/pengajuan-magang') }}"><i class="ion ion-archive" data-pack="default" data-tags="mail""></i> <span>Pengajuan Magang</span></a></li>
                        <li><a class="nav-link" href="{{ url('/mahasiswa/data-magang') }}"><i class="fas fa-columns"></i> <span>Data Magang</span></a></li>

                        <li class="menu-header">Aktivitas Magang</li>
                        <li><a class="nav-link" href="{{ url('/mahasiswa/bimbingan') }}"><i class="fas fa-users"></i> <span>Bimbingan</span></a></li>
                        <li><a class="nav-link" href="{{ url('/mahasiswa/logbook') }}"><i class="ion ion-clipboard" data-pack="default" data-tags="write"></i> <span>Logbook</span></a></li>

                        <li class="menu-header">Finalisasi Magang</li>
                        <li><a class="nav-link" href="{{ url('/mahasiswa/laporan-magang') }}"><i class="ion ion-ios-book"></i> <span>Laporan Magang</span></a> </li>

                        {{-- <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i> <span>Magang</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ url('/persuratan') }}">Persuratan</a></li>
                            </ul>
                        </li> --}}

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
                        <h1>Pengajuan Magang Mahasiswa</h1>
                    </div>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Riwayat Pengajuan Magang </h4>
                                    </div>

                                    <div class="col-md-6 mx-2 my-auto">
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
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="table-1">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No</th>
                                                        <th>NIM</th>
                                                        <th>Status</th>
                                                        <th>Surat Pengantar Magang</th>
                                                    </tr>
                                                </thead>

                                                @php
                                                    $no = 1;
                                                @endphp
                                                <tbody>
                                                    @foreach ( $pengajuanMagang as $pm )
                                                    <tr>
                                                        <td class="text-center">{{ $no++ }}</td>
                                                        <td>{{ $pm->mahasiswa_id }}</td>
                                                        <td>
                                                            @if ($pm->status == 'diproses')
                                                                <div class="badge badge-warning">Diproses</div>
                                                            @elseif ($pm->status == 'selesai')
                                                                <div class="badge badge-success">Selesai</div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($pm->files)
                                                            <a href="{{ asset('storage/' . $pm->files) }}" download>{{ basename($pm->files) }}</a>
                                                            @else
                                                            <h5> - </h5>
                                                            @endif
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

<!-- Template JS File -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

<!-- Data Tables -->
<script src="{{ asset('node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>

</body>

</html>
