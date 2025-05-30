<div class="col-lg-12 grid-margin stretch-card p-0">
    <div class="container-fluid">
        <div class="row">
            <div class="col px-0">
                <div class="card-profile-bg position-relative rounded-top"
                    style="background-image: url('{{ Storage::disk('public')->exists("/backgrounds/$user->id.png") ? asset("storage/backgrounds/$user->id.png") : asset('storage/backgrounds/default.png') }}');">
                    @if (Auth::user()->id ?? (0 == $user->id ?? 0))
                        <span
                            class="bg-gradient-primary text-white me-2 position-absolute bottom-0 end-0 d-flex align-items-center justify-content-center rounded-circle">
                            <a href="/u/edit/{{ $user->id }}" class="text-light"><i class="mdi mdi-pencil"></i></a>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row d-flex align-items-center px-5 bg-light border-bottom">
            <div class="col-sm-3" style="max-width: fit-content !important; min-width: fit-content !important;">
                <div class="card-profile-header position-relative d-flex">
                    <a href="#" class="card-profile-photo text-decoration-none mb-2">
                        <span class="me-2"
                            style="background-image: url({{ Storage::disk('public')->exists("/avatars/$user->id.png") ? asset("storage/avatars/$user->id.png") : asset('storage/avatars/default.png') }});">
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-sm-3 px-0 d-flex gap-2">
                <div class="card-profile-name position-relative pt-1">
                    <a class="text-decoration-none text-black" href="#" style="height: fit-content !important;">
                        <img src="{{ $user->flag_url }}" alt="{{ $user->country }}" srcset="" width="30px">
                    </a>
                </div>
                <div class="card-profile-details position-relative">
                    <h3 class="fs-3 m-0">{{ $user->name }}</h3>
                    <a class="text-decoration-none text-muted" href="#">
                        Clans Soon.
                    </a>
                </div>
            </div>
            @include('user.layouts.mode-selector')
        </div>
        <div class="row d-flex align-items-center px-5 bg-light py-3 pb-5">
            <div class="col-sm markdown">
@markdown
{{ $user->userpage_content }}
@endmarkdown
            </div>
            <div class="col-sm-5 overflow-auto">
                <div class="card-body py-0">
                    <h5 class="card-title">Player Stats</h5>
                    <div class="row g-0 border-bottom pb-3 pt-2 justify-content-evenly">
                        @if ($global_rank == 1)
                            <div
                                class="btn btn-yellow d-flex flex-column col-5 text-center py-1 px-0 justify-content-center align-items-center gap-1">
                                <h5 class="mb-0">Global Rank</h5>
                                <h4 class="mb-0">#{{ $global_rank }}</h4>
                            </div>
                        @elseif($global_rank == 2)
                            <div
                                class="btn btn-gray d-flex flex-column col-5 text-center py-1 px-0 justify-content-center align-items-center gap-1">
                                <h5 class="mb-0">Global Rank</h5>
                                <h4 class="mb-0">#{{ $global_rank }}</h4>
                            </div>
                        @elseif($global_rank == 3)
                            <div
                                class="btn btn-bronze d-flex flex-column col-5 text-center py-1 px-0 justify-content-center align-items-center gap-1">
                                <h5 class="mb-0">Global Rank</h5>
                                <h4 class="mb-0">#{{ $global_rank }}</h4>
                            </div>
                        @elseif($global_rank > 3)
                            <div
                                class="btn d-flex flex-column col-5 text-center py-1 px-0 justify-content-center align-items-center gap-1">
                                <h5 class="mb-0">Global Rank</h5>
                                <h4 class="mb-0">#{{ $global_rank }}</h4>
                            </div>
                        @else
                            <div
                                class="btn d-flex flex-column col-5 text-center py-1 px-0 justify-content-center align-items-center gap-1">
                                <h5 class="mb-0">Global Rank</h5>
                                -
                            </div>
                        @endif

                        @if ($country_rank == 1)
                            <div
                                class="btn btn-yellow d-flex flex-column col-5 text-center py-1 px-0 justify-content-center align-items-center gap-1">
                                <h5 class="mb-0">Country Rank</h5>
                                <h4 class="mb-0">#{{ $country_rank }}</h4>
                            </div>
                        @elseif($country_rank == 2)
                            <div
                                class="btn btn-gray d-flex flex-column col-5 text-center py-1 px-0 justify-content-center align-items-center gap-1">
                                <h5 class="mb-0">Country Rank</h5>
                                <h4 class="mb-0">#{{ $country_rank }}</h4>
                            </div>
                        @elseif($country_rank == 3)
                            <div
                                class="btn btn-bronze d-flex flex-column col-5 text-center py-1 px-0 justify-content-center align-items-center gap-1">
                                <h5 class="mb-0">Country Rank</h5>
                                <h4 class="mb-0">#{{ $country_rank }}</h4>
                            </div>
                        @elseif($country_rank > 3)
                            <div
                                class="btn d-flex flex-column col-5 text-center py-1 px-0 justify-content-center align-items-center gap-1">
                                <h5 class="mb-0">Country Rank</h5>
                                <h4 class="mb-0">#{{ $country_rank }}</h4>
                            </div>
                        @else
                            <div
                                class="btn d-flex flex-column col-5 text-center py-1 px-0 justify-content-center align-items-center gap-1">
                                <h5 class="mb-0">Country Rank</h5>
                                -
                            </div>
                        @endif
                    </div>
                    <div class="row g-0">
                        @foreach ((array) $user_profile as $key => $value)
                            <div class="col-6 p-1">{{ $key }}</div>
                            <div class="col-6 p-1">
                                @if ($key === 'Total Play Time')
                                    {{ number_format($value / 3600, 2) }} hours
                                @elseif($key === 'Hit Accuracy')
                                    {{ number_format($value, 3) }}%
                                @elseif(is_numeric($value) && $value >= 1000)
                                    {{ number_format($value) }}
                                @else
                                    {{ $value }}
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
