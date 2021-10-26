@extends('app')

@section('content')
    <div class="container mt-3">
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
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>An error occurred!</strong> {{ $errors->first('person') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @enderror

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
    </div>
@endsection
