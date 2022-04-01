<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetails;
use App\Models\Denomination;
use DB;

class Pos extends Component
{
    public $total, $itemsQuantity, $efectivo, $change, $cant;

    // inicializa las propiedades en 0
    public function mount(){
        $this->efectivo =0;
        $this->change = 0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

    }

    public function render()
    {
        return view('livewire.pos.component',[
            'denominations' => Denomination::orderBy('value','desc')->get(),
            'cart' => Cart::getContent()->sortBy('name')
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    // calculo del cambio y el efectivo
    public function ACash($value)
    {
        $this->efectivo += ($value == 0 ? $this->total : $value);
        $this->change = ($this->efectivo - $this->total);
    }
    //calcula el cambio presionando tab desde la caja de efectivo
    public function AChange(){
        $this->change = ($this->efectivo - $this->total);
    }

        // capturar los eventos enviados desde el fron
    protected $listeners = [
        'scan-code' => 'ScanCode',
        'removeItem' => 'removeItem',
        'clearCart' => 'clearCart',
        'saveSale' => 'saveSale',
        'refresh' => '$refresh',
        'print-last' => 'printLast'
    ];

        // recibe el codigo de barra escaneado y lo agrega al carrito
    public function ScanCode($barcode, $cant = 1)
    {
        $product = Product::where('barcode', $barcode)->first();

        // if($product == null || empty($empty))
        if($product == null || empty($product))
        {
            $this->emit('scan-notfound','El producto no esta registrado');
        } else {
            //actualiza la cantidad si el producto ya existe
            if($this->InCart($product->id))
            {
                $this->increaseQty($product->id);
                return;
            }

            if($product->stock < 1)
            {
                $this->emit('no-stock','Stock Insuficiente :/');
                return;
            }

            Cart::add($product->id, $product->name, $product->price, $cant); // agregar , $product->image
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('scan-ok','Producto Agregado');
        }
    }

    // valida si el ID del producto ya existe en el carrito
    public function InCart($productId)
    {
        $exist = Cart::get($productId);
        if($exist)
            return true;
        else
            return false;
    }

    // actualiza la cantidad de existencia del producto en el carrito
    public function increaseQty($productId, $cant = 1)
    {
        $title='';
        $product = Product::find($productId);
        $exist = Cart::get($productId);
        if($exist)
            $title ='Cantidad Actualizada';
        else
            $title = 'Producto Agregado';

        if($exist)
        {
            if($product->stock < ($cant + $exist->quantity))
            {
                $this->emit('no-stock','Stock Insuficiente :/');
                return;
            }
        }

        Cart::add($product->id, $product->name, $product->price, $cant); //agregar $product->image
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

         $this->emit('scan-ok', $title);
    }

    // reemplaza la informacion del producto dentro del carrito
    public function updateQty($productId, $cant = 1)
    {
        $title='';
        $product = Product::find($productId);
        $exist = Cart::get($productId);
        if($exist)
            $title ='Cantidad Actualizada';
        else
            $title = 'Producto Agregado';

        if($exist)
        {
            if($product->stock < $cant)
            {
                $this->emit('no-stock','Stock Insuficiente :/');
                return;
            }
        }
        $this->removeItem($productId);

        if($cant > 0)
        {
            Cart::add($product->id, $product->name, $product->price, $cant, $product->image);
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('scan-ok', $title);
        }
    }

    // elimina el item(producto) del carrito
    public function removeItem($productId)
    {
        Cart::remove($productId);
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('scan-ok', 'Producto Eliminado');
    }

    // disminuya la cantidad
    public function decreaseQty($id)
    {
        $item = Cart::get($id);
        Cart::remove($id);

        // $img = (count($item->attributes)> 0 ? $item->attributes[0] : Product::find($id)->imagen);

        $newQty = ($item->quantity) - 1;
        if($newQty > 0)
            Cart::add($item->id, $item->name, $item->price, $newQty); //agregar $img

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('scan-ok', 'Cantidad Actualizada');
    }


    // limpiar el carrito
    public function clearCart()
    {
        Cart::clear();
        $this->efectivo =0;
        $this->change =0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', 'Carrito Vacio');
    }


    // guardar ventas
    public function saveSale()
    {
        if($this->total <= 0)
        {
            $this->emit('sale-error','Agrega productos a la venta');
            return;
        }
        if($this->efectivo <= 0)
        {
            $this->emit('sale-error','Ingresa el efectivo');
            return;
        }
        if($this->total > $this->efectivo)
        {
            $this->emit('sale-error','El efectivo debe ser mayor o igual al total');
            return;
        }

        DB::beginTransaction();
        try{
            $sale = Sale::create([
                'total' => $this->total,
                'items' => $this->itemsQuantity,
                'cash' => $this->efectivo,
                'change' => $this->change,
                'user_id' => Auth()->user()->id
            ]);
            if($sale)
            {
                $items = Cart::getContent();
                foreach($items as $item){
                    SaleDetails::create([
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                        'product_id' => $item->id,
                        'sale_id' => $sale->id,
                    ]);
                    // update stock
                    $product = Product::find($item->id);
                    $product->stock = $product->stock - $item->quantity;
                    $product->save();
                }
            }

            DB::commit();

            Cart::clear();
            $this->efectivo =0;
            $this->change =0;
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            Logs::logs('Crear',"Id: $sale->id", 'Ventas');
            $this->emit('sale-ok','Venta Resgistrada');
            $this->emit('print-ticket',$sale->id);


        }catch(exception $e){
            DB::rollback();
            $this->emit('sale-error', $e->getMessage());

        }
    }

    // imprimir ticket
    public function printTicket($sale)
    {
        return Redirect::to("print://$sale->id");
    }
}
