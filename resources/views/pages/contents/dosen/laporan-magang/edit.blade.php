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

                        <li class="menu-header">Magang</li>
                        <li><a class="nav-link" href="{{ url('/dosen/data-magang-mahasiswa') }}"><i class="fas fa-columns"></i> <span>Data Magang</span></a></li>
                        <li><a class="nav-link" href="{{ url('/dosen/data-bimbingan-mahasiswa') }}"><i class="ion ion-android-list"></i> <span>Data Bimbingan</span></a></li>

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

                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 col-md col-lg">
                                <div class="card">
                                    <form id="update-form" action="{{ url ('/dosen/laporan-magang-mahasiswa/edit/' . $laporanMagang->id) }}" method="POST" enctype="multipart/form-data">
                                        @method('patch')
                                        @csrf
                                        <div class="card-body">
                                            <!-- Catatan -->
                                            <div class="form-group row">
                                                <label for="note" class="col-sm-3 col-form-label">Catatan</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" id="catatan" name="note" placeholder="Tulis catatan" value="{{ $laporanMagang->catatan ?? '' }}" autocomplete="off">
                                                    <small class="form-text text-danger">*Catatan boleh kosong</small>
                                                </div>
                                            </div>

                                            <!-- Status laporan magang -->
                                            <div class="form-group row">
                                                <label for="status-lap" class="col-sm-3 col-form-label">Status Laporan Magang</label>
                                                <div class="col-sm-5">
                                                    <select class="form-control" id="status_laporan" name="status-lap">
                                                        <option value="" disabled>- Pilih status laporan -</option>
                                                        <option value="0" {{ $laporanMagang->status_laporan == 0 ? 'selected' : '' }}>Belum diverifikasi</option>
                                                        <option value="1" {{ $laporanMagang->status_laporan == 1 ? 'selected' : '' }}>Verified</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Status magang mahasiswa -->
                                            <div class="form-group row">
                                                <label for="status_magang" class="col-sm-3 col-form-label">Status Magang</label>
                                                <div class="col-sm-5">
                                                    <select class="form-control" name="status_magang" id="status_magang">
                                                        <option value="" disabled>-Pilih status magang-</option>
                                                        <option value="belum dimulai" {{ $laporanMagang->dataMagang->status_magang == 'belum dimulai' ? 'selected' : '' }}>Belum dimulai</option>
                                                        <option value="sedang magang" {{ $laporanMagang->dataMagang->status_magang == 'sedang magang' ? 'selected' : '' }}>Sedang magang</option>
                                                        <option value="selesai" {{ $laporanMagang->dataMagang->status_magang == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                        <option value="dihentikan" {{ $laporanMagang->dataMagang->status_magang == 'dihentikan' ? 'selected' : '' }}>Dihentikan</option>
                                                    </select>
                                                </div>
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
        var redirectUrl = "{{ url('/dosen/laporan-magang-mahasiswa') }}";
    </script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/modules-sweetalert.js') }}"></script>
</body>

</html>
