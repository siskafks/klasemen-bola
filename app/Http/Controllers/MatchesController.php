<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Matches;
use Illuminate\Http\Request;

class MatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clubs = Club::all(); 
        return view('input-match', ['clubs' => $clubs]);
    }

    public function getOneMatch()
    {
        $clubs = Club::all(); 
        return view('input-one-match', ['clubs' => $clubs]);
    }

    public function getMatches()
    {
        $matches = Matches::selectRaw('matches.*, club1.club_name AS club1_name, club2.club_name AS club2_name')
                            ->join('clubs AS club1', 'matches.club1_id', '=', 'club1.club_id')
                            ->join('clubs AS club2', 'matches.club2_id', '=', 'club2.club_id')
                            ->get();
        
        return view('matches', ['matches' => $matches]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function storeOneMatch(Request $request)
    {
        $validatedData = $request->validate([
            'club1_id' => 'required',
            'club2_id' => 'required',
            'score1' => 'required|integer',
            'score2' => 'required|integer',
        ]);

        $existingMatch = Matches::where(function ($query) use ($validatedData) {
            $query->where('club1_id', $validatedData['club1_id'])
                    ->where('club2_id', $validatedData['club2_id']);
        })->orWhere(function ($query) use ($validatedData) {
            $query->where('club1_id', $validatedData['club2_id'])
                    ->where('club2_id', $validatedData['club1_id']);
        })->exists();
    
        if ($existingMatch) {
            session()->flash('error', 'Tidak boleh ada data pertandingan yang sama.');
        } else {
            Matches::create($validatedData);
            session()->flash('success', 'Pertandingan baru berhasil ditambahkan.');
        }

        return redirect('/one-match');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'matches.*.club1_id' => 'required',
            'matches.*.club2_id' => 'required',
            'matches.*.score1' => 'required|integer',
            'matches.*.score2' => 'required|integer',
        ]);

        foreach ($validatedData['matches'] as $matchData) {
            $existingMatch = Matches::where(function ($query) use ($matchData) {
                $query->where('club1_id', $matchData['club1_id'])
                      ->where('club2_id', $matchData['club2_id']);
            })->orWhere(function ($query) use ($matchData) {
                $query->where('club1_id', $matchData['club2_id'])
                      ->where('club2_id', $matchData['club1_id']);
            })->exists();
        
            if ($existingMatch) {
                $isExist = true;
                session()->flash('error', 'Terdapat data pertandingan yang sama. Data pertandingan yang sama tidak akan tersimpan.');
            } else {
                Matches::create([
                    'club1_id' => $matchData['club1_id'],
                    'club2_id' => $matchData['club2_id'],
                    'score1' => $matchData['score1'],
                    'score2' => $matchData['score2'],
                ]);
                session()->flash('success', 'Pertandingan baru berhasil ditambahkan.');
            }
        }

        return redirect('/multiple-matches');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Matches  $matches
     * @return \Illuminate\Http\Response
     */
    public function show(Matches $matches)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Matches  $matches
     * @return \Illuminate\Http\Response
     */
    public function edit(Matches $matches)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Matches  $matches
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Matches $matches)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Matches  $matches
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matches $matches)
    {
        //
    }
}
