<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoteRequest;
use App\Models\Vote;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class VoteController extends Controller
{
    /**
     * Display the vote view.
     *
     * @return View
     */
    public function create(Request $request): View
    {
        $vote_id = $request->cookie('vote_id');
        $vote = Vote::find($vote_id);

        return view('vote')->with('vote', $vote);
    }

    /**
     * Shorten a new long URL.
     *
     * @param StoreVoteRequest $request
     * @return Response
     */
    public function store(StoreVoteRequest $request): Response
    {
        $vote_id = $request->cookie('vote_id');
        $vote = Vote::find($vote_id);

        $vote ?: $vote = new Vote();

        $vote->person_id = $request->person;
        $vote->save();

        return redirect()
            ->route('vote.form')
            ->cookie('vote_id', $vote->id, 1440);
    }
}
