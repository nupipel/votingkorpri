<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVoterRequest;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class VoterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voters = Voter::all();
        return view('pages.voters.index', compact('voters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.voters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateVoterRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::random(30);
        Voter::create($data);
        session()->flash('success');
        return redirect(route('voter.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voter  $voter
     * @return \Illuminate\Http\Response
     */
    public function show(Voter $voter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voter  $voter
     * @return \Illuminate\Http\Response
     */
    public function edit(Voter $voter)
    {
        return view('pages.voters.create', compact('voter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Voter  $voter
     * @return \Illuminate\Http\Response
     */
    public function update(CreateVoterRequest $request, Voter $voter)
    {
        $data = $request->all();
        $voter->update($data);
        session()->flash('success');
        return redirect(route('voter.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voter  $voter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Voter::findOrFail($id)->delete();
        return response()->json(['msg' => 'Deleted successfully.']);
        // session()->flash('success');
        // return redirect(route('voter.index'));
    }
}
