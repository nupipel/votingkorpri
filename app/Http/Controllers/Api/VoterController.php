<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\Request;

class VoterController extends Controller
{
    public function storeVote(Request $request)
    {
        // try {
        $data = $request->validate([
            'slug' => 'required',
            'candidate_id' => 'required'
        ]);
        $candidate = Candidate::where('slug', $data['slug'])->firstOrFail();
        if ($candidate->candidate_id != null) {
            return ResponseFormatter::error(null, 'Anda Sudah Melakukan Voting Sebelumnya');
        }
        $candidate->update($data);
        return ResponseFormatter::success($candidate, 'Terimakasih Anda Sudah Melakukan Voting');
        // } catch (\Throwable $th) {
        //     ResponseFormatter::error();
        // }
        // ResponseFormatter::error();
    }
}
