<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a class="nav-link" data-bs-toggle="collapse" href="#profile-menu" aria-expanded="false"
                aria-controls="profile-menu">
                <div class="nav-profile-image">
                    @if (Auth::check())
                        <img src="{{ Storage::disk('public')->exists('avatars/' . Auth::user()->id . '.png') ? asset('storage/avatars/' . Auth::user()->id . '.png') : asset('storage/avatars/default.png') }}"
                            alt="profile">
                    @else
                        <img src="{{ asset('storage/avatars/default.png') }}" alt="profile">
                    @endif
                    {{-- <span class="login-status online"></span> --}}
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold[]">
                        {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                    </span>
                </div>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="profile-menu">
                <ul class="nav flex-column sub-menu">
                    @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link {{ request()->path() == 'u/' . Auth::user()->id ? 'active' : '' }}"
                                href="/u/{{ Auth::user()->id }}">My Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->path() == 'u/edit/' . Auth::user()->id ? 'active' : '' }}"
                                href="/u/edit/{{ Auth::user()->id }}">Edit Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->path() == 'u/invites/' . Auth::user()->id ? 'active' : '' }}"
                                href="/u/invites/{{ Auth::user()->id }}">Invite Codes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Sign Out</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Sign In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/">
                <span class="menu-title">Home</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ranking-menu" aria-expanded="false"
                aria-controls="ranking-menu">
                <span class="menu-title">Rankings</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-chart-bar menu-icon"></i>
            </a>
            <div class="collapse" id="ranking-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="/leaderboard?mode=0&rx=8&sort=pp">Performance</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="#">Score</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Countries</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Clans</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#information-menu" aria-expanded="false"
                aria-controls="information-menu">
                <span class="menu-title">Informations</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-contacts menu-icon"></i>
            </a>
            <div class="collapse" id="information-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#">Soon!</a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
