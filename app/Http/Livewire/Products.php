<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\ShoppingDetails;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;


class Products extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $name, $barcode, $cost, $price, $stock, $alerts, $categoryid, $search, $image, $selected_id, $pageTitle, $componentName;
    private $pagination = 30;

    //paginacion
    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Productos';
        $this->categoryid = 'Elegir';
    }

    public function cleanValue($value)
    {
        return number_format(str_replace(",","",$value),2, '.','');
    }


    public function render()
    {
        if(strlen($this->search) > 0)
            $products = Product::join('categories as c' , 'c.id', 'products.category_id')
                        ->select('products.*','c.name as category')
                        ->where('products.name', 'like','%'. $this->search . '%')
                        ->orwhere('products.barcode', 'like', '%'. $this->search . '%' )
                        ->orwhere('c.name','like','%' . $this->search . '%')
                        ->orderBy('products.stock', 'asc')
                        ->paginate($this->pagination);
        else
            $products = Product::join('categories as c' , 'c.id', 'products.category_id')
                        ->select('products.*','c.name as category')
                        ->orderBy('products.stock', 'asc')
                        ->paginate($this->pagination);

        return view('livewire.products.component',[
            'data' => $products,
            'categories' => Category::orderBy('name', 'asc')->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }


    public function Store(){
        $rules = [
            'name' => 'required|unique:products|min:3',
            'cost' => 'required',
            'price' => 'required',
            'barcode' => 'required|unique:products',
            'alerts' => 'required',
            'categoryid' => 'required|not_in:Elegir',
        ];
        $messages =[
            'name.required' => 'Nombre del producto requerido',
            'name.unique' => 'Ya existe el nombre del producto',
            'mane.min' => 'El nombre debe tener minino 3 caracteres',
            'cost.required' => 'El costo es requerido',
            'price.required' => 'El precio es requerido',
            'barcode.required' => 'Campo Obligatori',
            'barcode.unique' => 'Ya existe el codigo',
            'alerts.required' => 'Ingresa el valor minimo en existencias',
            'categoryid.not_in' => 'Elige un nombre de categoria diferente a Elegir',
        ];
        $this->validate($rules, $messages);


        $product = Product::create([
            'name' => $this->name,
            'cost' => $this->cleanValue($this->cost),
            'price' => $this->cleanValue($this->price),
            'barcode' => $this->barcode,
            'stock' => 0,
            'alerts' => $this->alerts,
            'category_id' => $this->categoryid
        ]);

        // $customFileName;
        if($this->image){
            $customFileName = uniqid() . '_.' . $this->image->extension(); //para personalizar nombre del archivo
            $this->image->storeAs('public/products', $customFileName);
            $product->image = $customFileName;
            $product->save();
        }
        Logs::logs('Crear',"Id: {$product->id} - nombre: {$product->name}", $this->componentName);
        $this->resetUI();
        $this->emit('product-added', 'Producto Registrado');
    }

    public function Edit(Product $product){
            $this->selected_id = $product->id;
            $this->name = $product->name;
            $this->barcode = $product->barcode;
            $this->cost = $product->cost;
            $this->price = $product->price;
            // $this->stock = $product->stock;
            $this->alerts = $product->alerts;
            $this->categoryid = $product->category_id;
            $this->image = null;

            $this->emit('show-modal', 'show modal!');
    }


    public function Update(){
        $rules = [
            'name' => "required|min:3|unique:products,name,{$this->selected_id}",
            'cost' => 'required',
            'price' => 'required',
            // 'stock' => 'required',
            'alerts' => 'required',
            'categoryid' => 'required|not_in:Elegir',
        ];
        $messages =[
            'name.required' => 'Nombre del producto requerido',
            'name.min' => 'El nombre debe tener minino 3 caracteres',
            'name.unique' => 'El nombre ya existe',
            'cost.required' => 'El costo es requerido',
            'price.required' => 'El precio es requerido',
            // 'stock.required' => 'El stock es requerido',
            'alerts.required' => 'Ingresa el valor minimo en existencias',
            'categoryid.not_in' => 'Elige un nombre de categoria diferente a Elegir',
        ];
        $this->validate($rules, $messages);

        $product =Product::find($this->selected_id);

        $product->update([
            'name' => $this->name,
            'cost' => $this->cleanValue($this->cost),
            'price' => $this->cleanValue($this->price),
            'barcode' => $this->barcode,
            // 'stock' => $this->stock,
            'alerts' => $this->alerts,
            'category_id' => $this->categoryid
        ]);

        if($this->image){
            $customFileName = uniqid() . '_.' . $this->image->extension(); //para personalizar nombre del archivo
            $this->image->storeAs('public/products', $customFileName);
            $imageTemp = $product->image; //imagen temporal
            $product->image = $customFileName;
            $product->save();

            if($imageTemp != null){
                if(file_exists('storage/products/' . $imageTemp)){
                    unlink('storage/products/' . $imageTemp);
                }
            }
        }
        Logs::logs('Editar',"Id: {$product->id} - nombre: {$product->name}", $this->componentName);
        $this->resetUI();
        $this->emit('product-updated', 'Producto Actualizado');
    }


    public function resetUI(){
        $this->name ='';
        $this->barcode ='';
        $this->cost ='';
        $this->price ='';
        $this->stock ='';
        $this->alerts ='';
        $this->search ='';
        $this->categoryid ='Elegir';
        $this->image = null;
        $this->selected_id =0;
    }

    protected $listeners =['deleteRow' => 'Destroy'];

    public function Destroy(Product $product){

        if($product){
            $shopping = ShoppingDetails::where('product_id' , $product->id)->count();
            if($shopping > 0){
                $this->emit('product-withshopping', 'No Se Puede Eliminar Tiene Movimientos');
            }else{
                $imageTemp = $product->image;
                $product->delete();
                    if($imageTemp != null){
                        if(file_exists('storage/products/' . $imageTemp)){
                        unlink('storage/products/' . $imageTemp);
                        }
                    }
                Logs::logs('Eliminar',"Id: {$product->id} - nombre: {$product->name}", $this->componentName);
                $this->resetUI();
                $this->emit('product-deleted', 'Producto Eliminado :/');
            }
        }
    }
}
