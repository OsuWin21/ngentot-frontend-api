<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>osu!win21 - {{ $user->name }}'s Profile</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/user/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon"
        href="https://cdn.discordapp.com/emojis/1199139517198770206.png?size=48&quality=lossless" />
</head>

<body>
    @include('user.layouts.alerts')
    <div class="container-fluid p-0">
        @include('user.layouts.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('user.layouts.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="mdi mdi-account"></i>
                            </span>{{ $user->name }}'s Profile
                        </h3>
                    </div>
                    @php
                        $perPage = 10;
                    @endphp
                    <div class="row">
                        @include('user.components.profile-card')
                    </div>
                    <div class="row">
                        @include('user.components.first-places')
                    </div>
                    <div class="row">
                        @include('user.components.top-plays')
                    </div>
                    <div class="row">
                        @include('user.components.recent-plays')
                    </div>
                </div>
            </div>
        </div>
        @include('user.layouts.footer')
    </div>

    {{-- Chart Data --}}
    {{-- <script>
        var areaData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
                'November', 'December'
            ],
            datasets: [{
                label: 'Users',
                data: {!! json_encode($reg_data) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                fill: true, // 3: no fill
            }]
        };
        var areaData2 = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
                'November', 'December'
            ],
            datasets: [{
                label: 'Users',
                data: {!! json_encode($login_data) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                fill: true, // 3: no fill
            }]
        };
    </script> --}}

    {{-- Data Fetch --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('assets/user/js/data-fetch.js') }}"></script>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/user/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/user/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/user/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/user/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/user/js/misc.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('assets/user/js/chart.js') }}"></script>
    <script src="{{ asset('assets/user/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/user/js/todolist.js') }}"></script>
    <script src="{{ asset('assets/user/js/error.js') }}"></script>
    <!-- End custom js for this page -->

    <script src="{{ asset('assets/user/js/player-status.js') }}"></script>

    <script>
        // Configuration and Constants
        const tableConfig = {
            perPage: 10,
            gradeImages: {
                XH: 'https://raw.githubusercontent.com/ppy/osu-web/aee49df28def2cd5b467bb5c597a0cbf16b59d4c/public/images/badges/score-ranks-v2019/GradeSmall-SS-Silver.svg',
                X: 'https://raw.githubusercontent.com/ppy/osu-web/aee49df28def2cd5b467bb5c597a0cbf16b59d4c/public/images/badges/score-ranks-v2019/GradeSmall-SS.svg',
                SH: 'https://raw.githubusercontent.com/ppy/osu-web/aee49df28def2cd5b467bb5c597a0cbf16b59d4c/public/images/badges/score-ranks-v2019/GradeSmall-S-Silver.svg',
                S: 'https://raw.githubusercontent.com/ppy/osu-web/aee49df28def2cd5b467bb5c597a0cbf16b59d4c/public/images/badges/score-ranks-v2019/GradeSmall-S.svg',
                A: 'https://raw.githubusercontent.com/ppy/osu-web/aee49df28def2cd5b467bb5c597a0cbf16b59d4c/public/images/badges/score-ranks-v2019/GradeSmall-A.svg',
                B: 'https://raw.githubusercontent.com/ppy/osu-web/aee49df28def2cd5b467bb5c597a0cbf16b59d4c/public/images/badges/score-ranks-v2019/GradeSmall-B.svg',
                C: 'https://raw.githubusercontent.com/ppy/osu-web/aee49df28def2cd5b467bb5c597a0cbf16b59d4c/public/images/badges/score-ranks-v2019/GradeSmall-C.svg',
                D: 'https://raw.githubusercontent.com/ppy/osu-web/aee49df28def2cd5b467bb5c597a0cbf16b59d4c/public/images/badges/score-ranks-v2019/GradeSmall-D.svg',
                F: 'https://raw.githubusercontent.com/ppy/osu-web/aee49df28def2cd5b467bb5c597a0cbf16b59d4c/public/images/badges/score-ranks-v2019/GradeSmall-F.svg',
            },
            modsImages: {
                'No Fail': 'mod_no-fail.png',
                'Easy': 'mod_easy.png',
                'TouchDevice': 'mod_touchdevice.png',
                'Hidden': 'mod_hidden.png',
                'HardRock': 'mod_hard-rock.png',
                'SuddenDeath': 'mod_sudden-death.png',
                'DoubleTime': 'mod_double-time.png',
                'Relax': 'mod_relax.png',
                'HalfTime': 'mod_half.png',
                'Nightcore': 'mod_nightcore.png',
                'Flashlight': 'mod_flashlight.png',
                'Autoplay': 'mod_auto.png',
                'SpunOut': 'mod_spun-out.png',
                'Autopilot': 'mod_autopilot.png',
                'Perfect': 'mod_perfect.png',
                'Key4': 'mod_4Kb.png',
                'Key5': 'mod_5Kb.png',
                'Key6': 'mod_6Kb.png',
                'Key7': 'mod_7Kb.png',
                'Key8': 'mod_8Kb.png',
                'Fade In': 'mod_fader.png',
                'Random': 'mod_random.png',
                'Cinema': 'mod_cinema.png',
                'Target': 'mod_target.png',
                'Key9': 'mod_9Kb.png',
                'KeyCoop': 'mod_coop.png',
                'Key1': 'mod_1Kb.png',
                'Key3': 'mod_3Kb.png',
                'Key2': 'mod_2Kb.png',
                'ScoreV2': 'mod_v2.png',
            },
            modsBaseUrl: 'https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/'
        };

        // Initialize data from Blade templates
        const topPlaysData = @json($top_plays);
        const recentPlaysData = @json($recent_plays);
        // For first places, adapt to the new field names
        const firstPlacesData = @json($first_places).map(item => ({
            ...item,
            beatmap: {
                id: item.map_id,
                title: item.map_title,
                status: item.map_status,
                artist: item.map_artist,
                version: item.map_version
            }
        }));

        // Utility Functions
        function limitString(str, len) {
            return str && str.length > len ? str.substring(0, len - 3) + '...' : str || '';
        }

        function timeAgo(dateString) {
            if (!dateString) return '';
            const date = new Date(dateString);
            const now = new Date();
            const diff = Math.floor((now - date) / 1000);

            if (diff < 60) return `${diff}s ago`;
            if (diff < 3600) return `${Math.floor(diff/60)}m ago`;
            if (diff < 86400) return `${Math.floor(diff/3600)}h ago`;
            return `${Math.floor(diff/86400)}d ago`;
        }

        // Table Rendering Functions
        function createTableRow(item, tableType) {
            const gradeImg = tableConfig.gradeImages[item.grade] ?
                `<img src="${tableConfig.gradeImages[item.grade]}" alt="grade" height="24" />` : '';

            const beatmapTitle = limitString(item.beatmap?.title, 40);
            const beatmapArtist = limitString(item.beatmap?.artist, 20);
            const beatmapLink = `
        <a class="text-decoration-none link-primary" href="https://osu.ppy.sh/b/${item.beatmap?.id}" target="_blank">
            ${beatmapTitle} by ${beatmapArtist}
        </a><br>
        ${item.beatmap?.version || ''} - <small class="text-body-secondary">${timeAgo(item.play_time)}</small>
    `;

            // Mods
            let mods = '';
            if (Array.isArray(item.mods_list)) {
                mods = item.mods_list
                    .filter(mod => mod !== 'None')
                    .map(mod => tableConfig.modsImages[mod] ?
                        `<img src="${tableConfig.modsBaseUrl}${tableConfig.modsImages[mod]}" alt="${mod}" height="20" class="me-1" />` :
                        '')
                    .join('');
            }

            // Accuracy
            const acc = item.acc ? `${parseFloat(item.acc).toFixed(3)}%` : '-';

            // PP or Heart icon (different for each table type)
            let ppCellContent, ppCellClass = 'text-center';

            if (tableType === 'best') {
                ppCellContent = item.pp ? `${parseInt(item.pp)}pp` : '-';
            } else if (tableType === 'recent' || tableType === 'first') {
                // Untuk recent dan first, cek status map
                if (item.beatmap?.status == 2) {
                    ppCellContent = item.pp ? `${parseInt(item.pp)}pp` : '-';
                    ppCellClass = 'text-center';
                } else {
                    ppCellContent = '<i class="mdi mdi-heart text-danger"></i>';
                    ppCellClass = 'text-center fs-4';
                }
            } else {
                ppCellContent = item.pp ? `${parseInt(item.pp)}pp` : '-';
            }

            return `
    <tr>
        <td style="width: 5%; text-align: center;">${gradeImg}</td>
        <td style="width: 50%; max-width: 300px">${beatmapLink}</td>
        <td style="width: 15%" class="text-end pe-5">${mods}</td>
        <td style="width: 5%">${acc}</td>
        <td style="width: 5%" class="${ppCellClass}">${ppCellContent}</td>
    </tr>
    `;
        }

        function renderTable(tableType, data) {
            const containerId = `${tableType}-table`;
            const showMoreId = `${tableType}-show-more`;
            const currentShown = window[`${tableType}Shown`] || tableConfig.perPage;

            const container = document.getElementById(containerId);
            if (!container) return;

            // Create table if it doesn't exist
            if (!container.querySelector('table')) {
                container.innerHTML = `<table class="table table-hover"><tbody></tbody></table>`;
            }

            const tbody = container.querySelector('tbody');

            // Clear and rebuild if it's the initial load
            if (currentShown <= tableConfig.perPage) {
                tbody.innerHTML = '';
            }

            // Calculate range of items to show
            const startIdx = currentShown > tableConfig.perPage ? currentShown - tableConfig.perPage : 0;
            const endIdx = Math.min(currentShown, data.length);

            // Add new rows
            for (let i = startIdx; i < endIdx; i++) {
                tbody.insertAdjacentHTML('beforeend', createTableRow(data[i], tableType));
            }

            updateShowMoreButton(tableType, data.length);
        }

        function updateShowMoreButton(tableType, totalItems) {
            const showMoreBtn = document.getElementById(`${tableType}-show-more`);
            if (!showMoreBtn) return;

            const currentShown = window[`${tableType}Shown`] || tableConfig.perPage;
            const remaining = totalItems - currentShown;

            if (remaining > 0) {
                showMoreBtn.style.display = '';
                showMoreBtn.innerHTML = `
            <li class="page-item">
                <button class="btn btn-gradient-primary" onclick="showMore('${tableType}')">
                    <i class="mdi mdi-arrow-down" style="font-size: 1em;"></i> Show More <i class="mdi mdi-arrow-down" style="font-size: 1em;"></i>
                </button>
            </li>
        `;
            } else {
                showMoreBtn.style.display = 'none';
            }
        }

        // Global Functions
        window.showMore = function(tableType) {
            window[`${tableType}Shown`] = (window[`${tableType}Shown`] || tableConfig.perPage) + tableConfig.perPage;
            renderTable(tableType, window[`${tableType}Data`]);
        };

        // Initialize all tables
        document.addEventListener('DOMContentLoaded', function() {
            // Set global data
            window.bestData = topPlaysData;
            window.recentData = recentPlaysData;
            window.firstData = firstPlacesData;

            // Initialize pagination buttons for all tables
            ['best', 'recent', 'first'].forEach(type => {
                const pagination = document.getElementById(`${type}-pagination`);
                if (pagination && !document.getElementById(`${type}-show-more`)) {
                    pagination.innerHTML = `<li class="page-item" id="${type}-show-more"></li>`;
                }
            });

            // Initial render for all tables
            renderTable('best', topPlaysData);
            renderTable('recent', recentPlaysData);
            if (firstPlacesData) renderTable('first', firstPlacesData);
        });
    </script>
</body>

</html>
