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
                        <li class="active"><a class="nav-link" href="{{ url('/mahasiswa/dashboard') }}"><i
                                    class="ion ion-speedometer" data-pack="default"
                                    data-tags="travel, accelerate"></i><span>Dashboard</span></a></li>

                        <li class="menu-header">Magang</li>
                        <li><a class="nav-link" href="{{ url('/mahasiswa/pengajuan-magang') }}"><i
                                    class="ion ion-archive" data-pack="default" data-tags="mail"></i> <span>Pengajuan
                                    Magang</span></a></li>
                        <li><a class="nav-link" href="{{ url('/mahasiswa/data-magang') }}"><i
                                    class="fas fa-columns"></i> <span>Data Magang</span></a></li>

                        <li class="menu-header">Aktivitas Magang</li>
                        <li><a class="nav-link" href="{{ url('/mahasiswa/bimbingan') }}"><i class="fas fa-users"></i>
                                <span>Bimbingan</span></a> </li>
                        <li><a class="nav-link" href="{{ url('/mahasiswa/logbook') }}"><i class="ion ion-clipboard"
                                    data-pack="default" data-tags="write"></i> <span>Logbook</span></a></li>

                        <li class="menu-header">Finalisasi Magang</li>
                        <li><a class="nav-link" href="{{ url('/mahasiswa/laporan-magang') }}"><i
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
                        <div class="col-12 col-md col-lg">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Berita Terkini</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-md">
                                            <tr>
                                                <th>No</th>
                                                <th>Judul</th>
                                                <th>Tanggal</th>
                                                <th>Penulis</th>
                                                <th>Action</th>
                                            </tr>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($pengumuman as $p)
                                                <tr>
                                                    <td scope="row">{{ $no++ }}</td>
                                                    <td>{{ $p->judul }}</td>
                                                    <td>{{ $p->created_at }}</td>
                                                    <td>{{ $p->created_by }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-info mx-1 modal-2"
                                                            data-id="{{ $p->id }}" data-toggle="modal"
                                                            data-target="#detailModal">
                                                            <i class="ion ion-ios-eye"></i>
                                                            Detail
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <!-- Footer -->
        @include('pages.layouts.footer')

    </div>

    <!-- Modal pengumuman -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Berita Terkini</h5>
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
    </div>

    <!-- General JS Scripts-->
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

    <!-- JS Libraries -->
    <script src="{{ asset('node_modules/jquery-ui-dist/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('node_modules/prismjs/prism.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/components-table.js') }}"></script>
    <script src="{{ asset('assets/js/page/bootstrap-modal.js') }}"></script>
</body>

</html>
