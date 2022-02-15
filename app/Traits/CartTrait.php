<?php

namespace App\Traits;

trait CartTrait{

    // recibe el codigo de barra escaneado y lo agrega al carrito
    public function ScanearCode($barcode, $cant = 1)
    {
        $product = Product::where('barcode', $barcode)->first();

        // if($product == null || empty($empty))
        if($product == null || empty($product))
        {
            $this->emit('scan-notfound','El producto no esta registrado *');
        } else {
            //actualiza la cantidad si el producto ya existe
            if($this->InCart($product->id))
            {
                $this->increaseQty($product->id);
                return;
            }

            if($product->stock < 1)
            {
                $this->emit('no-stock','Stock Insuficiente :/ *');
                return;
            }

            Cart::add($product->id, $product->name, $product->price, $cant, $product->image);
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('scan-ok','Producto Agregado');
        }
    }

}