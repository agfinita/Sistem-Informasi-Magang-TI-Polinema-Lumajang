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
                        <a href="{{ url('/') }}">Admin</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{ url('/') }}">SIMMAG</a>
                    </div>
                    <!-- Menu Sidebar-->
                    <ul class="sidebar-menu">
                        <li><a class="nav-link" href="{{ url('/') }}"><i class="ion ion-speedometer" data-pack="default" data-tags="travel, accelerate"></i><span>Dashboard</span></a></li>
                        <li><a class="nav-link" href="{{ url('/pengumuman') }}"><i class="fa fa-bullhorn"></i><span>Pengumuman</span></a></li>

                        <li class="menu-header">Manajemen Pengguna</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fa fa-school"></i> <span>Data Pengguna</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ url('/dataAdmin') }}"><span>Admin</span></a></li>
                                <li><a class="nav-link" href="{{ url('/dataDosen') }}"><span>Dosen</span></a></li>
                                <li><a class="nav-link" href="{{ url('/dataMahasiswa') }}"><span>Mahasiswa</span></a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fa fa-user"></i> <span>Kelola Pengguna</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ url('/tableUserAdmin') }}"><span>Admin</span></a></li>
                                <li><a class="nav-link" href="{{ url('/tableUserDosen') }}"><span>Dosen</span></a></li>
                                <li><a class="nav-link" href="{{ url('/tableUserMahasiswa') }}"><span>Mahasiswa</span></a></li>
                            </ul>
                        </li>

                        <li class="menu-header">Mahasiswa</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Magang</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ url('/persuratan') }}">Persuratan</a></li>
                                <li><a class="nav-link" href="{{ url('/data-magang') }}">Data Magang</a></li>
                            </ul>
                        </li>

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
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 col-md col-lg">
                                <!--Horizontal-->
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Update Data Admin</h4>
                                    </div>
                                    <form action="{{ url('/updateDataAdmin/' . $admin->id) }}" method="POST" autocomplete="off">
                                        @method('patch')
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" id="nip"
                                                        name="nip" placeholder="Masukkan NIM" autofocus value={{ $admin->nip }}>

                                                    {{-- alert --}}
                                                    @if (count($errors) > 0)
                                                        <div style="width: auto; color:red; margin-top:0.25rem;">
                                                            {{ $errors->first('nip') }}
                                                        </div>
                                                    @endif
                                                    {{-- end of alert --}}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" id="nama"
                                                        name="nama" placeholder="Masukkan nama" value="{{ $admin->nama }}">

                                                    {{-- alert --}}
                                                    @if (count($errors) > 0)
                                                        <div style="width: auto; color:red; margin-top:0.25rem;">
                                                            {{ $errors->first('nama') }}
                                                        </div>
                                                    @endif
                                                    {{-- end of alert --}}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-7">
                                                    <input type="email" class="form-control" id="email"
                                                        name="email" placeholder="Masukkan Email" value="{{ $admin->email }}">

                                                    {{-- alert --}}
                                                    @if (count($errors) > 0)
                                                        <div style="width: auto; color:red; margin-top:0.25rem;">
                                                            {{ $errors->first('email') }}
                                                        </div>
                                                    @endif
                                                    {{-- end of alert --}}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="telp" class="col-sm-3 col-form-label">No
                                                    Telepon</label>
                                                <div class="col-sm-3">
                                                    <input type="telp" class="form-control" id="telp"
                                                        name="telp" placeholder="Masukkan no telepon aktif" value="{{ $admin->telp }}">

                                                    {{-- alert --}}
                                                    @if (count($errors) > 0)
                                                        <div style="width: auto; color:red; margin-top:0.25rem;">
                                                            {{ $errors->first('telp') }}
                                                        </div>
                                                    @endif
                                                    {{-- end of alert --}}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" id="alamat"
                                                        name="alamat" placeholder="Masukkan alamat" value="{{ $admin->alamat }}">

                                                    {{-- alert --}}
                                                    @if (count($errors) > 0)
                                                    <div style="width: auto; color:red; margin-top:0.25rem;">
                                                        {{ $errors->first('alamat') }}
                                                    </div>
                                                    @endif
                                                    {{-- end of alert --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" id="kirim" name="kirim" class="btn btn-primary m-2">Simpan</button>
                                            <a href="{{ url('/dataAdmin') }}" class="btn btn-warning m-2">Batal</a>
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
    <script src="../assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
</body>

</html>
