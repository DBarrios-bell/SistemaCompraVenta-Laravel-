<?php

namespace App\Http\Controllers;

use App\Exports\SalesExport;
use App\Exports\ShoppingsExport;
use App\Models\Sale;
use App\Models\Shopping;
use App\Models\User;
use Barryvdh\DomPDF\facade as PDF;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function reportPDFVentas($userId, $reportType, $dateFrom = null, $dateTo = null)
    {
        $data = [];

        if($reportType == 0) //ventas del dia
        {
            $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59';
        }else{
            $from = Carbon::parse($dateFrom)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($dateTo)->format('Y-m-d') . ' 23:59:59';
        }

        if($userId == 0)
        {
            $data =Sale::join('users as u', 'u.id', 'sales.user_id')
            ->select('sales.*','u.name as user')
            ->whereBetween('sales.created_at',[$from, $to])
            ->orderBy('sales.id','asc')
            ->get();
        }else{
            $data =Sale::join('users as u', 'u.id', 'sales.user_id')
            ->select('sales.*','u.name as user')
            ->whereBetween('sales.created_at',[$from, $to])
            ->where('user_id', $userId)
            ->orderBy('sales.id','asc')
            ->get();
        }

        $user = $userId == 0 ? 'Todos' : User::find($userId)->name;
        $pdf = PDF::loadView('pdf.reporte', compact('data','reportType','user','dateFrom','dateTo'));

        return $pdf->stream('salesReport.pdf'); //visualizar
        return $pdf->download('salesReport.pdf'); //descargar
    }

    public function reportPDFCompras($userId, $reportType, $dateFrom = null, $dateTo = null)
    {
        $info = [];

        if($reportType == 0) //ventas del dia
        {
            $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59';
        }else{
            $from = Carbon::parse($dateFrom)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($dateTo)->format('Y-m-d') . ' 23:59:59';
        }

        if($userId == 0)
        {
            $info =Shopping::join('users as u', 'u.id', 'shoppings.user_id')
            ->select('shoppings.*','u.name as user')
            ->whereBetween('shoppings.created_at',[$from, $to])
            ->orderBy('shoppings.id','asc')
            ->get();
        }else{
            $info =Shopping::join('users as u', 'u.id', 'shoppings.user_id')
            ->select('shoppings.*','u.name as user')
            ->whereBetween('shoppings.created_at',[$from, $to])
            ->where('user_id', $userId)
            ->orderBy('shoppings.id','asc')
            ->get();
        }

        $user = $userId == 0 ? 'Todos' : User::find($userId)->name;
        $pdf = PDF::loadView('pdf.reporteCompra', compact('info','reportType','user','dateFrom','dateTo'));

        return $pdf->stream('buyReport.pdf'); //visualizar
        // return $pdf->download('buyReport.pdf'); //descargar
    }


    public function reporteExcel($userId, $reportType, $dateFrom = null, $dateTo = null)
    {
        $reportName = 'Reporte de Ventas_' . uniqid() . '.xlsx';
        return Excel::download(new SalesExport($userId, $reportType, $dateFrom, $dateTo), $reportName);
    }

    public function reporteExcelShoppings($userId, $reportType, $dateFrom = null, $dateTo = null)
    {
        $reportNameCompras = 'Reporte de Compras_' . uniqid() . '.xlsx';
        return Excel::download(new ShoppingsExport($userId, $reportType, $dateFrom, $dateTo), $reportNameCompras);
    }
}
