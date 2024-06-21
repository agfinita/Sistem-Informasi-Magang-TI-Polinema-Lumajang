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
                        <li><a class="nav-link" href="{{ url('/mahasiswa/dashboard') }}"><i class="ion ion-speedometer"
                                    data-pack="default" data-tags="travel, accelerate"></i>
                                <span>Dashboard</span></a></li>

                        <li class="menu-header">Magang</li>
                        <li><a class="nav-link" href="{{ url('/mahasiswa/pengajuan-magang') }}"><i
                                    class="ion ion-archive" data-pack="default" data-tags="mail""></i> <span>Pengajuan
                                    Magang</span></a></li>
                        <li><a class="nav-link" href="{{ url('/mahasiswa/data-magang') }}"><i
                                    class="fas fa-columns"></i> <span>Data Magang</span></a></li>

                        <li class="menu-header">Aktivitas Magang</li>
                        <li><a class="nav-link" href="{{ url('/mahasiswa/bimbingan') }}"><i class="fas fa-users"></i> <span>Bimbingan</span></a>
                        </li>
                        <li><a class="nav-link" href="{{ url('/mahasiswa/logbook') }}"><i class="ion ion-clipboard" data-pack="default"
                                    data-tags="write"></i> <span>Logbook</span></a></li>

                        <li class="menu-header">Finalisasi Magang</li>
                        <li class="active"><a class="nav-link" href="{{ url('/mahasiswa/laporan-magang') }}"><i
                                    class="ion ion-ios-book"></i> <span>Laporan Magang</span></a> </li>

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
                        <h1>Laporan Magang</h1>
                    </div>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Pengumpulan dan Verifikasi</h4>
                                    </div>

                                    <div class="card-body">
                                        <!-- Data Mahasiswa -->
                                            @foreach ($laporanMagang as $lpm )
                                                <div class="row justify-content-start">
                                                    <div class="col-6 col-sm-2 font-weight-bold">NIM</div>
                                                    <div class="col-6 col-sm-4">: {{ $lpm->mahasiswa->nim }}</div>
                                                    <div class="col-6 col-sm-2 font-weight-bold">Bidang</div>
                                                    <div class="col-6 col-sm-4">: Part terlupakan</div>
                                                </div>

                                                <div class="row justify-content-start">
                                                    <div class="col-6 col-sm-2 font-weight-bold">Nama</div>
                                                    <div class="col-6 col-sm-4">: {{ $lpm->mahasiswa->nama }}</div>
                                                    <div class="col-6 col-sm-2 font-weight-bold">Kategori</div>
                                                    <div class="col-6 col-sm-4">: {{ $lpm->dataMagang->kategori_magang }}</div>
                                                </div>

                                                <div class="row justify-content-start">
                                                    <div class="col-6 col-sm-2 font-weight-bold">Dosen Pembimbing</div>
                                                    <div class="col-6 col-sm-4">: {{ $lpm->dataBimbingan->dosen->nama ?? 'Belum ditentukan' }}</div>
                                                    <div class="col-6 col-sm-2 font-weight-bold">Instansi</div>
                                                    <div class="col-6 col-sm-4">: {{ $lpm->pengajuanMagang->instansi_magang }}</div>
                                                </div>
                                            @endforeach

                                        <!-- Data Laporan Magang -->
                                        <div class="table-responsive my-5">
                                            <table class="table table-bordered table-md">
                                                <thead>
                                                    <tr>
                                                        <th>Laporan Magang</th>
                                                        <th>Catatan</th>
                                                        <th>Status Laporan</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($laporanMagang as $lm)
                                                        <tr>
                                                            <td>
                                                                @if ($lm->laporan_magang)
                                                                    <a href="{{ asset('storage/uploads/laporan-magang/' . $lm->laporan_magang) }}" download>{{ basename($lm->laporan_magang) }}</a>
                                                                @else
                                                                    <h5> - </h5>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                @if ($lm->catatan)
                                                                    <p>{{ $lm->catatan }}</p>
                                                                @else
                                                                    <h5> - </h5>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                @if ($lm->status_laporan == 1)
                                                                    <div class="badge badge-success">Validated</div>
                                                                @else
                                                                    <h5> - </h5>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                <a href="{{ url('/mahasiswa/laporan-magang/edit/' . $lm->id)}}">
                                                                    <button class="btn btn-sm btn-warning mx-1">
                                                                        <i class="ion ion-edit" data-pack="default" data-tags="change, update, write, type, pencil"></i>
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

    <!-- Page Specific JS File -->

</body>

</html>
