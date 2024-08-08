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
                        <li class="active"><a class="nav-link" href="{{ url('/dosen/dashboard') }}"><i
                                    class="ion ion-speedometer" data-pack="default" data-tags="travel, accelerate"></i>
                                <span>Dashboard</span></a></li>
                        <li><a class="nav-link" href="{{ url('/dosen/pengumuman') }}"><i
                                    class="ion ion-speakerphone"></i><span>Pengumuman</span></a></li>

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
                        <li><a class="nav-link" href="{{ url('/dosen/laporan-magang-mahasiswa') }}"><i
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
                        <h1>Dashboard</h1>
                    </div>
                    <div class="row">
                        <!-- Total data bimbingan -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Jumlah Mahasiswa Bimbingan</h4>
                                    </div>
                                    <div class="card-body"> {{ $totalBimbingan }} </div>
                                </div>
                            </div>
                        </div>
                        <!-- Total data magang selesai -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="ion ion-android-people"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Jumlah Mahasiswa Selesai Magang</h4>
                                    </div>
                                    <div class="card-body"> {{ $totalSelesai }} </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Logbook aktivitas terakhir -->
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                                    <h4 class="mb-2 mb-md-0">Aktivitas Logbook Terbaru</h4>

                                    <!-- Dropdown untuk memilih jumlah entri yang ditampilkan -->
                                    <form method="GET" action="{{ url('/dosen/dashboard') }}"
                                        class="mb-0 d-flex align-items-center">
                                        <div class="form-group mb-0 d-flex align-items-center">
                                            <label for="per_page" class="mb-0 mr-2">Tampilkan:</label>
                                            <select name="per_page" id="per_page"
                                                class="custom-select custom-select-sm" onchange="this.form.submit()">
                                                <option value="3"
                                                    {{ request('per_page') == 3 ? 'selected' : '' }}>3</option>
                                                <option value="5"
                                                    {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                                                <option value="10"
                                                    {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15"
                                                    {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>

                                <div class="card-body">
                                    @if ($logbooks->isEmpty())
                                        <p>Tidak ada aktivitas logbook terbaru.</p>
                                    @else
                                        <ul class="list-group">
                                            @foreach ($logbooks as $lb)
                                                <li class="list-group-item">
                                                    <strong
                                                        class="text-danger">{{ $lb->dataMagang->mahasiswa->nama }}</strong>
                                                    <br>{{ $lb->kegiatan }}<br>
                                                    <small>{{ $lb->created_at->diffForHumans() }}</small>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Chart untuk Statistik Permintaan -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-2 mb-md-0">Statistik Permintaan Validasi</h4>
                                </div>
                                <div class="card-body">
                                    <canvas id="chartStatistics"></canvas>
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
    <script src="{{ asset('node_modules/chart.js/dist/Chart.min.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/index-0.js') }}"></script>

    <!-- Chart -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('chartStatistics').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar', // Jenis chart
                data: {
                    labels: ['Logbook', 'Bimbingan', 'Laporan Magang'],
                    datasets: [{
                        // label: 'Permintaan Validasi', // Menghilangkan label
                        data: [
                            @json($validasiLogbook), // Data untuk validasi logbook
                            @json($validasiBimbingan), // Data untuk validasi bimbingan
                            @json($validasiLapMagang), // Data untuk validasi laporan magang (tambahkan jika ada)
                        ],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)', // Warna untuk Logbook
                            'rgba(54, 162, 235, 0.2)', // Warna untuk Bimbingan
                            'rgba(255, 206, 86, 0.2)' // Warna untuk Laporan Magang
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)', // Warna border untuk Logbook
                            'rgba(54, 162, 235, 1)', // Warna border untuk Bimbingan
                            'rgba(255, 206, 86, 1)' // Warna border untuk Laporan Magang
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    legend: {
                        display: false // Menghilangkan keseluruhan legenda
                    }
                }
            });
        });
    </script>

</body>

</html>
