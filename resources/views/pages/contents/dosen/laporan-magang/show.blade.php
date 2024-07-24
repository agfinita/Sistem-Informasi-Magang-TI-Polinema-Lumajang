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
<<<<<<< HEAD
                        <li><a class="nav-link" href="{{ url('/dosen/dashboard') }}"><i class="ion ion-speedometer"
                                    data-pack="default" data-tags="travel, accelerate"></i> <span>Dashboard</span></a>
                        </li>

                        <li class="menu-header">Magang</li>
                        <li><a class="nav-link" href="{{ url('/dosen/data-magang-mahasiswa') }}"><i
                                    class="fas fa-columns"></i> <span>Data Magang</span></a></li>

                        <li class="menu-header">Aktivitas Magang</li>
                        <li><a class="nav-link" href="/dosen/bimbingan-mahasiswa"><i class="fas fa-users"></i>
                                <span>Bimbingan</span></a></li>
                        <li><a class="nav-link" href="{{ url('/dosen/logbook-mahasiswa') }}"><i
                                    class="ion ion-clipboard" data-pack="default" data-tags="write"></i>
                                <span>Logbook</span></a></li>

                        <li class="menu-header">Verifikasi</li>
                        <li class="active"><a class="nav-link" href="{{ url('/dosen/laporan-magang-mahasiswa') }}"><i
                                    class="ion ion-ios-book"></i> <span>Laporan Magang</span></a> </li>
=======
                        <li><a class="nav-link" href="{{ url('/dosen/dashboard') }}"><i class="ion ion-speedometer" data-pack="default" data-tags="travel, accelerate"></i> <span>Dashboard</span></a></li>

                        <li class="menu-header">Magang</li>
                        <li><a class="nav-link" href="{{ url('/dosen/data-magang-mahasiswa') }}"><i class="fas fa-columns"></i> <span>Data Magang</span></a></li>

                        <li class="menu-header">Aktivitas Magang</li>
                        <li><a class="nav-link" href="/dosen/bimbingan-mahasiswa"><i class="fas fa-users"></i> <span>Bimbingan</span></a></li>
                        <li><a class="nav-link" href="{{ url('/dosen/logbook-mahasiswa') }}"><i class="ion ion-clipboard" data-pack="default" data-tags="write"></i> <span>Logbook</span></a></li>

                        <li class="menu-header">Verifikasi</li>
                        <li class="active"><a class="nav-link" href="{{ url('/dosen/laporan-magang-mahasiswa') }}"><i class="ion ion-ios-book"></i> <span>Laporan Magang</span></a> </li>
>>>>>>> aa5b2ed910f2b86847c223282a14084c7e45b1ca

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
                                        <h4>Detail Laporan Magang Mahasiswa</h4>
                                    </div>

                                    <div class="card-body">
                                        @php
                                            $fields = [
<<<<<<< HEAD
                                                'NIM' => $laporanMagang->mahasiswa->nim ?? 'null',
                                                'Kategori' => $laporanMagang->dataMagang->kategori_magang ?? 'null',

                                                'Nama' => $laporanMagang->mahasiswa->nama ?? 'null',
                                                'Instansi' =>
                                                    $laporanMagang->pengajuanMagang->instansi_magang ?? 'null',

                                                'Kelas' => $laporanMagang->mahasiswa->kelas ?? 'null',
                                                'Dosen Pembimbing' => $laporanMagang->dataBimbingan->dosen->nama ?? 'null',
=======
                                                'Nama' => $laporanMagang->mahasiswa->nama ?? 'null',
                                                'Kelas' => $laporanMagang->mahasiswa->kelas ?? 'null',
                                                'NIM' => $laporanMagang->mahasiswa->nim ?? 'null',
>>>>>>> aa5b2ed910f2b86847c223282a14084c7e45b1ca
                                            ];
                                        @endphp

                                        <div class="row">
                                            @foreach ($fields as $label => $value)
                                                <div class="col-6 mb-1">
                                                    <div class="row">
                                                        <div class="col-4 col-md-3">
                                                            <p class="fw-bold mb-0" style="font-size: 14px;">
                                                                {{ $label }}</p>
                                                        </div>
                                                        <div class="col-1">
                                                            <p class="mb-0" style="font-size: 14px;">:</p>
                                                        </div>
                                                        <div class="col-7 col-md-8">
                                                            @if (is_callable($value))
                                                                {!! $value() !!}
                                                            @else
                                                                <p class="mb-0" style="font-size: 14px;">
                                                                    {{ $value }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($loop->iteration % 2 == 0)
                                        </div>
                                        <div class="row">
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>


                                    <!-- Preview -->
                                    <div class="card-body">
                                        @php
<<<<<<< HEAD
                                            $fileExtension = pathinfo(
                                                $laporanMagang->laporan_magang,
                                                PATHINFO_EXTENSION,
                                            );
                                        @endphp

                                        <div class="embed-responsive embed-responsive-16by9">
                                            @if ($laporanMagang->laporan_magang)
                                                @php
                                                    $fileExtension = pathinfo(
                                                        $laporanMagang->laporan_magang,
                                                        PATHINFO_EXTENSION,
                                                    );
                                                @endphp

                                                @if ($fileExtension == 'pdf')
                                                    <embed class="embed-responsive-item"
                                                        src="{{ asset('storage/uploads/laporan-magang/' . $laporanMagang->laporan_magang) }}"
                                                        type="application/pdf">
                                                @elseif (in_array($fileExtension, ['doc', 'docx']))
                                                    <iframe class="embed-responsive-item"
                                                        src="https://docs.google.com/gview?url={{ asset('storage/uploads/laporan-magang/' . $laporanMagang->laporan_magang) }}&embedded=true"></iframe>
                                                @else
                                                    <p class="text-center">File format tidak didukung untuk pratinjau.</p>
                                                @endif
                                            @else
                                                <p class="text-center">Belum ada file yang diunggah.</p>
                                            @endif
                                        </div>

=======
                                            $fileExtension = pathinfo($laporanMagang->laporan_magang, PATHINFO_EXTENSION);
                                        @endphp

                                        <div class="embed-responsive embed-responsive-16by9">
                                            @if ($fileExtension == 'pdf')
                                                <embed class="embed-responsive-item"
                                                    src="{{ asset('storage/' . $laporanMagang->laporan_magang) }}"
                                                    type="application/pdf">
                                            @elseif (in_array($fileExtension, ['doc', 'docx']))
                                                <iframe class="embed-responsive-item"
                                                    src="https://docs.google.com/gview?url={{ asset('storage/' . $laporanMagang->laporan_magang) }}&embedded=true"></iframe>
                                            @else
                                                <p>File format not supported for preview.</p>
                                            @endif
                                        </div>
>>>>>>> aa5b2ed910f2b86847c223282a14084c7e45b1ca
                                    </div>

                                    <div class="card-footer d-flex justify-content-end flex-wrap">
                                        <!-- Kembali -->
<<<<<<< HEAD
                                        <a href="{{ url('/dosen/laporan-magang-mahasiswa') }}"
                                            class="btn btn-success m-1">Kembali</a>
                                        <!-- Edit -->
                                        <a
                                            href="{{ url('/dosen/laporan-magang-mahasiswa/edit/' . $laporanMagang->id) }}">
                                            <button class="btn btn-warning m-1">
                                                <i class="ion ion-edit" data-pack="default"
                                                    data-tags="change, update, write, type, pencil"></i> Edit
                                            </button>
                                        </a>
=======
                                        <a href="{{ url('dosen/laporan-magang-mahasiswa') }}"
                                            class="btn btn-success m-1">Kembali</a>
                                        <!-- Unduh -->
                                        <a type="button" class="btn btn-warning m-1"
                                            href="{{ asset('storage/' . $laporanMagang->laporan_magang) }}" download><i
                                                class="fas fa-download"></i> Unduh</a>
>>>>>>> aa5b2ed910f2b86847c223282a14084c7e45b1ca
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Footer -->
            @include('pages.layouts.footer')

<<<<<<< HEAD
=======
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

>>>>>>> aa5b2ed910f2b86847c223282a14084c7e45b1ca
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
