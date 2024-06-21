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
                        <li><a class="nav-link" href="{{ url('/mahasiswa/data-magang') }}"><i class="fas fa-columns" ></i> <span>Data Magang</span></a></li>

                        <li class="menu-header">Aktivitas Magang</li>
                        <li><a class="nav-link" href="{{ url('/mahasiswa/bimbingan') }}"><i class="fas fa-users"></i> <span>Bimbingan</span></a></li>
                        <li class="active"><a class="nav-link" href="{{ url('/mahasiswa/logbook') }}"><i class="ion ion-clipboard" data-pack="default" data-tags="write"></i> <span>Logbook</span></a></li>

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
                        <h1>Logbook Mahasiswa</h1>
                    </div>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 col-md col-lg">
                                <!--Horizontal-->
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Edit Logbook Mahasiswa</h4>
                                    </div>

                                    <form action="{{ url('/mahasiswa/logbook/edit', $logbook->id) }}" method="POST">
                                        @csrf
                                        @method('patch')
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="tgl_logbook" class="col-sm-3 col-form-label">Tanggal</label>
                                                <div class="col-sm-5">
                                                    <input type="date" class="form-control" id="tgl_logbook" name="tgl_logbook" value="{{ $logbook->tgl_logbook}}" autofocus>
                                                    {{-- @error('tgl_logbook')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror --}}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="jm" class="col-sm-3 col-form-label">Jam Mulai</label>
                                                <div class="col-sm-5">
                                                    <input type="time" class="form-control" id="jam_mulai" name="jm">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="js" class="col-sm-3 col-form-label">Jam Selesai</label>
                                                <div class="col-sm-5">
                                                    <input type="time" class="form-control" id="jam_selesai" name="js">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="kegiatan" class="col-sm-3 col-form-label">Penjelasan Kegiatan</label>
                                                <div class="col-sm-5">
                                                    <textarea class="form-control" name="kegiatan" id="kegiatan" cols="60" rows="5" placeholder="Deskripsi aktivitas magang"></textarea>
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
      var redirectUrl = "{{ url('/mahasiswa/logbook') }}";
  </script>

  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>

  <!-- Page Specific JS File -->
  <script src="{{ asset('assets/js/page/modules-sweetalert.js') }}"></script>
</body>

</html>
