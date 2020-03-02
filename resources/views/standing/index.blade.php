@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Premier League Standing</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Team</th>
                                <th scope="col">PTS</th>
                                <th scope="col">P</th>
                                <th scope="col">W</th>
                                <th scope="col">D</th>
                                <th scope="col">L</th>
                                <th scope="col">GD</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($standings as $standing)
                                <tr>
                                    <th>{{ $standing['team_name'] }}</th>
                                    <td>{{ $standing['points'] ?? 0 }}</td>
                                    <td>{{ $standing['played'] ?? 0}}</td>
                                    <td>{{ $standing['win'] ?? 0}}</td>
                                    <td>{{ $standing['draw'] ?? 0}}</td>
                                    <td>{{ $standing['loose'] ?? 0}}</td>
                                    <td>{{ $standing['goal_difference'] ?? 0}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <?php $week = (integer)(request()->route()->parameters['week'] ?? 1); ?>
                        @if($week >= 12)
                            <button type="submit" style="float: right"
                                    onclick="window.location='{{ route("standing", [1]) }}'">
                                First week
                            </button>
                        @else
                            <button type="submit" style="float: right"
                                    onclick="window.location='{{ route("standing", [$week + 1]) }}'">
                                Next week
                            </button>
                        @endif

                        {{--TODO Do not hard code all weeks --}}
                        <button type="submit" onclick="window.location='{{ route("standing", [12]) }}'">
                            Play all
                        </button>
                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ \App\Match::$weekStrings[$week] }} week match results</div>
                    <div class="card-body">
                        @foreach($matches as $match)
                            @if($match->week == $week)
                                <div class="row">
                                    <div class="col-md-4">{{ $match->home_team['name'] }}</div>
                                    <div class="col-md-2">{{ $match->result['home_team']}}</div>
                                    <div class="col-md-2">{{ $match->result['away_team']}}</div>
                                    <div class="col-md-4">{{ $match->away_team['name'] }}</div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <br>
                @if(isset($predictions) && $predictions)
                    <div class="card">
                        <div class="card-header">{{ \App\Match::$weekStrings[$week] }} week prediction of champions
                        </div>
                        <div class="card-body">
                            @foreach($predictions as $prediction)
                                <div class="row">
                                    <div class="col-md-8">{{ $prediction['team_name'] }}    </div>
                                    <div class="col-md-4">% {{ $prediction['predict']}}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
