<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Tournament;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tournaments = Tournament::latest()->get();
        
        if ( $request ) {
            $data = Payment::latest();
            if ( $request->tournament_id ) {
                $data->where('tournament_id', $request->tournament_id);
            }
            if ( $request->status ) {
                $data->where('status', $request->status);
            }
            $data = $data->get();
        } else {
            $data = Payment::latest()->get();
        }
        
        return view('admin.register_tournament.index', compact('data', 'tournaments', 'request'));
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
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        Payment::where('id', $id)->update(['status' => 2]);

        return redirect()->route('tournament.index')->with('success', 'Data Berhasil Di Konfirmasi');  
    }
}