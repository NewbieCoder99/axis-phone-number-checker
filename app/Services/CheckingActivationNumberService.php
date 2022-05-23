<?php

namespace App\Services;

class CheckingActivationNumberService
{
	public function checking($number)
	{
		$client = new \GuzzleHttp\Client([
			'verify' => false
		]);

		$res = $client->get(
			'https://prioritas.xl.co.id/apply/validateMsisdn?msisdn='.$number.'&type=REACTIVATION&typeNumber=XL Axis'
		);

		return json_decode($res->getBody(), true);
	}
}