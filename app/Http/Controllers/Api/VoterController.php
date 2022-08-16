<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Voter;
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
        $voter = Voter::where('slug', $data['slug'])->first();
        if ($voter == null) {
            return ResponseFormatter::error(null, 'Data Voter Tidak Ditemukan');
        }
        if ($voter->candidate_id != null) {
            return ResponseFormatter::error(null, 'Anda Sudah Melakukan Voting Sebelumnya');
        }
        $voter->update($data);
        return ResponseFormatter::success($voter, 'Terimakasih Anda Sudah Melakukan Voting');
        // } catch (\Throwable $th) {
        //     ResponseFormatter::error();
        // }
        // ResponseFormatter::error();
    }
}
