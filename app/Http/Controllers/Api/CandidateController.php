<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CandidateResource;
use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function getCandidate(){
        $candidates = Candidate::all();
        return ResponseFormatter::success(CandidateResource::collection($candidates));
    }
}
