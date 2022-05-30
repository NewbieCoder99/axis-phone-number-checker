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
}
