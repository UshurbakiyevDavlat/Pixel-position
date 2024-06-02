<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $allJobs = Job::latest()->get()->groupBy('featured');

        $jobs = $allJobs[0];
        $featuredJobs = $allJobs[1];

        return view('jobs.index', compact('jobs', 'featuredJobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate job data
        $jobAttr = $request->validate([
            'title' => 'required|string',
            'salary' => 'required|string',
            'location' => 'required|string',
            'schedule' => ['required', Rule::in('Full-Time', 'Part-Time')],
            'url' => 'required|string',
            'tags' => 'nullable'
        ]);

        $jobAttr['featured'] = $request->has('featured');

        //create job
        $job = Auth::user()->employer->jobs()->create(Arr::except($jobAttr, 'tags'));

        if ($jobAttr['tags'] ?? false) {
            //attached tags to the job
            foreach (explode(',', $jobAttr['tags']) as $tag) {
                $job->tag($tag);
            }
        }

        return redirect('/');
    }
}
