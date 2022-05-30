<?php

namespace App\Http\Controllers\Dashboard;

use App\Services\CheckingActivationNumberService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ {
    CacheFile,
    PhoneNumber
};

class CheckingPhoneNumberController extends Controller
{
    public function __construct()
    {
        $this->checking = new CheckingActivationNumberService;
    }

    public function index(Request $request)
    {

        $phoneNumber = PhoneNumber::where('number', $request->phone_number)->first();

        $data = $this->checking->checking($request->phone_number);

        if(!$phoneNumber) {

            $statusMessage = strtolower($data['response']);

            if($statusMessage == 'nomor anda saat ini sudah dalam keadaan aktif') {
                $status = 'active';
            } else if($statusMessage == 'nomor anda valid') {
                $status = 'inactive';
            } else if($statusMessage == 'nomor tidak dapat di temukan') {
                $status = 'unknown';
            } else if($statusMessage == 'nomor Anda tidak dapat dikenali, harap cek kembali') {
                $status = 'unknown';
            } else {
                $status = 'inactive';
            }

            PhoneNumber::create([
                'user_id' => auth()->user()->id,
                'number' => $request->phone_number,
                'status' => $status,
                'status_message' => $data['response'],
            ]);
        }

        $cache = CacheFile::where('cache_name', $request->cache_file)->first();

        $cacheData = json_decode($cache->cache_data, true);

        $newArray = array_values(
            array_diff(
                $cacheData, [$request->phone_number]
            )
        );

        $cache->update([
            'cache_data' => json_encode($newArray)
        ]);

        return response()->json([
            'statusCode' => $data['statusCode'],
            'response' => strtolower($data['response']),
            'count' => count($newArray)
        ], 200);
    }
}
