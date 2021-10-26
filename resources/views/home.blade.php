@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="card text-dark bg-light text-center mt-3">
                    <div class="card-body">
                        <i class="bi bi-archive-fill" style="font-size: 4rem;"></i>
                        <h5 class="card-title">Vote</h5>
                        <p class="card-text">Submit your vote for the best costume.</p>
                        <a href="{{ route('vote.form') }}" class="btn btn-primary">Submit vote</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card text-dark bg-light text-center mt-3">
                    <div class="card-body">
                        <i class="bi bi-pie-chart-fill" style="font-size: 4rem;"></i>
                        <h5 class="card-title">Results</h5>
                        <p class="card-text">See who currently has the most votes.</p>
                        <a href="{{ route('results') }}" class="btn btn-primary">See results</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
