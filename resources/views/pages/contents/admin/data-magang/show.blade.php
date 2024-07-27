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
                        <a href="{{ url('/') }}">SIMAG</a>
                    </div>
                    <!-- Menu Sidebar-->
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li><a class="nav-link" href="{{ url('/') }}"><i class="ion ion-speedometer"
                                    data-pack="default" data-tags="travel, accelerate"></i><span>Dashboard</span></a>
                        </li>
                        <li><a class="nav-link" href="{{ url('/pengumuman') }}"><i
                                    class="ion ion-speakerphone"></i><span>Pengumuman</span></a></li>

                        <li class="menu-header">Manajemen Pengguna</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="ion ion-ios-paper"></i> <span>Data Pengguna</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ url('/data-pengguna/admin') }}"><span>Admin</span></a>
                                </li>
                                <li><a class="nav-link" href="{{ url('/data-pengguna/dosen') }}"><span>Dosen</span></a>
                                </li>
                                <li><a class="nav-link"
                                        href="{{ url('/data-pengguna/mahasiswa') }}"><span>Mahasiswa</span></a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="ion ion-android-person"></i> <span>Kelola Pengguna</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link"
                                        href="{{ url('/kelola-pengguna/admin') }}"><span>Admin</span></a></li>
                                <li><a class="nav-link"
                                        href="{{ url('/kelola-pengguna/dosen') }}"><span>Dosen</span></a></li>
                                <li><a class="nav-link"
                                        href="{{ url('/kelola-pengguna/mahasiswa') }}"><span>Mahasiswa</span></a></li>
                            </ul>
                        </li>

                        <li class="menu-header">Manajemen Magang</li>
                        <li class="nav-item dropdown active">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i> <span>Magang</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link"
                                        href="{{ url('/admin/mahasiswa/pengajuan-magang') }}">Permintaan Magang</a>
                                </li>
                                <li class="active"><a class="nav-link" href="{{ url('/admin/data-magang') }}">Data
                                        Magang</a> </li>
                            </ul>
                        <li><a class="nav-link" href="{{ url('/admin/data-bimbingan-mahasiswa') }}"><i
                                    class="ion ion-android-list"></i><span>Dosen Pembimbing</span></a></li>
                        </li>

                        <li class="menu-header">Aktivitas Magang</li>
                        <li><a class="nav-link" href="{{ url('/admin/logbook') }}"><i class="ion ion-clipboard"
                                    data-pack="default" data-tags="write"></i> <span>Logbook</span></a></li>
                        <li><a class="nav-link" href="{{ url('/admin/bimbingan') }}"><i class="fas fa-users"></i>
                                <span>Bimbingan</span></a></li>

                        <li class="menu-header">Finalisasi Magang</li>
                        <li><a class="nav-link" href="{{ url('/admin/laporan-magang-mahasiswa') }}"><i
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
                        <h1>Data Magang</h1>
                    </div>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Detail Data Magang Mahasiswa</h4>
                                    </div>

                                    <div class="card-body">
                                        @php
                                            $fields = [
                                                'NIM' => $dataMagang->mahasiswa->nim ?? 'null',
                                                'Instansi' => $dataMagang->pengajuanMagang->instansi_magang ?? 'null',
                                                'Nama' => $dataMagang->mahasiswa->nama ?? 'null',
                                                'Alamat' =>
                                                    $dataMagang->pengajuanMagang->alamat_magang ?? 'null',
                                                'Kelas' => $dataMagang->mahasiswa->kelas ?? 'null',
                                                'Periode' => $dataMagang->periode ?? 'null',
                                                'Jurusan' => $dataMagang->mahasiswa->jurusan ?? 'null',
                                                'Status' => function () use ($dataMagang) {
                                                    if ($dataMagang->status_magang == 'selesai') {
                                                        return '<div class="badge badge-success">Selesai</div>';
                                                    } elseif ($dataMagang->status_magang == 'sedang magang') {
                                                        return '<div class="badge badge-warning">Sedang magang</div>';
                                                    } elseif ($dataMagang->status_magang == 'belum dimulai') {
                                                        return '<div class="badge badge-info">Belum dimulai</div>';
                                                    } else {
                                                        return 'null';
                                                    }
                                                },
                                                'Kategori' => $dataMagang->kategori_magang ?? 'null',
                                                'Mulai' => $dataMagang->tanggal_mulai,
                                                'Bidang' => 'Belum ada data',
                                                'Selesai' => $dataMagang->tanggal_selesai,
                                            ];
                                        @endphp

                                        <div class="row">
                                            @foreach ($fields as $label => $value)
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="d-flex">
                                                        <div class="col-4 col-md-3">
                                                            <p class="fw-bold mb-0" style="font-size: 14px;">
                                                                {{ $label }}
                                                            </p>
                                                        </div>
                                                        <div class="col-1">
                                                            <p class="mb-0" style="font-size: 14px;">:</p>
                                                        </div>
                                                        <div class="col-7 col-md-8">
                                                            @if (is_callable($value))
                                                                {!! $value() !!}
                                                            @else
                                                                <p class="mb-0" style="font-size: 14px;">
                                                                    {{ $value }}
                                                                </p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Preview -->
                                    <div class="card-body">
                                        @php
                                            $fileExtension = pathinfo($dataMagang->files, PATHINFO_EXTENSION);
                                        @endphp

                                        <div class="responsive-embed">
                                            @if ($fileExtension == 'pdf')
                                                <embed class="embed-responsive-item" src="{{ asset('storage/' . $dataMagang->files) }}" type="application/pdf">
                                            @elseif (in_array($fileExtension, ['doc', 'docx']))
                                                <iframe class="embed-responsive-item" src="https://docs.google.com/gview?url={{ asset('storage/' . $dataMagang->files) }}&embedded=true"></iframe>
                                            @else
                                                <p>File format not supported for preview.</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="card-footer d-flex justify-content-end flex-wrap">
                                        <!-- Kembali -->
                                        <a href="{{ url('/admin/data-magang') }}"
                                            class="btn btn-success m-1">Kembali</a>
                                        <!-- Unduh -->
                                        <a type="button" class="btn btn-warning m-1"
                                            href="{{ asset('storage/' . $dataMagang->files) }}" download>
                                            <i class="fas fa-download"></i> Unduh
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>


            <!-- Footer -->
            @include('pages.layouts.footer')

            <!-- Modal data magang -->
            {{-- <div class="modal fade" id="detailModal1" tabindex="-1" role="dialog"
                aria-labelledby="detailModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailModalLabel">Detail Data Magang Mahasiswa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Content di sini via AJAX -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Keluar</button>
                        </div>
                    </div>
                </div>
            </div> --}}

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
    @include('pages.layouts.datatables')

    <!-- JS Libraies -->
    <script src="{{ asset('node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/modules-sweetalert.js') }}"></script>

    <script>
        function openFile(url) {
            // Membuka file pdf dalam tab baru
            window.open(url, '_blank');
        }
    </script>

</body>

</html>
