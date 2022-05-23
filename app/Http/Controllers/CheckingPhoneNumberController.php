<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CheckingActivationNumberService;

class CheckingPhoneNumberController extends Controller
{

    public function __construct()
    {
        $this->checking = new CheckingActivationNumberService;
    }

    public function index(Request $request)
    {
        $data = $this->checking->checking($request->phone_number);
        return response()->json([
            'statusCode' => $data['statusCode'],
            'response' => strtolower($data['response']),
        ], 200);
    }
}
