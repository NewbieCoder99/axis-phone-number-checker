<?php

namespace App\Services;

class ReadDataFromExcel
{
	public function read($file)
	{
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$reader->setReadDataOnly(true);
		$data = $reader->load($file);

        $phoneNumbers = $data->getActiveSheet()->toArray();

        $phoneNumberItems = [];
        $n = 0;
        foreach($phoneNumbers as $phoneNumber) {
            if($n != 0) {
                if($phoneNumber[4] != null) {
                    if(strpos($phoneNumber[4],'0',0)) {
                        $pn = 0 . $phoneNumber[4];
                    } else {
                        $pn = $phoneNumber[4];
                    }

                    if(strpos($pn,' / ')) {
                    	$pn = explode(' / ', $pn);
                    	$phoneNumberItems[] = strval(trim($pn[0]));
                    	$phoneNumberItems[] = strval(trim($pn[1]));
                    } else {
                    	if(is_numeric($pn)) {
                    		$phoneNumberItems[] = strval($pn);
                    	}
                    }
                }
            }
            $n++;
        }

        return $phoneNumberItems;
	}
}