<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReadDataFromExcel;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{

    function __construct()
    {
        $this->excel = new ReadDataFromExcel;
    }

    function index(Request $request)
    {
        try {
            $file = $request->file;

            $extension = $file->extension();

            if($extension != 'xlsx') {
                return [
                    'error' => true,
                    'message' => 'File is not allowed to upload.'
                ];
            }

            $fileName = date('ymd').'.xlsx';

            $file->storeAs('xls', $fileName);

            $fileLocation = storage_path('app/xls/'.$fileName);

            $data = $this->excel->read($fileLocation);

            return response()->json([
                'error' => false,
                'message' => 'Ok',
                'data' => $data,
                'count' => count($data)
            ], 200);

        } catch(\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 422);
        }
    }
}
