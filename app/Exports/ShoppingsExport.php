<?php

namespace App\Exports;

use App\Models\Shopping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Carbon\Carbon;


class ShoppingsExport implements FromCollection, WithHeadings, WithCustomStartCell, WithTitle, WithStyles
{

    protected $userId, $dateFrom, $dateTo, $reportType;

    function __construct($userId, $reportType, $f1, $f2){
        $this->userId = $userId;
        $this->reportType = $reportType;
        $this->dateFrom = $f1;
        $this->dateTo = $f2;
    }

    public function collection()
    {
        $info =[];

        if($this->reportType == 1) //Compras por Fecha
        {
            $from = Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($this->dateTo)->format('Y-m-d') . ' 23:59:59';
        }else{
            $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59';
        }

        if($this->userId == 0)
        {
            $info = Shopping::join('users as u', 'u.id', 'shoppings.user_id')
            ->select('shoppings.id','shoppings.total','shoppings.items','shoppings.status','shoppings.created_at','u.name as user')
            ->whereBetween('shoppings.created_at',[$from, $to])
            ->get();

            // $this->info =Shopping::join('users as u', 'u.id', 'shoppings.user_id')
            // ->select('shoppings.*','u.name as user')
            // ->whereBetween('shoppings.created_at',[$from, $to])
            // ->orderBy('shoppings.created_at','asc')
            // ->get();
        }else{
            $info =Shopping::join('users as u', 'u.id', 'shoppings.user_id')
            ->select('shoppings.id','shoppings.total','shoppings.items','shoppings.status','shoppings.created_at','u.name as user')
            ->whereBetween('shoppings.create_at',[$from, $to])
            ->where('user_id', $this->userId)
            ->get();
        }

        return $info;
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
        return 'Reporte de Compras';
    }

}
