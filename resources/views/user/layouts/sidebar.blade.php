<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a class="nav-link" data-bs-toggle="collapse" href="#profile-menu" aria-expanded="false"
                aria-controls="profile-menu">
                <div class="nav-profile-image">
                    <img src="https://cdn.discordapp.com/emojis/1199139517198770206.png?size=48&quality=lossless"
                        alt="profile">
                    <span class="login-status online"></span>
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">
                        {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                    </span>
                    <span class="text-secondary text-small">
                        {{ Auth::check() ? 'Developer' : 'Please Login' }}
                    </span>
                </div>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="profile-menu">
                <ul class="nav flex-column sub-menu">
                    @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link" href="/u/{{ Auth::user()->id }}">My Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/logout">Logout</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Login</a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">
                <span class="menu-title">Home</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ranking-menu" aria-expanded="false"
                aria-controls="ranking-menu">
                <span class="menu-title">Rankings</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
            <div class="collapse" id="ranking-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#">Global</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Country</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Soon!</a></li>
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
