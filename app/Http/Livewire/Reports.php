<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\User;
use App\Models\Sale;
use App\Models\SaleDetails;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class Reports extends Component
{
    public $componentName, $data, $details, $sumDetails, $countDetails, $reportType, $userId, $dateFrom, $dateTo, $saleId, $sale;

    public function mount()
    {
        $this->componentName='Reportes de Ventas';
        $this->data =[];
        $this->details =[];
        $this->sumDetails =0;
        $this->countDetails =0;
        $this->reportType =0;
        $this->userId =0;
        $this->saleId =0;
    }
    public function render()
    {
        $this->SalesByDate();
        return view('livewire.reports.component',[
            'users' => User::orderBy('name','asc')->get()
        ])->extends('layouts.theme.app')
        ->section('content');
    }

    protected $listeners = [
        'cancelSale' => 'cancelSale'
    ];

    public function SalesByDate()
    {
        if($this->reportType == 0) //ventas del dia
        {
            $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59';
        }else{
            $from = Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($this->dateTo)->format('Y-m-d') . ' 23:59:59';
        }

        if($this->reportType == 1 && ($this->dateFrom == '' || $this->dateTo =='')){
            return;
        }
        if($this->userId == 0)
        {
            $this->data =Sale::join('users as u', 'u.id', 'sales.user_id')
            ->select('sales.*','u.name as user')
            ->whereBetween('sales.created_at',[$from, $to])
            ->orderBy('sales.id','asc')
            ->get();
        }else{
            $this->data =Sale::join('users as u', 'u.id', 'sales.user_id')
            ->select('sales.*','u.name as user')
            ->whereBetween('sales.create_at',[$from, $to])
            ->where('user_id', $this->userId)
            ->orderBy('sales.id','asc')
            ->get();
        }
    }

    public function getDetails($saleId)
    {
        $this->details = SaleDetails::join('products as p','p.id','sale_details.product_id')
        ->select('sale_details.id','sale_details.price', 'sale_details.quantity','p.name as product')
        ->where('sale_details.sale_id' , $saleId)
        ->get();

         $suma = $this->details->sum(function($item){
             return $item->price * $item->quantity;
         });

        $this->sumDetails = $suma;

        $this->countDetails = $this->details->sum('quantity');
        $this->saleId = $saleId;

        $this->emit('show-modal', 'details loaded');
    }

        public function cancelSale($saleId)
    {
        $detalles = SaleDetails::where('sale_id',$saleId)->get();
        foreach($detalles as $detalle){
            $producto = Product::where('id',$detalle->product_id)->first();
            $producto->stock+=$detalle->quantity;
            $producto->save();
        }
            $venta = Sale::where('id',$saleId)->first();
            $venta->status="Cancelado";
            Logs::logs('Revertir',"Id: $venta->id",'Ventas');
            $this->emit('sale-revertir', 'Venta Revertida');
            return $venta->save();
    }
}
