<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PhoneNumberService;

class PhoneNumberController extends Controller
{

    public function __construct()
    {
        $this->phoneNumber = new PhoneNumberService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->ajax()) {

            $params = [
                'isCounter' => true,
                'start' => $request->start,
                'length' => $request->length,
                'number' => $request->number,
                'name' => $request->name,
                'nik' => $request->nik,
                'email' => $request->email,
                'status' => $request->status,
                'expired_date' => $request->expired_date,
                'created_at' => $request->created_at,
            ];

            $counter = $this->phoneNumber->datatable($params);

            $params['isCounter'] = false;
            $data = $this->phoneNumber->datatable($params);

            return $this->datatableResponse($data, $counter, $request->start);
        }

        $data['pageName'] = 'Phone Numbers';
        return view('dashboard.phone-numbers.index', $data);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
