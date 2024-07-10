<!-- Navbar -->
<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>

        <!-- Tanggal waktu terkini-->
        <div id="currentDateTime" style="color: white"></div>
    </form>

    <ul class="navbar-nav navbar-right">
        <!-- Notification -->
        {{-- <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle {{ Auth::check() && Auth::user()->notifications->where('read', false)->count() > 0 ? 'beep' : '' }}">
                <i class="far fa-envelope"></i>
                @if(Auth::check() && Auth::user()->notifications->where('read', false)->count() > 0)
                    <span class="badge badge-danger">{{ Auth::user()->notifications->where('read', false)->count() }}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Pesan
                    <div class="float-right">
                        <a href="{{ route('notifications.markAllAsRead') }}">Tandai semua telah dibaca</a>
                    </div>
                </div>
                <div class="dropdown-list-content">
                    @foreach(Auth::user()->notifications->where('read', false) as $notification)
                        <a href="#" class="dropdown-item">
                            <span class="dropdown-item-desc">
                                {{ $notification->message }}
                                <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </li> --}}

        <li class="dropdown">
            <!-- User  avatar -->
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->nama }} </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <!-- Waktu login user -->
                <div class="dropdown-title">Logged in {{ $timeAgo }}</div>

                <!-- Profile -->
                {{-- <a href="features-profile.html" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a> --}}

                <!-- Form logout -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item has-icon text-danger" href="#"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>

                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>

<script>
    function displayCurrentDateTime() {
        const now = new Date();
        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
            'Oktober', 'November', 'Desember'
        ];

        const dayName = days[now.getDay()];
        const day = String(now.getDate()).padStart(2, '0');
        const month = months[now.getMonth()];
        const year = now.getFullYear();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        const formattedDateTime = `${dayName}, ${day} ${month} ${year} ${hours}:${minutes}:${seconds}`;

        document.getElementById('currentDateTime').innerText = formattedDateTime;
    }

    // Update the date and time every second
    setInterval(displayCurrentDateTime, 1000);

    // Display the date and time immediately on page load
    displayCurrentDateTime();
</script>
