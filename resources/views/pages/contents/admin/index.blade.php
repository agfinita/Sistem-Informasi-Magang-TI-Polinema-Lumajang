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
                        <a href="{{ url('/') }}">{{ Auth::user()->role }}</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{ url('/') }}">SIMAG</a>
                    </div>
                    <!-- Menu Sidebar-->
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="active"><a class="nav-link" href="{{ url('/') }}"><i class="ion ion-speedometer"
                                    data-pack="default" data-tags="travel, accelerate"></i> <span>Dashboard</span></a>
                        </li>
                        <li><a class="nav-link" href="{{ url('/pengumuman') }}"><i class="ion ion-speakerphone"></i>
                                <span>Pengumuman</span></a></li>


                        <li class="menu-header">Manajemen Pengguna</li>
                        <li class="nav-item-dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                                <i class="ion ion-ios-paper"></i><span>Data Pengguna</span>
                            </a>
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
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i> <span>Magang</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link"
                                        href="{{ url('/admin/mahasiswa/pengajuan-magang') }}">Permintaan Magang</a>
                                </li>
                                <li><a class="nav-link" href="{{ url('/admin/data-magang') }}">Data Magang</a></li>
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
                        <h1>Dashboard</h1>
                    </div>
                    <div class="row">
                        <!-- Total seluruh pengguna -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="ion ion-android-people"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Pengguna</h4>
                                    </div>
                                    <div class="card-body"> {{ $totalUser }} </div>
                                </div>
                            </div>
                        </div>
                        <!-- Berita or Pengumuman -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-danger">
                                    <i class="far fa-newspaper"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Pengumuman</h4>
                                    </div>
                                    <div class="card-body"> {{ $totalPengumuman }} </div>
                                </div>
                            </div>
                        </div>
                        <!-- Online user -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-circle"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Online Users</h4>
                                    </div>
                                    <div class="card-body">{{ $activeUsers }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistik -->
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Kategori Pengguna</h4>
                                </div>
                                <div class="card-body">
                                    <canvas id="myChart2"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Status Pengajuan Magang</h4>
                                </div>
                                <div class="card-body">
                                    <canvas id="myChart4"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Statistik bimbingan -->
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Statistik Bimbingan</h4>
                                </div>
                                <div class="card-body">
                                    <canvas id="pieChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- Statistik mahasiswa magang -->
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Statistik Mahasiswa Magang</h4>
                                </div>
                                <div class="card-body">
                                    <canvas id="myDoughnutChart"></canvas>
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
    <!-- Chart JS -->
    <script>
        "use strict";

        // Bar chart for Kategori Pengguna
        var ctx = document.getElementById("myChart2").getContext('2d');
        var myChart2 = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Admin", "Dosen", "Mahasiswa"],
                datasets: [{
                    label: 'Statistics',
                    data: [{{ $totalAdmin }}, {{ $totalDosen }}, {{ $totalMhs }}],
                    borderWidth: 2,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)', // Dark Blue for Admin
                        'rgba(54, 162, 235, 0.2)', // Light Blue for Dosen
                        'rgba(255, 206, 86, 0.2)' // Mint Green for Mahasiswa
                    ],
                    // borderColor: 'rgba(44, 62, 80, 1)', // Dark Blue for border
                    // borderWidth: 2.5,
                    // pointBackgroundColor: '#ffffff',
                    // pointRadius: 4
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

        // Pie chart for Status Pengajuan Magang
        var ctx4 = document.getElementById("myChart4").getContext('2d');
        var myChart4 = new Chart(ctx4, {
            type: 'pie',
            data: {
                datasets: [{
                    data: [
                        {{ $selesai }},
                        {{ $diproses }},
                    ],
                    backgroundColor: [
                        'rgba(52, 152, 219, 0.4)', // Light Blue for Selesai
                        'rgba(231, 76, 60, 0.4)' // Red for Diproses
                    ],
                    label: 'Dataset 1'
                }],
                labels: [
                    'Selesai',
                    'Diproses',
                ],
                borderColor: 'rgba(44, 62, 80, 1)', // Dark Blue for border
                borderWidth: 1
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                },
            }
        });

        // Pie chart for Statistik Bimbingan
        var ctxPie = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Sudah Bimbingan', 'Belum Bimbingan'],
                datasets: [{
                    data: [
                        {{ $sdhBimbingan }},
                        {{ $blmBimbingan }},
                    ],
                    backgroundColor: [
                        'rgba(52, 152, 219, 0.4)', // Light Blue for Sudah Bimbingan
                        'rgba(149, 165, 166, 0.4)' // Gray for Belum Bimbingan
                    ],
                    borderColor: [
                        'rgba(44, 62, 80, 1)', // Dark Blue for border
                        'rgba(44, 62, 80, 1)' // Dark Blue for border
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                }
            }
        });

        // Doughnut chart for Internship Status
        var ctxDoughnut = document.getElementById('myDoughnutChart').getContext('2d');
        var myDoughnutChart = new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: ['Belum Magang', 'Belum Mulai', 'Sedang Magang', 'Magang Selesai'],
                datasets: [{
                    label: 'Jumlah Mahasiswa',
                    data: [{{ $blmMagang }}, {{ $blmMulai }}, {{ $sedangMagang }},
                        {{ $selesaiMagang }}
                    ],
                    backgroundColor: [
                        'rgba(231, 76, 60, 0.4)', // Red for Belum Magang
                        'rgba(44, 62, 80, 0.4)', // Dark Blue for Belum Mulai
                        'rgba(46, 204, 113, 0.4)', // Mint Green for Sedang Magang
                        'rgba(52, 152, 219, 0.4)' // Light Blue for Magang Selesai
                    ],
                    borderColor: 'rgba(44, 62, 80, 1)', // Dark Blue for border
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                }
            }
        });
    </script>
</body>

</html>
