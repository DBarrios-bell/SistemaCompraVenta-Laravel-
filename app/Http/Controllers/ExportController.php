<?php

namespace App\Http\Controllers;

use App\Exports\SalesExport;
use App\Models\Sale;
use App\Models\SaleDetails;
use App\Models\User;
use Barryvdh\DomPDF\facade as PDF;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function reportPDF($userId, $reportType, $dateFrom = null, $dateTo = null)
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
            ->get();
        }else{
            $data =Sale::join('users as u', 'u.id', 'sales.user_id')
            ->select('sales.*','u.name as user')
            ->whereBetween('sales.create_at',[$from, $to])
            ->where('user_id', $userId)
            ->get();
        }

        $user = $userId == 0 ? 'Todos' : User::find($userId)->name;
        $pdf = PDF::loadView('pdf.reporte', compact('data','reportType','user','dateFrom','dateTo'));

        return $pdf->stream('salesReport.pdf'); //visualizar
        return $pdf->download('salesReport.pdf'); //descargar
    }


    public function reporteExcel($userId, $reportType, $dateFrom = null, $dateTo = null)
    {
        $reportName = 'Reporte de Ventas_' . uniqid() . '.xlsx';
        return Excel::download(new SalesExport($userId, $reportType, $dateFrom, $dateTo), $reportName);
    }
}
