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
                        <h1>Data Magang</h1>
                    </div>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 col-md col-lg">
                                <!--Horizontal-->
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Formulir Data Magang Mahasiswa</h4>
                                    </div>

                                    <form id="create-form-data" action="{{ url('/mahasiswa/data-magang') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="nim" class="col-sm-3 col-form-label">NIM</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM" value="{{ $mahasiswa->nim }}" autofocus readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama" value="{{ $mahasiswa->nama }}" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="control-kelas" class="col-sm-3 col-form-label">Kelas</label>
                                                <div class="col-sm-2">
                                                    <select class="form-control" id="control-kelas" name="control-kelas" disabled>
                                                        <option value="3A" {{ $mahasiswa->kelas == '3A' ? 'selected' : '' }}>3A</option>
                                                        <option value="3B" {{ $mahasiswa->kelas == '3B' ? 'selected' : '' }}>3B</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="control-jurusan" class="col-sm-3 col-form-label">Jurusan</label>
                                                <div class="col-sm-2">
                                                    <select class="form-control" id="control-jurusan" name="control-jurusan" disabled>
                                                        <option value= "D3 TI" {{ $mahasiswa->jurusan == 'D3 TI' ? 'selected' : '' }}>D3 TI</option>
                                                        <option value= "D4 TI" {{ $mahasiswa->jurusan == 'D4 TI' ? 'selected' : '' }}>D4 TI</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="kategori" class="col-sm-3 col-form-label">Kategori Magang</label>
                                                <div class="col-sm-5">
                                                    <select class="form-control" id="kategori" name="kategori">
                                                        <option value="" selected disabled>- Pilih kategori magang -</option>
                                                        <option value="MSIB">MSIB</option>
                                                        <option value="Studi Independen">Studi Independen</option>
                                                        <option value="MBKM">MBKM</option>
                                                        <option value="Magang Mandiri">Magang Mandiri</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="instansi_magang" class="col-sm-3 col-form-label">Instansi Magang</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" id="instansi_magang" name="instansi_magang" placeholder="Masukkan instansi magang" value="{{ $pengajuanMagang->instansi_magang ?? '' }}" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="alamat_magang" class="col-sm-3 col-form-label">Alamat Instansi Magang</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" id="alamat_magang" name="alamat_magang" placeholder="Masukkan alamat instansi magang" value="{{ $pengajuanMagang->alamat_magang ?? '' }}" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="period" class="col-sm-3 col-form-label"> Periode Magang </label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" id="period" name="period" placeholder="Contoh: 5 bulan">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Tanggal Mulai</label>
                                                <div class="col-sm-3">
                                                    <input type="date"  name="tm" id="tm" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Tanggal Selesai</label>
                                                <div class="col-sm-3">
                                                    <input type="date"  name="ts" id="ts" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="file" class="col-sm-3 col-form-label">File LoA</label>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <input type="file" class="form-control-file" id="file" name="file">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <div class="row">
                                                <button type="submit" id="kirim" name="kirim" class="btn btn-primary m-2">Simpan</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script>
        var redirectUrl = "{{ url('/mahasiswa/data-magang') }}";
    </script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/modules-sweetalert.js') }}"></script>
</body>

</html>
