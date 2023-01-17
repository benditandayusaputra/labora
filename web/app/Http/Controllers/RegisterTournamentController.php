<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        try {
            $this->sendResponse(RegisterTournament::latest(), 'Data Berhasil Didapatkan');
        } catch (\Exception $e) {
            $this->sendError($e->getMessage(), [], 500);
        }
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
