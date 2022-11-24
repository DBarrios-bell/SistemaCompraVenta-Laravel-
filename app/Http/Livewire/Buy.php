<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\Product;
use App\Models\Shopping;
use App\Models\ShoppingDetails;
use App\Models\Denomination;
use App\Models\Provider;
use App\Models\Stock;
use DB;

class Buy extends Component
{

    public $total, $itemsQuantity, $efectivo, $change, $cant, $provider_id, $session;

    // inicializa las propiedades en 0
    public function mount(){
        $this->efectivo =0;
        $this->change = 0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->provider_id = '0';
        $this->session = session("ptventa");
    }

    public function render()
    {
        return view('livewire.shopping.shopping', [
            'denominations' => Denomination::orderBy('value','desc')->get(),
            'cart' => Cart::getContent()->sortBy('name'),
            'providers' => Provider::orderBy('name', 'asc')->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    // calculo del cambio
    public function ACash($value)
    {
        $this->efectivo += ($value == 0 ? $this->total : $value);
        $this->change = ($this->efectivo - $this->total);
    }

    //calcula el cambio presionando tab desde la caja de efectivo
    public function AChange(){
        $this->change = ($this->efectivo - $this->total);
    }

     // capturar los eventos enviados desde el front
    protected $listeners = [
        'scan-code' => 'ScanCode',
        'removeItem' => 'removeItem',
        'clearCart' => 'clearCart',
        'shoppingSale' => 'shoppingSale',
        'refresh' => '$refresh',
        // 'print-last' => 'printLast'
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
    public function saveShopping()
    {
        if($this->total <= 0)
        {
            $this->emit('sale-error','Agrega productos a la compra');
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
        if($this->provider_id <= 0){
            $this->emit('sale-error', 'Seleccione un Proveedor');
            return;
        }

        DB::beginTransaction();
        try{
            $shopping = Shopping::create([
                'total' => $this->total,
                'items' => $this->itemsQuantity,
                'cash' => $this->efectivo,
                'change' => $this->change,
                'user_id' => Auth()->user()->id,
                'provider_id' => $this->provider_id,
                'salepoint_id' => $this->session,

            ]);
            if($shopping)
            {
                $items = Cart::getContent();
                foreach($items as $item){
                    ShoppingDetails::create([
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                        'product_id' => $item->id,
                        'shopping_id' => $shopping->id,
                    ]);

                    $cant = Stock::Where('product_id', $item->id)
                            ->where('salepoint_id', $this->session)->first();

                    if($cant == null || empty($cant)){
                        Stock::create([
                            'product_id' => $item->id,
                            'salepoint_id' => $this->session,
                            'quantity' => $item->quantity,
                        ]);
                    }else{
                    $cant->quantity = $cant->quantity + $item->quantity;
                    // update stock
                    // $product = Product::find($item->id);
                    // $product->stock = $product->stock + $item->quantity;
                    $cant->save();
                    // return dd($stock);
                    }
                }
            }

            DB::commit();

            Cart::clear();
            $this->efectivo =0;
            $this->change =0;
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->provider_id = 'Elegir';
            $this->emit('buy-ok','Se Registro su Compra');
            Logs::logs('Crear',"Id: {$shopping->id}",'Compra');
            // $this->emit('print-ticket',$sale->id);


        }catch(exception $e){
            DB::rollback();
            $this->emit('sale-error', $e->getMessage());

        }
    }
}
