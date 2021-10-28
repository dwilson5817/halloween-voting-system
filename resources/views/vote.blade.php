@extends('app')

@section('content')
    <div class="container mt-3">
        @include('time_left')

        @if($vote)
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">
                    <i class="bi bi-hand-thumbs-up"></i> Vote registered successfully!
                </h4>
                <p>
                    If you would like to change your vote you can submit the form again and your vote will be updated.
                </p>
                <hr>
                <p class="mb-0">Your current vote: <b>{{ $vote->person->name }}</b>.  Vote ID: {{ $vote->id }}.</p>
            </div>
        @endif

        @error('person')
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </symbol>
            </svg>

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <strong>An error occurred!</strong> {{ $errors->first('person') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror

        @if(\App\Models\Vote::time_left() > 0)
            <div class="card text-dark bg-light my-3">
                <div class="card-body">
                    <h5 class="card-title">Who has the best costume?</h5>
                    <p class="card-text">Select their name below.</p>
                    <form method="post">
                        {{ csrf_field() }}

                        <div class="mb-3">
                            <select name="person" class="form-select form-select-lg mb-3" aria-label="Select name">
                                <option value="" @if(!$vote) selected @endif>Select a person</option>
                                @foreach(\App\Models\Person::all() as $person)
                                    <option value="{{ $person->id }}" @if($vote && $vote->person == $person) selected @endif>
                                        {{ $person->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        @else
            <div class="card text-dark bg-light my-3">
                <div class="card-body">
                    <h5 class="card-title">Voting is now closed</h5>
                    <p class="card-text">Click below to see the results.</p>
                    <a href="{{ route('results') }}" class="btn btn-primary">See results</a>
                </div>
            </div>
        @endif
    </div>
@endsection
