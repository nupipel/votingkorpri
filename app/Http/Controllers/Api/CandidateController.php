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
        $datasets = [];
        $colors = ["#6571ff", "#05a34a", "#66d1d1", "#fbbc06", "#ff3366", "#e9ecef", "#060c17", "#7987a1"];
        foreach (json_decode($candidates) as $key => $value) {
            $datasets[] = [
                'label' => $value->name,
                'data' => [$value->total_vote],
                'backgroundColor' => $colors[$key],
            ];
            $names[] = $value->name;
        }

        $data = [
            'name'      => 'Hasil Pilihan',
            'datasets' => $datasets,
            'members'   => Voter::all()->count(),
            'counts'    => Voter::whereNotNull('candidate_id')->get()->count(),
            'uncount'   => Voter::whereNull('candidate_id')->get()->count(),
        ];
        return ResponseFormatter::success($data);
    }
}
