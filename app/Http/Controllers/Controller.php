<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function datatableResponse($data, $counter, $start, $unsetId = false)
    {
        for ($i=0; $i < count($data); $i++) {
            if ($start == 0) {
                $start = 1;
            } else {
                $start = $start + 1;
            }

            $data[$i]['start_row'] = $start;
            if (isset($data[$i]->id)) {
                $data[$i]['enc_id'] = encrypt($data[$i]->id);
            }

            if ($unsetId) {
                unset($data[$i]['id']);
            }
        }

        return response()->json([
            'iTotalRecords' => $counter,
            'iTotalDisplayRecords' => $counter,
            'data' => $data
        ]);
    }

    public function apiResponse($request)
    {
        $data = [];

        if ($request['error']) {
            $message = 'Error unknown';
            $responseCode = 422;
            $errors = null;
            $isRedirect = false;

            if (isset($request['data'])) {
                $data = $request['data'];
            }

            if (isset($request['message'])) {
                $message = $request['message'];
            }

            if (isset($request['code'])) {
                $responseCode = $request['code'];
            }

            if (isset($request['isRedirect'])) {
                $isRedirect = $request['isRedirect'];
            }

            if (isset($request['errors'])) {
                $errors = $request['errors'];
            }

            if (request()->ajax()) {
                return $this->errorResponse($message, $data, $responseCode, $errors, $isRedirect);
            }

            if (request()->header('Authorization')) {
                return $this->errorResponse($message, $data, $responseCode, $errors, $isRedirect);
            }

            if ($responseCode == 500) {
                return response()->view('errors.500', ['exception' => $message], 500);
            }

            return response()->view('errors.'.$responseCode, ['message' => $message], $responseCode);
        }

        if (isset($request['data'])) {
            $data = $request['data'];
        }

        $isRedirect = false;
        if (isset($request['isRedirect'])) {
            $isRedirect = $request['isRedirect'];
        }

        $message = 'Success.';
        if (isset($request['message'])) {
            if ($request['message'] != null) {
                $message = $request['message'];
            }
        }

        // \DB::commit();
        return $this->successResponse($message, $data, $isRedirect);
    }

    /*
    * Success response
    */
    public function successResponse($message = null, $data = [], $isRedirect = false)
    {
        return response()->json([
            'code' => 200,
            'success' => true,
            'is_redirect' => $isRedirect,
            'message' => $message,
            'data' => $data,
        ], 200);
    }

    /*
    * Error response
    */
    public function errorResponse($message = null, $data = [], $code = 422, $errors = null, $isRedirect = false)
    {
        return response()->json([
            'code' => $code,
            'success' => false,
            'is_redirect' => $isRedirect,
            'message' => $message,
            'errors' => $errors,
            'data' => $data,
        ], $code);
    }
}
