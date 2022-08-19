<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CandidateResource;
use App\Models\Candidate;
use App\Models\Voter;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function getCandidate()
    {
        $candidates = Candidate::orderBy('id', 'asc')->get();
        return ResponseFormatter::success(CandidateResource::collection($candidates));
    }
    public function getCandidateDetail(Candidate $candidate)
    {
        return ResponseFormatter::success(new CandidateResource($candidate));
    }
    public function getTotalVote()
    {
        $candidates = Candidate::orderBy('id', 'asc')->get();
        $names = [];
        $opds = [];
        $tvotes = [];
        $dataColors = [];

        foreach ($candidates as $candidate) {
            array_push($opds, $candidate->opd);
            array_push($names, $candidate->name);
            array_push($tvotes, $candidate->total_vote);
        }
        $colors = ["#6571ff", "#05a34a", "#66d1d1", "#fbbc06", "#ff3366", "#e9ecef", "#060c17", "#7987a1"];
        for ($i = 0; $i < count($candidates); $i++) {
            array_push($dataColors, $colors[$i]);
        }
        $data = [
            'name'      => $names,
            'opd'      => $opds,
            'total_vote' => $tvotes,
            'colors'    => $dataColors,
            'members'   => Voter::all()->count(),
            'counts'    => Voter::whereNotNull('candidate_id')->get()->count(),
            'uncount'   => Voter::whereNull('candidate_id')->get()->count(),
        ];
        return ResponseFormatter::success($data);
    }
}
