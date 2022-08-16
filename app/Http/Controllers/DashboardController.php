<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'members'   => Voter::all()->count(),
            'counts'    => Voter::whereNotNull('candidate_id')->get()->count(),
            'uncount'   => Voter::whereNull('candidate_id')->get()->count(),
        ];
        return view('dashboard', compact('data'));
    }
}
