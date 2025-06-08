<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        osu!win21 - 
        {{ $sort == 'pp' ? 'Performance(PP) Ranking' : ($sort == 'rscore' ? 'Ranked Score Leaderboard' : 'Leaderboard') }}
    </title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/user/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/vendors/css/vendor.bundle.base.css') }}">

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}">

    <link rel="shortcut icon"
        href="https://cdn.discordapp.com/emojis/1199139517198770206.png?size=48&quality=lossless" />
</head>

<body>
    @include('user.layouts.alerts')
    <div class="container-fluid p-0">
        @include('user.layouts.navbar')
        <div class=" page-body-wrapper">
            @include('user.layouts.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="mdi mdi-account"></i>
                            </span>
                            @if ($sort == 'pp')
                                Performance(PP) Ranking
                            @elseif ($sort == 'rscore')
                                Ranked Score Leaderboard
                            @else
                                Leaderboard
                            @endif
                        </h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body table-responsive">
                                    <div class="d-flex">
                                        <h4 class="card-title">
                                            @if ($sort == 'pp')
                                                Performance Ranking
                                            @elseif ($sort == 'rscore')
                                                Score Ranking
                                            @else
                                                Leaderboard
                                            @endif
                                        </h4>
                                        @include('user.layouts.mode-selector')
                                    </div>
                                    <table class="table table-hover mt-3">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center">#</th>
                                                <th scope="col">Player</th>
                                                <th scope="col">Accuracy</th>
                                                <th scope="col">Play Count</th>
                                                <th scope="col">Ranked Score</th>
                                                <th scope="col">Performance</th>
                                                <th scope="col">SS</th>
                                                <th scope="col">S</th>
                                                <th scope="col">A</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($leaderboard as $item)
                                                <tr>
                                                    {{-- @dd($item) --}}
                                                    <th scope="row" class="text-center">{{ $item['rank'] }}</th>
                                                    <td>
                                                        @if (isset($item['flag_url']))
                                                            <img class="me-1" src="{{ $item['flag_url'] }}"
                                                                alt="{{ $item['country'] }}" width="24"
                                                                height="18" style="vertical-align: middle;">
                                                        @else
                                                            {{ $item['country'] }}
                                                        @endif
                                                        <a href="u/{{ $item['player_id'] }}?mode={{ $mode }}&rx={{ $rx }}"
                                                            class="link link-primary text-decoration-none">{{ $item['name'] }}</a>
                                                    </td>
                                                    <td>{{ number_format($item['acc'], 3) }}%</td>
                                                    <td>{{ number_format($item['plays']) }}</td>
                                                    <td>{{ number_format($item['rscore']) }}</td>
                                                    <td>
                                                        <span
                                                            class="badge bg-gradient-primary">{{ number_format($item['pp']) }}
                                                            pp</span>
                                                    </td>
                                                    <td>{{ $item['xh_count'] + $item['x_count'] }}</td>
                                                    <td>{{ $item['sh_count'] + $item['s_count'] }}</td>
                                                    <td>{{ $item['a_count'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('user.layouts.footer')
    </div>


    {{-- Data Fetch --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('assets/user/js/data-fetch.js') }}"></script>

    <!-- plugins:js -->
    <script src="{{ asset('assets/user/vendors/js/vendor.bundle.base.js') }}"></script>

    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/user/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/jquery.cookie.js') }}" type="text/javascript"></script>

    <!-- inject:js -->
    <script src="{{ asset('assets/user/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/user/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/user/js/misc.js') }}"></script>

    <!-- Custom js for this page -->
    <script src="{{ asset('assets/user/js/chart.js') }}"></script>
    <script src="{{ asset('assets/user/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/user/js/todolist.js') }}"></script>
    <script src="{{ asset('assets/user/js/error.js') }}"></script>
</body>

</html>
