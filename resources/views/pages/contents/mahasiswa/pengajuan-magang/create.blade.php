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
                        <li><a class="nav-link" href="{{ url('/mahasiswa/dashboard') }}"><i class="ion ion-speedometer"
                                    data-pack="default" data-tags="travel, accelerate"></i>
                                <span>Dashboard</span></a></li>

                        <li class="menu-header">Magang</li>
                        <li><a class="nav-link" href="{{ url('/mahasiswa/pengajuan-magang') }}"><i class="ion ion-archive" data-pack="default" data-tags="mail"></i> <span>Pengajuan
                                    Magang</span></a></li>
                        <li><a class="nav-link" href="{{ url('/mahasiswa/data-magang') }}"><i class="fas fa-columns"></i> <span>Data Magang</span></a></li>

                        <li class="menu-header">Aktivitas Magang</li>
                        <li><a class="nav-link" href="#"><i class="fas fa-users"></i> <span>Bimbingan</span></a></li>
                        <li><a class="nav-link" href="#"><i class="ion ion-clipboard" data-pack="default" data-tags="write"></i> <span>Logbook</span></a></li>

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
                        <h1>Pengajuan Magang</h1>
                    </div>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 col-md col-lg">
                                <!--Horizontal-->
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Pengajuan Magang Mahasiswa</h4>
                                    </div>
                                    <form action="{{ url('/prosesPermintaan') }}" method="POST" autocomplete="off">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" id="nim"
                                                        name="nim" placeholder="Masukkan NIM" autofocus>
                                                    {{-- alert --}}
                                                    @if (count($errors) > 0)
                                                        <div style="width: auto; color:red; margin-top:0.25rem;">
                                                            {{ $errors->first('nim') }}
                                                        </div>
                                                    @endif
                                                    {{-- end of alert --}}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="instansi_magang" class="col-sm-2 col-form-label">Tempat
                                                    Magang</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" id="instansi_magang" name="instansi_magang" placeholder="Masukkan Instansi Magang" autofocus>
                                                    {{-- alert --}}
                                                    @if (count($errors) > 0)
                                                        <div style="width: auto; color:red; margin-top:0.25rem;">
                                                            {{ $errors->first('instansi_magang') }}
                                                        </div>
                                                    @endif
                                                    {{-- end of alert --}}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="alamat_magang" class="col-sm-2 col-form-label">Alamat
                                                    Magang</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" id="alamat_magang" name="alamat_magang" placeholder="Masukkan Alamat Instansi Magang" autofocus>
                                                    {{-- alert --}}
                                                    @if (count($errors) > 0)
                                                        <div style="width: auto; color:red; margin-top:0.25rem;">
                                                            {{ $errors->first('alamat_magang') }}
                                                        </div>
                                                    @endif
                                                    {{-- end of alert --}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <div class="row justify-content-end col-sm-4">
                                                <div class="col-auto mr-2">
                                                    <button type="submit" id="kirim" name="kirim" class="btn btn-primary">Proses permintaan</button>
                                                </div>
                                                <div class="col-auto">
                                                    <button type="button" class="btn btn-warning" onclick="window.history.back();">Batal</button>
                                                </div>
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

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>
