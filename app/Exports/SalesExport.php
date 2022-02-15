<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Carbon\Carbon;


class SalesExport implements FromCollection, WithHeadings, WithCustomStartCell, WithTitle, WithStyles
{

    protected $userId, $dateFrom, $dateTo, $reportType;

    function _construct($userId, $reportType, $f1, $f2){
        $this->userId = $userId;
        $this->reportType = $reportType;
        $this->dateFrom = $f1;
        $this->dateTo = $f2;
    }

    public function collection()
    {
        $data =[];

        if($this->reportType == 1) //ventas del dia
        {
            $from = Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($this->dateTo)->format('Y-m-d') . ' 23:59:59';
        }else{
            $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59';
        }

        if($this->userId == 0)
        {
            $data = Sale::join('users as u', 'u.id', 'sales.user_id')
            ->select('sales.id','sales.total','sales.items','sales.status','sales.created_at','u.name as user')
            ->whereBetween('sales.created_at',[$from, $to])
            ->get();
        }else{
            $data =Sale::join('users as u', 'u.id', 'sales.user_id')
            ->select('sales.id','sales.total','sales.items','sales.status','sales.created_at','u.name as user')
            ->whereBetween('sales.create_at',[$from, $to])
            ->where('user_id', $this->userId)
            ->get();
        }

        return $data;
    }

    // cabeceras del reporte excel
    public function headings():array
    {
        return["FOLIO","IMPORTE","ITEMS","ESTATUS","USUARIO","FECHA"];
    }

    // celda en que iniciara el reporte
    public function startCell(): string
    {
        return 'A2';
    }

    public function styles(Worksheet $sheet)
    {
        // el 2 representa la fila de excel donde se aplica bold = true
        return [
            2 => ['font' => ['bold' => true]],
        ];
    }

    public function title(): string
    {
        return 'Reporte de Ventas';
    }

}
