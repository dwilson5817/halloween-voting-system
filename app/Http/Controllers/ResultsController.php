<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Vote;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    /**
     * Display the vote view.
     *
     * @return View
     */
    public function create(): View
    {
        $people = Person::withCount('votes')->get()->where('votes_count', '>', 0);
        $most_votes = $people->max('votes_count');

        return view('results')
            ->with('results', $people->sortByDesc('votes_count')->values())
            ->with('winners', $people->where('votes_count', $most_votes));
    }
}
