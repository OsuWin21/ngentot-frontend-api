<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title d-flex justify-content-between">Recent Plays<a
                        class="dark-link" href="#">Click Here For More -></a></h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> Time(UTC+8) </th>
                                <th> Player </th>
                                <th> Mode </th>
                                <th> Map </th>
                                <th> Score </th>
                                <th> PP </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recent_plays as $item)
                                <tr>
                                    <td>{{ $item->play_time }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>
                                        @switch($item->mode)
                                            @case(0)
                                                osu!Standard
                                            @break

                                            @case(1)
                                                osu!Taiko
                                            @break

                                            @case(2)
                                                osu!Catch
                                            @break

                                            @case(3)
                                                osu!Mania
                                            @break

                                            @case(4)
                                                relax!Standard
                                            @break

                                            @case(5)
                                                relax!Taiko
                                            @break

                                            @case(6)
                                                relax!Catch
                                            @break

                                            @case(7)
                                                relax!Mania
                                            @break

                                            @case(8)
                                                autopilot!Standard
                                            @break

                                            @case(9)
                                                autopilot!Taiko
                                            @break

                                            @case(7)
                                                autopilot!Catch
                                            @break

                                            @case(7)
                                                autopilot!Mania
                                            @break

                                            @default
                                                What even is this mode
                                        @endswitch
                                    </td>
                                    <td>{{ $item->filename }}</td>
                                    <td>{{ number_format($item->score, 0, '.', ',') }}</td>
                                    <td>{{ number_format($item->pp, 0, '.', ',') }}pp</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>