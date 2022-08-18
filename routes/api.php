<?php

use App\Http\Controllers\Api\CandidateController;
use App\Http\Controllers\Api\VoterController;
use App\Http\Controllers\Api\WhatsappController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getCandidate', [CandidateController::class, 'getCandidate']);
Route::get('getCandidate/{candidate}', [CandidateController::class, 'getCandidateDetail']);
Route::post('storeVote', [VoterController::class, 'storeVote']);
Route::get('wa', [WhatsappController::class, 'kirim_wa']);
Route::get('singleWhatsapp/{voter}', [WhatsappController::class, 'singleWhatsapp']);
Route::get('getTotalVote', [CandidateController::class, 'getTotalVote']);
