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
                        <li><a class="nav-link" href="{{ url('/mahasiswa/pengajuan-magang') }}"><i class="ion ion-archive" data-pack="default" data-tags="mail""></i> <span>Pengajuan Magang</span></a></li>
                        <li class="active"><a class="nav-link" href="{{ url('/mahasiswa/data-magang') }}"><i class="fas fa-columns" ></i> <span>Data Magang</span></a></li>

                        <li class="menu-header">Aktivitas Magang</li>
                        <li><a class="nav-link" href="{{ url('/mahasiswa/bimbingan') }}"><i class="fas fa-users"></i> <span>Bimbingan</span></a></li>
                        <li><a class="nav-link" href="{{ url('/mahasiswa/logbook') }}"><i class="ion ion-clipboard" data-pack="default" data-tags="write"></i> <span>Logbook</span></a></li>

                        <li class="menu-header">Finalisasi Magang</li>
                        <li><a class="nav-link" href="{{ url('/mahasiswa/laporan-magang') }}"><i class="ion ion-ios-book"></i> <span>Laporan Magang</span></a> </li>

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
                        <h1>Data Magang Mahasiswa</h1>
                    </div>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header text-danger">
                                        <h6>*Mahasiswa dapat mengisi data magang apabila telah memperoleh surat balasan magang/Letter of Acceptance (LoA) dari instansi magang yang dituju</h6>
                                    </div>

                                    <!-- Tambah data -->
                                    <div class="col-md-6 mx-2 my-4">
                                        <button type="submit" class="btn btn-success">
                                            <a href="{{ url('/mahasiswa/data-magang/create') }}" class="text-decoration-none text-white">
                                                <span>
                                                    <i class="ion ion-plus-circled" data-pack="default" data-tags="add, include, new, invite, +">
                                                    </i>
                                                </span>
                                                Data Baru
                                            </a>
                                        </button>
                                    </div>

                                    <!-- Dosen pembimbing -->
                                    <div class="d-flex justify-content-end mx-3">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <th>Dosen Pembimbing:</th>
                                                    <td>
                                                        {{ $dataBimbingan->dosen ? $dataBimbingan->dosen->nama : '-' }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="table-1">
                                                <thead>
                                                    <tr>
                                                        <th>Action</th>
                                                        <th>NIM</th>
                                                        <th>Nama</th>
                                                        <th>Kelas</th>
                                                        <th>Jurusan</th>
                                                        <th>Kategori</th>
                                                        <th>Instansi Magang</th>
                                                        <th>Alamat Instansi</th>
                                                        <th>Status</th>
                                                        <th>Periode</th>
                                                        <th>Tanggal Dimulai</th>
                                                        <th>Tanggal Selesai</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ( $dataMagang as $dm )
                                                    <tr>
                                                        <td>
                                                            <!-- Update -->
                                                            <a href="{{ url('/mahasiswa/data-magang/edit/' . $dm->id) }}">
                                                                <button class="btn btn-sm btn-warning mx-1">
                                                                    <i class="ion ion-edit" data-pack="default"
                                                                    data-tags="change, update, write, type, pencil"></i>
                                                                </button>
                                                            </a>
                                                        </td>

                                                        <td>{{ $dm->mahasiswa->nim }}</td>
                                                        <td>{{ $dm->mahasiswa->nama }}</td>
                                                        <td>{{ $dm->mahasiswa->kelas }}</td>
                                                        <td>{{ $dm->mahasiswa->jurusan }}</td>
                                                        <td>{{ $dm->kategori_magang }}</td>
                                                        <td>{{ $dm->pengajuanMagang->instansi_magang }}</td>
                                                        <td>{{ $dm->pengajuanMagang->alamat_magang }}</td>
                                                        <td>
                                                            @if ($dm->status_magang == 'selesai')
                                                                <div class="badge badge-success">Selesai</div>
                                                            @elseif ($dm->status_magang == 'sedang magang')
                                                                <div class="badge badge-warning">Sedang magang</div>
                                                            @elseif ($dm->status_magang == 'belum dimulai')
                                                                <div class="badge badge-info">Belum dimulai</div>
                                                            @endif
                                                        </td>
                                                        <td>{{ $dm->periode }}</td>
                                                        <td>{{ $dm->tanggal_mulai }}</td>
                                                        <td>{{ $dm->tanggal_selesai }}</td>

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
