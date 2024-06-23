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
            <div class="main-sidebar sidebar-style-2 non-printable">
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
                        <li><a class="nav-link" href="{{ url('/mahasiswa/dashboard') }}"><i class="ion ion-speedometer" data-pack="default" data-tags="travel, accelerate"></i><span>Dashboard</span></a></li>

                        <li class="menu-header">Magang</li>
                        <li><a class="nav-link" href="{{ url('/mahasiswa/pengajuan-magang') }}"><i class="ion ion-archive" data-pack="default" data-tags="mail"></i> <span>Pengajuan Magang</span></a></li>
                        <li><a class="nav-link" href="{{ url('/mahasiswa/data-magang') }}"><i class="fas fa-columns"></i> <span>Data Magang</span></a></li>

                        <li class="menu-header">Aktivitas Magang</li>
                        <li class="active"><a class="nav-link" href="{{ url('/mahasiswa/bimbingan') }}"><i class="fas fa-users"></i> <span>Bimbingan</span></a> </li>
                        <li ><a class="nav-link" href="{{ url('/mahasiswa/logbook') }}"><i class="ion ion-clipboard" data-pack="default" data-tags="write"></i> <span>Logbook</span></a></li>

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
                        <h1>Bimbingan Mahasiswa</h1>
                    </div>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 ">
                                <div class="card">
                                    <!-- Head Logbook -->
                                    <div class="text-center font-weight-bold mb-5 mt-5">
                                        BIMBINGAN MAHASISWA MAGANG
                                    </div>
                                    <div class="mb-5">
                                        @foreach ($dataMagang as $dm )
                                        <div class="row mb-2 mx-auto" style="max-width: 400px;">
                                            <div class="col-4">Nama</div>
                                            <div class="col-2">:</div>
                                            <div class="col-6">{{ $dm->mahasiswa->nama }}</div>
                                        </div>
                                        <div class="row mb-2 mx-auto" style="max-width: 400px;">
                                            <div class="col-4">NIM</div>
                                            <div class="col-2">:</div>
                                            <div class="col-6">{{ $dm->mahasiswa->nim }}</div>
                                        </div>
                                        <div class="row mb-2 mx-auto" style="max-width: 400px;">
                                            <div class="col-4">Jenis</div>
                                            <div class="col-2">:</div>
                                            <div class="col-6">{{ $dm->kategori_magang }}</div>
                                        </div>
                                        <div class="row mb-2 mx-auto" style="max-width: 400px;">
                                            <div class="col-4">Mitra Kegiatan</div>
                                            <div class="col-2">:</div>
                                            <div class="col-6">{{ $dm->pengajuanMagang->instansi_magang}} </div>
                                        </div>
                                        @endforeach
                                    </div>

                                    <div class="col-md-6 mx-2 my-auto">
                                        <!-- Tambah data -->
                                        <button type="submit" class="btn btn-success">
                                            <a href="{{ url('/mahasiswa/bimbingan/create') }}" class="text-decoration-none text-white">
                                                <span>
                                                    <i class="ion ion-plus-circled" data-pack="default"
                                                        data-tags="add, include, new, invite, +">
                                                    </i>
                                                </span>
                                                Tambah Data
                                            </a>
                                        </button>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example" class="display nowrap" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Pertemuan Ke-</th>
                                                        <th class="text-center">Tanggal</th>
                                                        <th>Pembahasan</th>
                                                        <th class="text-center">Batas Waktu</th>
                                                        <th class="text-center">Verifikasi Dosen Pembimbing</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($bimbingan as $bm)
                                                        <tr>
                                                            <td class="text-center">{{ $bm->pertemuan ?? '-' }}</td>
                                                            <td class="text-center">{{ $bm->tanggal?? '-' }}</td>
                                                            <td>{{ $bm->pembahasan ?? '-' }}</td>
                                                            <td class="text-center">{{ $bm->batas_waktu ?? '-' }}</td>
                                                            <td class="text-center">
                                                                @if ($bm->verifikasi_dosen == '1')
                                                                    <div class="badge badge-success">Sudah diverifikasi</div>
                                                                @else
                                                                    <div class="badge badge-secondary text-dark">Menunggu verifikasi</div>
                                                                @endif
                                                            </td>
                                                            <td class="d-flex justify-content-center align-items-center text-center">
                                                                <!-- Hapus -->
                                                                {{-- <form id="delete-form-{{ $bm->id }}" action="{{ url('/admin/data-magang/' . $bm->id) }}" method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="button" class="btn btn-sm btn-danger mx-1 swal-6" data-id="{{ $lb->id }}">
                                                                        <i class="ion ion-trash-a"
                                                                            data-pack="default"
                                                                            data-tags="delete, remove, dump"></i>
                                                                    </button>
                                                                </form> --}}
                                                                <div class="row">
                                                                    <!-- Update -->
                                                                    <a
                                                                        href="{{ url('/mahasiswa/bimbingan/edit/' . $bm->id) }}">
                                                                        <button class="btn btn-sm btn-warning mx-1">
                                                                            <i class="ion ion-edit" data-pack="default"
                                                                                data-tags="change, update, write, type, pencil"></i>
                                                                        </button>
                                                                    </a>

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

    <!-- Data Tables -->
    @include('pages.layouts.datatables-mahasiswa')

    <!-- JS Libraies -->
    <script src="{{ asset('node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/components-table.js') }}"></script>
    <script src="{{ asset('assets/js/page/modules-sweetalert.js') }}"></script>
</body>

</html>
