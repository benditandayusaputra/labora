<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\RegisterTournament;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Str;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

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

            $temporaryIds = [];

            if ( json_decode($request->name) ) {
                $names = json_decode($request->name);
                $price = 0;
                $tournamentData = Tournament::where('id', $request->tournament_id)->first();
                if ( intval($tournamentData->quota) < count($names) ) {
                    return $this->sendError('Slot Turnamen Kurang Dari '.count($names), [], 422); 
                }
                foreach ($names as $value) {
                    $tournament = Tournament::find($request->tournament_id);
                    if ( $tournament ) {
                        $dataSave = array_merge($request->except('name'), ['name' => $value]);
                        $saveReg = RegisterTournament::create($dataSave);
                        $tournament->quota = $tournamentData->quota - 1;
                        $tournament->save();
                        $price = $price + intval($tournamentData->price);

                        array_push($temporaryIds, $saveReg->id);
                    }
                }

                $dataPayment = [
                    // 'id'                => '',
                    'gross_amount'      => $price,
                    'payment_link_id'   => '',
                    'price'             => $tournamentData->price,
                    'quantity'          => count($names),
                    'name'              => 'Register',
                    'tournament_id'     => $request->tournament_id
                ];

                $dataPayment = Payment::create($dataPayment);

            } else {
                $tournamentData = Tournament::where('id', $request->tournament_id)->first();
                $tournament = Tournament::find($request->tournament_id);
                if ( $tournament ) {
                    if ( intval($tournament->quota) < 1 ) {
                        return $this->sendError('Slot Turnamen Sudah Habis', [], 422); 
                    }
                    $saveReg = RegisterTournament::create($input);
                    $tournament->quota = $tournamentData->quota - 1;
                    $tournament->save();
                    array_push($temporaryIds, $saveReg->id);
                }

                $dataPayment = [
                    'gross_amount'      => $tournamentData->price,
                    'payment_link_id'   => null,
                    'price'             => $tournamentData->price,
                    'quantity'          => 1,
                    // 'name'              => 'Register',
                    'name'              => $request->name,
                    'tournament_id'     => $request->tournament_id,
                    'status'            => 0,
                    'proof_of_payment'  => null
                ];

                $dataPayment = Payment::create($dataPayment);
            }

            foreach ($temporaryIds as $id) {
                RegisterTournament::where('id', $id)->update([
                    'payment_id' => $dataPayment->id
                ]);
            }
            
            // $headerReq = [
            //     'Accept'        => 'application/json',
            //     'Content-Type'  => 'application/json',
            //     // 'Authorization' => 'Basic U0ItTWlkLXNlcnZlci1iNEl1RUJ0T1pqeUNUV0pfZmV2Z3RqdEQ6',
            //     'Authorization' => 'Basic U0ItTWlkLXNlcnZlci1sN2xNX29MSzVxUlNNMVQwMHBuR1ZEdmU6',
            //     // 'Authorization' => 'Basic TWlkLXNlcnZlci1OdUhqVzZ4czZkNnhzWXF2Si1VVWFRV0M=',
            // ];

            // $bodyReq = [
            //     "transaction_details" => [
            //       "order_id" => strval($dataPayment->id),
            //       "gross_amount" => $dataPayment->gross_amount,
            //     //   "payment_link_id" => "register-".$dataPayment->id
            //     ],
            //     "credit_card" => [
            //       "secure" => true
            //     ],
            //     "usage_limit" =>  1,
            //     "expiry" => [
            //       "start_time" => date('Y-m-d H:i')." +0700",
            //       "duration" => 20,
            //       "unit" => "days"
            //     ],
            //     "enabled_payments" => [
            //       "qris",
            //       "gopay"
            //     ],
            //     "item_details" => [
            //       [
            //         "id" => "reg-".$dataPayment->id,
            //         "name" => "Register",
            //         "price" => $dataPayment->price,
            //         "quantity" => $dataPayment->quantity,
            //         "brand" => "Labora",
            //         "category" => "Register",
            //         "merchant_name" => "PT. Labora"
            //       ]
            //     ],
            //     "customer_details" => [
            //       "first_name" => $request->name,
            //     //   "last_name" => "Tandayu",
            //       "email" => $request->email,
            //       "phone" => $request->hp,
            //       "notes" => "Terimakasih Telah Mendaftar, Silahkan Lakukan Pembayaran Anda."
            //     ],
            // //   "custom_field1" => "custom field 1 content", 
            // //   "custom_field2" => "custom field 2 content", 
            // //   "custom_field3" => "custom field 3 content"
            // ];
            
            // $client = new Client([
            //     'headers' => $headerReq
            // ]);
            
            // $path = 'https://api.sandbox.midtrans.com/v1/payment-links'; //Dev
            // // $path = 'https://api.midtrans.com/v1/payment-links'; //Prod
            // $response = $client->post($path,
            //     ['body' => json_encode($bodyReq)]
            // );
            
            return $this->sendResponse($request->all(), 'Berhasil Mendaftar');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), [], 500);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RegisterTournament  $registerTournament
     * @return \Illuminate\Http\Response
     */
    public function updateStatus($orderId)
    {
        try {
           RegisterTournament::where('payment_id', $orderId)->update([
                'status' => 1
            ]);
    
            return view('admin.register_tournament.status');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), [], 500);
        }
    }
    
    /**
     * Confirm Payment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RegisterTournament  $registerTournament
     * @return \Illuminate\Http\Response
     */
    public function confirmPayment(Request $request)
    {
        try {
            $request->validate([
                'proof_of_payment' => 'required|image|max:4000'
            ]);
            
            if ( $request->hasFile('proof_of_payment') ) {
                $proof = $request->file('proof_of_payment');
                $fileNameGenerated = date('Ymdhis').$proof->getClientOriginalName();
                $proof->move('uploads/proof_of_payment/file', $fileNameGenerated);
                Payment::where('id', $request->order_id)->update([
                    'proof_of_payment' => $fileNameGenerated
                ]);

                return $this->sendResponse($fileNameGenerated, 'Berhasil Upload Bukti Pembayaran');
            }
    
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), [], 500);
        }
    }
}