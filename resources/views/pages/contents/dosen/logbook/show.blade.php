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

                        <li class="menu-header">Aktivitas Magang</li>
                        <li><a class="nav-link" href="/dosen/bimbingan-mahasiswa"><i class="fas fa-users"></i> <span>Bimbingan</span></a></li>
                        <li class="active"><a class="nav-link" href="{{ url('/dosen/logbook-mahasiswa') }}"><i class="ion ion-clipboard" data-pack="default" data-tags="write"></i> <span>Logbook</span></a></li>

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
                        <h1>Log Book Aktivitas Mahasiswa</h1>
                    </div>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 ">
                                <div class="card">
                                    <!-- Head Logbook -->
                                    <div class="logbook-header text-center font-weight-bold mb-5 mt-5">
                                        LOG BOOK AKTIVITAS HARIAN
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered display nowrap" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No</th>
                                                        <th class="text-center">Tanggal</th>
                                                        <th class="text-center">Jam Mulai</th>
                                                        <th class="text-center">Jam Selesai</th>
                                                        <th>Penjelasan Kegiatan</th>
                                                        <th class="text-center">Verifikasi Dosen Pembimbing</th>
                                                        {{-- <th class="text-center">Aksi</th> --}}
                                                    </tr>
                                                </thead>

                                                @php
                                                    $no = 1;
                                                @endphp

                                                <tbody>
                                                    @foreach ($logbook as $lb)
                                                        <tr>

                                                            <td class="text-center">{{ $no++ }}</td>
                                                            <td class="text-center">{{ $lb->tanggal_logbook ?? '-' }}</td>
                                                            <td class="text-center">{{ $lb->jam_mulai ?? '-' }}</td>
                                                            <td class="text-center">{{ $lb->jam_selesai ?? '-' }}</td>
                                                            <td>{{ $lb->kegiatan ?? '-' }}</td>
                                                            <td class="text-center">
                                                                <input type="checkbox" class="verifikasi-checkbox" data-id="{{ $lb->id }}" {{ $lb->verifikasi_dosen == '1' ? 'checked' : '' }}>
                                                                {{-- @if ($lb->verifikasi_dosen == '1')
                                                                <div class="badge badge-success">Sudah diverifikasi</div>
                                                                @else
                                                                <div class="badge badge-secondary">Menunggu verifikasi</div>
                                                                @endif --}}
                                                            </td>
                                                            {{-- <td class="d-flex justify-content-center align-items-center">
                                                                <!-- Update -->
                                                                <a href="{{ url('/dosen/logbook-mahasiswa/edit/' . $lb->id)}}">
                                                                    <button class="btn btn-sm btn-info mx-1 validasi">
                                                                        <i class="far fa-check-circle"></i>
                                                                    </button>
                                                                </a>
                                                            </td> --}}
                                                        </tr>
                                                        @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card-footer d-flex justify-content-end">
                                        <!-- Button back -->
                                        <a href="{{ url('/dosen/logbook-mahasiswa') }}" class="btn btn-warning m-1">Kembali</a>
                                        <!-- Edit -->
                                        <button id="btn-validasi" class="btn btn-success m-1">
                                            <i class="far fa-check-circle"></i> Validasi
                                        </button>
                                    </div>

                                    <!-- Modal Loading -->
                                    <div class="modal fade" id="loadingModal" tabindex="-1" role="dialog"
                                        aria-labelledby="loadingModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body text-center">
                                                    <div class="spinner-border text-primary" role="status">
                                                        <span class="sr-only">Loading...</span>
                                                    </div>
                                                    <p>Sedang memproses...</p>
                                                </div>
                                            </div>
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
    <script src="{{ asset('node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script>
        var redirectUrl = "{{ url('/dosen/logbook-mahasiswa') }}";
    </script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/modules-sweetalert.js') }}"></script>

    <!-- Fungsi validasi menggunakan ajax -->
    <script>
        $(document).ready(function() {
            $('#btn-validasi').click(function() {
                var selectedIds = [];
                $('.verifikasi-checkbox:checked').each(function() {
                    selectedIds.push($(this).data('id'));
                });

                if (selectedIds.length > 0) {
                    // Tampilkan modal loading
                    $('#loadingModal').modal('show');

                    $.ajax({
                        url: '{{ url('/dosen/logbook-mahasiswa/validasi') }}',
                        method: 'POST',
                        data: {
                            ids: selectedIds,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                location.reload();
                            } else {
                                alert('Validasi gagal.');
                            }
                        },
                        complete: function() {
                            // Sembunyikan modal loading
                            $('#loadingModal').modal('hide');
                        }
                    });
                } else {
                    alert('Pilih setidaknya satu bimbingan untuk divalidasi.');
                }
            });
        });
    </script>
</body>

</html>
