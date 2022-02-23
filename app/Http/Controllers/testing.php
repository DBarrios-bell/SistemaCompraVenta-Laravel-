<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetails;
use Illuminate\Http\Request;

class testing extends Controller
{
    // public function revertircompra(){
    //     $id_compra = 7;
    //     $detalles = SaleDetails::where('sale_id',$id_compra)->get();
    //     foreach($detalles as $detalle){
    //         $producto = Product::where('id',$detalle->product_id)->first();
    //         $producto->stock+=$detalle->quantity;
    //         $producto->save();
    //     }
    //     $venta = Sale::where('id',$id_compra)->first();
    //     $venta->status="Cancelado";
    //     return $venta->save();
    // }
}
