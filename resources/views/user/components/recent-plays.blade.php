<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body table-responsive">
            <h4 class="card-title">Recent Plays(24h)</h4>
            </p>
            <table class="table table-hover">
                <tbody>
                    @foreach ($recent_plays as $item)
                    {{-- @dd($item) --}}
                        <tr>
                            <td style="width: 5%; text-align: center;">
                                @switch($item['grade'])
                                    @case('XH')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/aee49df28def2cd5b467bb5c597a0cbf16b59d4c/public/images/badges/score-ranks-v2019/GradeSmall-SS-Silver.svg"
                                            alt="image" />
                                    @break

                                    @case ('X')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/aee49df28def2cd5b467bb5c597a0cbf16b59d4c/public/images/badges/score-ranks-v2019/GradeSmall-SS.svg"
                                            alt="image" />
                                    @break

                                    @case ('SH')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/aee49df28def2cd5b467bb5c597a0cbf16b59d4c/public/images/badges/score-ranks-v2019/GradeSmall-S-Silver.svg"
                                            alt="image" />
                                    @break

                                    @case ('S')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/aee49df28def2cd5b467bb5c597a0cbf16b59d4c/public/images/badges/score-ranks-v2019/GradeSmall-S.svg"
                                            alt="image" />
                                    @break

                                    @case ('A')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/aee49df28def2cd5b467bb5c597a0cbf16b59d4c/public/images/badges/score-ranks-v2019/GradeSmall-A.svg"
                                            alt="image" />
                                    @break

                                    @case ('B')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/aee49df28def2cd5b467bb5c597a0cbf16b59d4c/public/images/badges/score-ranks-v2019/GradeSmall-B.svg"
                                            alt="image" />
                                    @break

                                    @case ('C')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/aee49df28def2cd5b467bb5c597a0cbf16b59d4c/public/images/badges/score-ranks-v2019/GradeSmall-C.svg"
                                            alt="image" />
                                    @break

                                    @case ('D')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/aee49df28def2cd5b467bb5c597a0cbf16b59d4c/public/images/badges/score-ranks-v2019/GradeSmall-D.svg"
                                            alt="image" />
                                    @break

                                    @case ('F')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/aee49df28def2cd5b467bb5c597a0cbf16b59d4c/public/images/badges/score-ranks-v2019/GradeSmall-F.svg"
                                            alt="image" />
                                    @break
                                @endswitch
                            </td>
                            <td style="width: 50%; max-width: 300px"><a class="text-decoration-none link-primary"
                                    href="https://osu.ppy.sh/b/{{ $item['beatmap']['id'] }}">{{ Str::limit($item['beatmap']['title'], 40) }}
                                    by
                                    {{ Str::limit($item['beatmap']['artist'], 20) }}</a><br>{{ $item['beatmap']['version'] }} - <small
                                    class="text-body-secondary">{{ \Carbon\Carbon::parse($item['play_time'])->diffForHumans() }}<small>
                            </td>

                            <td style="width: 15%" class="text-end pe-5">
                                @foreach ($item['mods_list'] as $mods)
                                    @if ($mods == 'None')
                                    @elseif ($mods == 'No Fail')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_no-fail.png?"
                                            alt="image" width="auto" />
                                    @elseif ($mods == 'Easy')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_easy.png?"
                                            alt="image" />
                                    @elseif ($mods == 'TouchDevice')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_touchdevice.png?"
                                            alt="image" />
                                    @elseif ($mods == 'Hidden')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_hidden.png?"
                                            alt="image" />
                                    @elseif ($mods == 'HardRock')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_hard-rock.png?"
                                            alt="image" />
                                    @elseif ($mods == 'SuddenDeath')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_sudden-death.png?"
                                            alt="image" />
                                    @elseif ($mods == 'DoubleTime')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_double-time.png?"
                                            alt="image" />
                                    @elseif ($mods == 'Relax')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_relax.png?"
                                            alt="image" />
                                    @elseif ($mods == 'HalfTime')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_half.png?"
                                            alt="image" />
                                    @elseif ($mods == 'Nightcore')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_nightcore.png?"
                                            alt="image" />
                                    @elseif ($mods == 'Flashlight')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_flashlight.png?"
                                            alt="image" />
                                    @elseif ($mods == 'Autoplay')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_auto.png?raw="
                                            alt="image" />
                                    @elseif ($mods == 'SpunOut')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_spun-out.png?"
                                            alt="image" />
                                    @elseif ($mods == 'Autopilot')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_autopilot.png?"
                                            alt="image" />
                                    @elseif ($mods == 'Perfect')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_perfect.png?"
                                            alt="image" />
                                    @elseif ($mods == 'Key4')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_4Kb.png?"
                                            alt="image" />
                                    @elseif ($mods == 'Key5')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_5Kb.png?"
                                            alt="image" />
                                    @elseif ($mods == 'Key6')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_6Kb.png?"
                                            alt="image" />
                                    @elseif ($mods == 'Key7')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_7Kb.png?"
                                            alt="image" />
                                    @elseif ($mods == 'Key8')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_8Kb.png?"
                                            alt="image" />
                                    @elseif ($mods == 'Fade In')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_fader.png?"
                                            alt="image" />
                                    @elseif ($mods == 'Random')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_random.png?"
                                            alt="image" />
                                    @elseif ($mods == 'Cinema')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_cinema.png?"
                                            alt="image" />
                                    @elseif ($mods == 'Target')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_target.png?"
                                            alt="image" />
                                    @elseif ($mods == 'Key9')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_9Kb.png?"
                                            alt="image" />
                                    @elseif ($mods == 'KeyCoop')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_coop.png?"
                                            alt="image" />
                                    @elseif ($mods == 'Key1')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_1Kb.png?"
                                            alt="image" />
                                    @elseif ($mods == 'Key3')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_3Kb.png?"
                                            alt="image" />
                                    @elseif ($mods == 'Key2')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_2Kb.png?"
                                            alt="image" />
                                    @elseif ($mods == 'ScoreV2')
                                        <img src="https://raw.githubusercontent.com/ppy/osu-web/refs/heads/master/public/images/badges/mods/mod_v2.png?"
                                            alt="image" />
                                    @endif
                                @endforeach
                            </td>
                            <td style="width: 5%"> {{ $item['acc'] }}% </td>
                            <td style="width: 5%" class="{!! $item['beatmap']['status'] == 2 ? 'text-end' : 'text-center fs-4' !!}">
                                {!! $item['beatmap']['status'] == 2 ? number_format($item['pp'], 0) . 'pp' : '<i class="mdi mdi-heart text-danger"></i>' !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>