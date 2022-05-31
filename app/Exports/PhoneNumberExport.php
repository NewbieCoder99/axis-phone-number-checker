<?php

namespace App\Exports;

use App\Models\ {
	PhoneNumber
};
use Maatwebsite\Excel\ {
	Excel,
	Concerns\FromCollection,
	Concerns\Exportable,
	Concerns\FromView,
	Concerns\WithEvents
};
use PhpOffice\PhpSpreadsheet\Worksheet\ {
	Drawing,
	PageSetup
};
use Maatwebsite\Excel\Events\ {
	BeforeExport,
	BeforeWriting,
	BeforeSheet,
	AfterSheet
};
use PhpOffice\PhpSpreadsheet\Style\ {
	Border,
	NumberFormat,
	Alignment,
	Fill,
	Color
};

class PhoneNumberExport implements WithEvents
{

	use Exportable;

	public $data;

	public function __construct($data)
	{
		$this->data = $data;
	}

	/**
	* @return array
	*/
	public function registerEvents(): array
	{
		return [
			AfterSheet::class => function(AfterSheet $set) {

				$sheet = $set->sheet;
				$sheet->getColumnDimension('A')->setWidth(6);
				$sheet->getColumnDimension('B')->setWidth(25);
				$sheet->getColumnDimension('C')->setWidth(30);
				$sheet->getColumnDimension('D')->setWidth(30);
				$sheet->getColumnDimension('E')->setWidth(30);
				$sheet->getColumnDimension('F')->setWidth(30);

				$sheet->setCellValue('A1', 'No.');
				$sheet->setCellValue('B1', 'NAMA');
				$sheet->setCellValue('C1', 'NIK');
				$sheet->setCellValue('D1', 'EMAIL');
				$sheet->setCellValue('E1', 'NOMOR HP');
				$sheet->setCellValue('F1', 'MASA AKTIF KARTU');

				$column = 2;
				$number = 1;
				foreach ($this->data as $n => $row) {

					$sheet->setCellValue('A'.$column, $number);
					$sheet->setCellValue('B'.$column, $row->name);
					$sheet->setCellValue('C'.$column, $row->nik);
					$sheet->setCellValue('D'.$column, $row->email);
					$sheet->setCellValue('E'.$column, $row->number);
					$sheet->setCellValue('F'.$column, $row->expired_date);

					$column++;
					$number++;
				}
			}
		];
	}

}
