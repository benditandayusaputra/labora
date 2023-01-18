<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        //
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
        try {
            $input = $request->all();
       
            $validator = Validator::make($input, [
                'tournament_id' => 'required',
                'club_id'       => 'required',
                'name'          => 'required',
                'hp'            => 'required',
                'status'        => 'required',
            ]);
       
            if( $validator->fails() ) {
                return $this->sendError('Validation Error.', $validator->errors(), 422);       
            }

            if ( count(json_decode($request->name)) > 1 ) {
                foreach (json_decode($request->name) as $value) {
                    $tournament = Tournament::find($request->tournamen_id);
                    if ( $tournament ) {
                        $dataSave = array_merge($request->except('name'), ['name' => $value['name']]);
                        RegisterTournament::create($dataSave);
                        $tournament->quota = $tournament->qouta - 1;
                        $tournament->save();
                    }
                }
            } else {
                $tournament = Tournament::find($request->tournamen_id);
                if ( $tournament ) {
                    $dataSave = $request->all();
                    RegisterTournament::create($dataSave);
                    $tournament->quota = $tournament->qouta - 1;
                    $tournament->save();
                }
            }
            
    
            return $this->sendResponse($request->all(), 'Berhasil Mendaftar');
        } catch (\Exception $e) {
            $this->sendError($e->getMessage(), [], 500);
        }
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
        try {
            $registerTournament->status = $request->status;
            $registerTournament->save();
    
            return $this->sendResponse($registerTournament, 'Berhasil Mendaftar');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), [], 500);
        }
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