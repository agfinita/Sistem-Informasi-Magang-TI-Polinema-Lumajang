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
                        <li><a class="nav-link" href="{{ url('/dosen/dashboard') }}"><i class="ion ion-speedometer" data-pack="default" data-tags="travel, accelerate"></i> <span>Dashboard</span></a></li>
                        <li><a class="nav-link" href="{{ url('/dosen/pengumuman') }}"><i class="ion ion-speakerphone"></i><span>Pengumuman</span></a></li>

                        <li class="menu-header">Magang</li>
                        <li><a class="nav-link" href="{{ url('/dosen/data-magang-mahasiswa') }}"><i class="fas fa-columns"></i> <span>Data Magang</span></a></li>

                        <li class="menu-header">Aktivitas Magang</li>
                        <li><a class="nav-link" href="/dosen/bimbingan-mahasiswa"><i class="fas fa-users"></i> <span>Bimbingan</span></a></li>
                        <li><a class="nav-link" href="{{ url('/dosen/logbook-mahasiswa') }}"><i class="ion ion-clipboard" data-pack="default" data-tags="write"></i> <span>Logbook</span></a></li>

                        <li class="menu-header">Verifikasi</li>
                        <li class="active"><a class="nav-link" href="{{ url('/dosen/laporan-magang-mahasiswa') }}"><i class="ion ion-ios-book"></i> <span>Laporan Magang</span></a> </li>

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
                        <h1>Verifikasi Laporan Magang Mahasiswa</h1>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-1">
                                            <thead>
                                                <tr>
                                                    <th>NIM</th>
                                                    <th>Nama</th>
                                                    <th>Kelas</th>
                                                    <th>Kategori Magang</th>
                                                    <th>Instansi</th>
                                                    <th>Dosen Pembimbing</th>
                                                    <th class="text-center">Status Laporan</th>
                                                    {{-- <th>Laporan Magang</th>
                                                    <th>Catatan</th>
                                                    <th>Status Laporan</th>
                                                    <th>Status Magang</th> --}}
                                                    <th class="text-center">Aksi</th>
                                                </tr>
                                            </thead>

                                            @php
                                                $no = 1;
                                            @endphp
                                            <tbody>
                                                @foreach ($laporanMagang as $lm)
                                                    <tr>
                                                        <td>{{ $lm->mahasiswa->nim }}</td>
                                                        <td>{{ $lm->mahasiswa->nama }}</td>
                                                        <td>{{ $lm->mahasiswa->kelas}}</td>
                                                        <td>{{ $lm->dataMagang->kategori_magang }}</td>
                                                        <td>{{ $lm->dataMagang->pengajuanMagang->instansi_magang }}</td>
                                                        <td>{{ $lm->dataBimbingan->dosen->nama }}</td>
                                                        {{-- <td>
                                                            @if ($lm->laporan_magang)
                                                            <a href="{{ asset('storage/uploads/laporan-magang/' . $lm->laporan_magang) }}" download>{{ basename($lm->laporan_magang) }}</a>
                                                            @else
                                                            <h5> - </h5>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (isset($lm->catatan))
                                                            {{ $lm->catatan }}
                                                            @else
                                                            <h5> - </h5>
                                                            @endif
                                                        </td> --}}
                                                        <td class="text-center">
                                                            @if ($lm->status_laporan == '1')
                                                                <div class="badge badge-success">Verified</div>
                                                            @else
                                                                <h5> - </h5>
                                                            @endif
                                                        </td>
                                                        {{-- <td class="text-center">
                                                            @if ($lm->dataMagang->status_magang == 'selesai')
                                                            <div class="badge badge-success">Selesai</div>
                                                            @elseif ($lm->dataMagang->status_magang == 'sedang magang')
                                                            <div class="badge badge-warning">Sedang magang</div>
                                                            @elseif ($lm->dataMagang->status_magang == 'belum dimulai')
                                                            <div class="badge badge-info">Belum dimulai</div>
                                                            @elseif ($lm->dataMagang->status_magang == 'dihentikan')
                                                            <div class="badge badge-danger">Dihentikan</div>
                                                            @endif
                                                        </td> --}}
                                                        <td class="text-center">
                                                            <!-- Lihat -->
                                                            <a type="button" class="btn btn-sm btn-info m-1 detail" href="{{ url('/dosen/laporan-magang-mahasiswa/show/' . $lm->id) }}"><i class="fas fa-eye"></i></a>
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

    <!-- Data Tables -->
    <script src="{{ asset('node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/index-0.js') }}"></script>
    <script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/page/modules-sweetalert.js') }}"></script>
</body>

</html>
