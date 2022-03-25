<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Shopping;
use App\Models\ShoppingDetails;
use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportsBuy extends Component
{

    public $componentName, $info, $details, $sumDetails, $countDetails, $reportType, $userId, $dateFrom, $dateTo,
    $buyId, $buy;

    public function mount()
    {
        $this->componentName='Reportes de Compras';
        $this->info =[];
        $this->details =[];
        $this->sumDetails =0;
        $this->countDetails =0;
        $this->reportType =0;
        $this->userId =0;
        $this->buyId =0;
    }
    public function render()
    {
        return view('livewire.reporteShopping.reports-buy',[
            'users' => User::orderBy('name','asc')->get()
        ])->extends('layouts.theme.app')
        ->section('content');
    }

    protected $listeners = [
        'cancelBuy' => 'cancelBuy'
    ];

    public function BuyByDate()
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
            $this->info =Shopping::join('users as u', 'u.id', 'shoppings.user_id')
            ->select('shoppings.*','u.name as user')
            ->whereBetween('shoppings.created_at',[$from, $to])
            ->orderBy('shoppings.created_at','asc')
            ->get();
        }else{
            $this->info =Shopping::join('users as u', 'u.id', 'shoppings.user_id')
            ->select('shoppings.*','u.name as user')
            ->whereBetween('shoppings.create_at',[$from, $to])
            ->where('user_id', $this->userId)
            ->orderBy('shoppings.created_at','asc')
            ->get();
        }
    }

    public function getDetails($buyId)
    {
        $this->details = ShoppingDetails::join('products as p','p.id','shopping_details.product_id')
        ->select('shopping_details.id','shopping_details.price', 'shopping_details.quantity','p.name as product')
        ->where('shopping_details.shopping_id' , $buyId)
        ->get();

        $suma = $this->details->sum(function($item){
        return $item->price * $item->quantity;
        });

        $this->sumDetails = $suma;

        $this->countDetails = $this->details->sum('quantity');
        $this->buyId = $buyId;

        $this->emit('show-modal', 'details loaded');
    }

    public function cancelBuy($buyId)
    {
        DB::beginTransaction();

        $detalles = ShoppingDetails::where('shopping_id',$buyId)->get();
        foreach($detalles as $detalle){
            $producto = Product::where('id',$detalle->product_id)->first();
            if($detalle->quantity <= $producto->stock){
                $producto->stock -= $detalle->quantity;
                $producto->save();
            }else{
                DB::rollBack();
                return $this->emit('buy-revertir', 'La Compra No Puede Ser Revertida, No Existen Cantidades Suficiente En
                El Stock');
            }
        }
        $buy = Shopping::where('id',$buyId)->first();
        $buy->status="Cancelado";
        Logs::logs('Revertir',"Id: $buy->id",'Compra');
        $this->emit('buy-revertir', 'Compra Revertida');
        $buy->save();
        DB::commit();
    }
}
