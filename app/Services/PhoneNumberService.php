<?php

namespace App\Services;

use App\Models\PhoneNumber;

class PhoneNumberService
{

	public function model() : Object
	{
		return new PhoneNumber;
	}

	public function all($request)
	{
		$data = $this->model()->select('*');

		if(!empty($request->number)) {
			$data->where('number','like', $request->number.'%');
		}

		if(!empty($request->status)) {
			$data->where('status', $request->status);
		}

		if(!empty($request->name)) {
			$data->where('name','like', '%'.$request->name.'%');
		}

		if(!empty($request->nik)) {
			$data->where('nik','like', $request->nik.'%');
		}

		if(!empty($request->email)) {
			$data->where('email','like', $request->email.'%');
		}

		if(!empty($request->expired_date)) {
			$data->whereDate('expired_date', $request->expired_date);
		}

		if(!empty($request->created_at)) {
			$data->whereDate('created_at', $request->created_at);
		}

        return $data->get();
	}

	public function datatable($request)
	{

		$data = $this->model()->select('*');

		if(!empty($request['number'])) {
			$data->where('number','like', $request['number'].'%');
		}

		if(!empty($request['status'])) {
			$data->where('status', $request['status']);
		}

		if(!empty($request['name'])) {
			$data->where('name','like', '%'.$request['name'].'%');
		}

		if(!empty($request['nik'])) {
			$data->where('nik','like', $request['nik'].'%');
		}

		if(!empty($request['email'])) {
			$data->where('email','like', $request['email'].'%');
		}

		if(!empty($request['expired_date'])) {
			$data->whereDate('expired_date', $request['expired_date']);
		}

		if(!empty($request['created_at'])) {
			$data->whereDate('created_at', $request['created_at']);
		}

        if ($request['isCounter']) {
            return $data->count();
        }

        return $data->latest()->skip($request['start'])->take($request['length'])->get();
	}

	public function find($id)
	{
		return $this->model()->find($id);
	}

	public function update($request, $id)
	{
		$data = $this->find($id);
		if($data) {
			$data->update([
				'name' => $request->name,
				'email' => $request->email,
				'nik' => $request->nik,
				'number' => $request->number,
				'status' => $request->status,
				'expired_date' => $request->expired_date,
			]);
		}

		return [
			'error' => false,
			'message' => 'Data has been updated.',
			'data' => $data
		];
	}

	public function destroy($id)
	{
		$data = $this->find($id);

		if($data) {
			$data->delete();
		}

		return [
			'error' => false,
			'message' => 'Data has been deleted.',
			'data' => []
		];
	}

}