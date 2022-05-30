<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CacheFile;

class ContinueController extends Controller
{
    public function index(Request $request)
    {

        $data = CacheFile::where('cache_name', $request->file_cache)->first();

        $cacheData = json_decode($data->cache_data, true);

        return response()->json([
            'error' => false,
            'message' => 'Ok',
            'data' => [
                'phone_numbers' => $cacheData,
                'cache_file' => $data->cache_name
            ],
        ], 200);

    }
}
