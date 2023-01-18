<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\RegisterTournament;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterTournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tournaments = Tournament::latest()->get();
        $clubs = Club::latest()->get();
        
        if ( $request ) {
            $data = RegisterTournament::latest();
            if ( $request->tournament_id ) {
                $data->where('tournament_id', $request->tournament_id);
            }
            if ( $request->club_id ) {
                $data->where('club_id', $request->club_id);
            }
            if ( $request->status ) {
                $data->where('status', $request->status);
            }
            $data = $data->paginate(50);
        } else {
            $data = RegisterTournament::latest()->paginate(50);
        }
        
        return view('admin.register_tournament.index', compact('data', 'tournaments', 'clubs', 'request'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RegisterTournament  $registerTournament
     * @return \Illuminate\Http\Response
     */
    public function show(RegisterTournament $registerTournament)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RegisterTournament  $registerTournament
     * @return \Illuminate\Http\Response
     */
    public function edit(RegisterTournament $registerTournament)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RegisterTournament  $registerTournament
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegisterTournament $registerTournament)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RegisterTournament  $registerTournament
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegisterTournament $registerTournament)
    {
        //
    }
}