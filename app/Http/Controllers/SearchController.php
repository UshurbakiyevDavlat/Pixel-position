<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = $request->validate([
            'q' => 'required|string',
        ]);

        $jobs = Job::where('title', 'LIKE', "%{$query['q']}%")->get();

        return view('jobs.results', compact('jobs'));
    }
}
