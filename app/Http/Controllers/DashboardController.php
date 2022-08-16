<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use App\Http\Controllers\Controller;
use App\Models\Candidate;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'members'   => Voter::all()->count(),
            'counts'    => Voter::whereNotNull('candidate_id')->get()->count(),
            'uncount'   => Voter::whereNull('candidate_id')->get()->count(),
        ];
        $candidates = Candidate::all();
        return $candidates;
        return view('dashboard', compact('data'));
    }
}
