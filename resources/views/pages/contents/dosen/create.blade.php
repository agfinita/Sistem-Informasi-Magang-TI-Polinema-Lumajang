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
                        <li class="active"><a class="nav-link" href="{{ url('/dosen/dashboard') }}"><i class="ion ion-speedometer"
                                    data-pack="default" data-tags="travel, accelerate"></i>
                                <span>Dashboard</span></a></li>

                        <li class="menu-header">Magang</li>
                        <li><a class="nav-link" href="{{ url('/dosen/data-magang-mahasiswa') }}"><i class="fas fa-columns"></i> <span>Data Magang</span></a></li>
                        <li><a class="nav-link" href="{{ url('/dosen/data-bimbingan-mahasiswa') }}"><i class="ion ion-android-list"></i> <span>Data Bimbingan</span></a></li>

                        <li class="menu-header">Aktivitas Magang</li>
                        <li><a class="nav-link" href="/dosen/bimbingan-mahasiswa"><i class="fas fa-users"></i> <span>Bimbingan</span></a></li>
                        <li><a class="nav-link" href="{{ url('/dosen/logbook-mahasiswa') }}"><i class="ion ion-clipboard" data-pack="default" data-tags="write"></i> <span>Logbook</span></a></li>

                        <li class="menu-header">Verifikasi</li>
                        <li><a class="nav-link" href="{{ url('/dosen/laporan-magang-mahasiswa') }}"><i class="ion ion-ios-book"></i> <span>Laporan Magang</span></a> </li>

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
                        <h1>Form Pengumuman</h1>
                    </div>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 col-md col-lg">
                                <!--Horizontal-->
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Pengumuman Baru</h4>
                                    </div>

                                    <form id="create-form" action="{{ url('/dosen/dashboard') }}" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul pengumuman" autofocus>

                                                    @if (count($errors) > 0)
                                                    <div style="width: auto; color:red; margin-top:0.25rem;">
                                                        {{ $errors->first('judul') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="desc" class="col-sm-3 col-form-label">Deskripsi</label>
                                                <div class="col-sm-9">
                                                    <textarea name="desc" class="summernote" cols="30" rows="10"></textarea>

                                                    @if (count($errors) > 0)
                                                    <div style="width: auto; color:red; margin-top:0.25rem;">
                                                        {{ $errors->first('desc') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="cat" class="col-sm-3 col-form-label">Kategori</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="cat" name="cat">
                                                        <option value="" disabled selected>Pilih kategori pengumuman</option>
                                                        <option value="Informasi">Informasi</option>
                                                        <option value="Pendaftaran">Pendaftaran</option>
                                                    </select>

                                                    @if (count($errors) > 0)
                                                    <div style="width: auto; color:red; margin-top:0.25rem;">
                                                        {{ $errors->first('cat') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="creator" class="col-sm-3 col-form-label">Penulis</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="creator" name="creator">
                                                        <option selected disabled>- select -</option>
                                                        <option value="Admin">Admin</option>
                                                        <option value="Dosen">Dosen</option>
                                                    </select>
                                                    @if (count($errors) > 0)
                                                    <div style="width: auto; color:red; margin-top:0.25rem;">
                                                        {{ $errors->first('creator') }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Date Created</label>
                                                <div class="col-sm-9">
                                                    <input type="datetime-local"  name="date_created" id="date_created" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <button type="submit" id="kirim" name="kirim" class="btn btn-primary">Tambah</button>
                                            <a href="{{ url('/dosen/dashboard') }}" class="btn btn-warning m-2">Batal</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script> --}}

    <!-- JS Libraies -->
    <script src="{{ asset('node_modules/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script>
        var redirectUrl = "{{ url('/dosen/dashboard') }}";
    </script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/modules-sweetalert.js') }}"></script>
</body>

</html>
