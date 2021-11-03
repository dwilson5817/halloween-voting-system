@extends('app')

@section('page-title')
    Results
@endsection

@section('content')
    <div class="container">
        @include('time_left')

        @if(\App\Models\Vote::time_left() > 0)
            <div class="card text-dark bg-light my-3">
                <div class="card-body">
                    <h5 class="card-title">Voting is still open</h5>
                    <p class="card-text">Click below to vote.</p>
                    <a href="{{ route('vote.form') }}" class="btn btn-primary">Submit vote</a>
                </div>
            </div>
        @else
            <div class="card text-dark bg-light mt-3">
                <div class="card-body">
                    <h5 class="card-title">Results</h5>
                    <p class="card-text">
                        @if(count($winners) > 1)
                            The winners are <b>{{ \App\Models\Person::natural_language_join($winners->pluck('name')->toArray()) }}</b>.
                        @elseif(count($winners) == 1)
                            The winner is <b>{{ $results->first()->name }}</b>.
                        @else
                            No votes yet!  Check back later.
                        @endif
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card text-dark bg-light mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Table</h5>
                            <p class="card-text">An ordered table of everyone with at least one vote.</p>
                            @if($results->isEmpty())
                                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </symbol>
                                </svg>
                                <div class="alert alert-danger d-flex align-items-center mb-0" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                    <div>
                                        No data yet.
                                    </div>
                                </div>
                            @else
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Votes</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $position = 1;
                                        $previous = $results->first();
                                    @endphp
                                    @foreach($results as $key => $person)
                                        @if($person->votes_count)
                                            @if($previous->votes_count != $person->votes_count)
                                                @php $position = $position + 1 @endphp
                                            @endif
                                            <tr>
                                                <th scope="row">{{ $position }}</th>
                                                <td>{{ $person->name }}</td>
                                                <td>{{ $person->votes_count }}</td>
                                            </tr>
                                            @php $previous = $person @endphp
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card text-dark bg-light mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Chart</h5>
                            <p class="card-text">Data displayed as pie chart.</p>
                            @if($results->isEmpty())
                                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </symbol>
                                </svg>
                                <div class="alert alert-danger d-flex align-items-center mb-0" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                    <div>
                                        No data yet.
                                    </div>
                                </div>
                            @else
                                <canvas id="myChart" width="400" height="400"></canvas>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"
                                        integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ=="
                                        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                                <script>
                                    const data = {
                                        labels: [
                                            @foreach($results as $person)
                                                @if($person->votes_count)
                                                '{{ $person->name }}',
                                            @endif
                                            @endforeach
                                        ],
                                        datasets: [{
                                            label: 'My First Dataset',
                                            data: [
                                                @foreach($results as $person)
                                                    @if($person->votes_count)
                                                    {{ $person->votes_count }},
                                                @endif
                                                @endforeach
                                            ],
                                            backgroundColor: [
                                                'rgb(255, 99, 132)',
                                                'rgb(54, 162, 235)',
                                                'rgb(255, 205, 86)'
                                            ],
                                            hoverOffset: 4
                                        }]
                                    };

                                    const ctx = document.getElementById('myChart');
                                    const myChart = new Chart(ctx, {
                                        type: 'pie',
                                        data: data
                                    });
                                </script>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
