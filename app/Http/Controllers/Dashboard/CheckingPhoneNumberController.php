<?php

namespace App\Http\Controllers\Dashboard;

use App\Services\CheckingActivationNumberService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CacheFile;

class CheckingPhoneNumberController extends Controller
{
    public function __construct()
    {
        $this->checking = new CheckingActivationNumberService;
    }

    public function index(Request $request)
    {
        $data = $this->checking->checking($request->phone_number);

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
