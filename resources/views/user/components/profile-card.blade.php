<div class="col-lg-12 grid-margin stretch-card p-0">
    <div class="container-fluid">
        <div class="row">
            <div class="col px-0">
                <div class="card-profile-bg position-relative rounded-top"
                    style="background-image: url('{{ Storage::disk('public')->exists("/backgrounds/$user->id.png") ? asset("storage/backgrounds/$user->id.png") : asset("storage/backgrounds/default.png") }}');">
                    @if ( Auth::user()->id ?? '' == $user->id)
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
                            style="background-image: url({{ Storage::disk('public')->exists("/avatars/$user->id.png") ? asset("storage/avatars/$user->id.png") : asset("storage/avatars/default.png")}});">
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-sm-3 px-0">
                <div class="card-profile-name position-relative">
                    <h2>{{ $user->name }}</h2>
                </div>
                <div class="card-profile-details position-relative">
                    <a class="text-decoration-none text-black" href="">
                        <img src="{{ $user->flag_url }}" alt="{{ $user->country }}" srcset="" width="30px">
                        {{ $user->country_name }}
                    </a>
                    <a class="text-decoration-none text-muted" href="">
                        Clans Soon.
                    </a>
                </div>
            </div>
            <div class="col-sm d-flex px-0 align-items-center justify-content-end">
                <div class="card-profile-modes position-relative">
                    <div class="d-flex align-items-center flex-wrap gap-3 mb-3 justify-content-end">
                        <!-- Mode Selector -->
                        <div class="btn-group">
                            <button class="btn btn-gradient-primary dropdown-toggle" type="button" id="modeDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                @switch($mode)
                                    @case(0)
                                        Standard
                                    @break

                                    @case(1)
                                        Taiko
                                    @break

                                    @case(2)
                                        Catch
                                    @break

                                    @case(3)
                                        Mania
                                    @break

                                    @default
                                        Standard
                                @endswitch
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="modeDropdown">
                                @foreach ([0 => 'Standard', 1 => 'Taiko', 2 => 'Catch', 3 => 'Mania'] as $m => $name)
                                    <li>
                                        <a class="dropdown-item {{ $mode == $m ? 'active' : '' }}"
                                            href="{{ route('profile', [
                                                'id' => $user->id,
                                                'mode' => $m,
                                                'rx' => 0,
                                            ]) }}">
                                            {{ $name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- RX Selector -->
                        <div class="btn-group">
                            <button class="btn btn-gradient-primary dropdown-toggle" type="button" id="rxDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                @switch($rx)
                                    @case(0)
                                        Vanilla
                                    @break

                                    @case(4)
                                        Relax
                                    @break

                                    @case(8)
                                        AutoPilot
                                    @break

                                    @default
                                        Vanilla
                                @endswitch
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="rxDropdown">
                                @foreach ([0 => 'Vanilla', 4 => 'Relax', 8 => 'AutoPilot'] as $r => $name)
                                    @php
                                        $disabled = ($r == 4 && $mode == 3) || ($r == 8 && $mode != 0);
                                    @endphp
                                    <li>
                                        <a class="dropdown-item {{ $disabled ? 'disabled text-muted' : '' }} {{ $rx == $r ? 'active' : '' }}"
                                            href="{{ !$disabled
                                                ? route('profile', [
                                                    'id' => $user->id,
                                                    'mode' => $mode,
                                                    'rx' => $r,
                                                ])
                                                : '#' }}"
                                            @if ($disabled) aria-disabled="true" @endif>
                                            {{ $name }}
                                            @if ($disabled)
                                                <small class="text-muted ms-2">(Not available)</small>
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex align-items-center px-5 bg-light py-3 pb-5">
            <div class="col-sm markdown">
@markdown
{{ $user->userpage_content }}
@endmarkdown
            </div>
            <div class="col-sm-3 overflow-auto">
                <div class="card-body py-0">
                    <h5 class="card-title">Player Stats</h5>
                    </p>
                    <table class="table table-borderless">
                        <tbody>
                            @foreach ((array) $userProfile as $key => $value)
                                <tr>
                                    <td class="w-50 p-1">{{ $key }}</td>
                                    <td class="w-50 p-1">
                                        @if ($key === 'Total Play Time')
                                            {{ number_format($value / 3600, 2) }} hours
                                        @elseif($key === 'Hit Accuracy')
                                            {{ number_format($value, 3) }}%
                                        @elseif(is_numeric($value) && $value >= 1000)
                                            {{ number_format($value) }}
                                        @else
                                            {{ $value }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
