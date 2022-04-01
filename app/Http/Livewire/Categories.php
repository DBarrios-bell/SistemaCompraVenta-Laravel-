<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; //uso de img
use Livewire\WithFileUploads;  //trait para cargue de img livewire
use Livewire\WithPagination;
use RealRashid\SweetAlert\Facades\Alert;


class Categories extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $name, $search, $image, $selected_id, $pageTitle, $componentName, $session;
    private $pagination = 5;


    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Categorias';
        $this->session = session("ptventa");
    }

    //paginacion personalizada
    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
           $data = Category::where('name', 'like', '%' . $this->search . '%')->paginate($this->pagination);
            // $data = Category::search('name' , 'like');
         else
        $data = Category::where('salepoint_id', $this->session)->orderBy('id', 'desc')
        ->paginate($this->pagination);
        return view('livewire.category.categories', ['categories' => $data])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Edit($id){
        $record = Category::find($id, ['id','name','image']);
        $this->name = $record->name;
        $this->selected_id = $record->id;
        $this->image = null;

        $this->emit('show-modal', 'show modal!');

    }

    public function Store(){
        $rules =[
            'name' => 'required|unique:categories|min:3'
        ];
        $messages =[
            'name.required' => 'Nombre de la categoria es requerido',
            'name.unique' => 'La categoria ya existe',
            'name.min' => 'El nombre de la categoria debe tener almenos 3 caracteres'
        ];

        $this->validate($rules, $messages);

        $category = Category::create([
            'name' => $this->name,
            // 'Salepoint_id'=> $this->session,
            'pventa_id'=> $this->session,
        ]);

        // $customFileName;
        if($this->image){
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/categories/', $customFileName);
            $category->image = $customFileName;
            $category->save();
        }
        Logs::logs('Crear',"Id: {$category->id} - nombre: {$category->name}",$this->componentName);
        $this->resetUI();
        $this->emit('category-added', 'Categoria Registrada');
    }

    public function Update(){
        $rules =[
            'name' => "required|min:3|unique:categories,name,{$this->selected_id}"
        ];
        $messages =[
            'name.required' => 'Nombre de categoria requerido',
            'name.min' => 'El nombre de categoria debe tener al menos 3 caracteres',
            'name.unique' => 'El nombre de categoria ya existe'
        ];
        $this->validate($rules, $messages);

        $category = Category::find($this->selected_id);
        $category->update([
            'name' => $this->name
        ]);
        if($this->image){
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/categories/', $customFileName);
            $imageName = $category->image;
            $category->image = $customFileName;
            $category->save();

            if($imageName !=null){
                if(file_exists('storage/categories' . $imageName)){
                    unlink('storage/categories' . $imageName);
                }
            }
        }
        Logs::logs('Editar',"Id: {$category->id} - nombre: {$category->name}",$this->componentName);
        $this->resetUI();
        $this->emit('category-added', 'Categoria Actualizada');
    }

    //resetear los campos
    public function resetUI(){
        $this->name = '';
        $this->image = null;
        $this->search ='';
        $this->selected_id=0;
    }


    protected $listeners =[
        'deleteRow' => 'Destroy'
    ];

    public function Destroy(Category $category){
        if($category){
            $shopping = Product::where('category_id' , $category->id)->count();
            if($shopping > 0){
                $this->emit('category-withshopping', 'No Se Puede Eliminar Tiene Movimientos');
            }else{
                $imageTemp = $category->image;
                $category->delete();
                if($imageTemp != null){
                    if(file_exists('storage/categories/' . $imageTemp)){
                        unlink('storage/categories/' . $imageTemp);
                    }
                }
                Logs::logs('Eliminar',"Id: {$category->id} - nombre: {$category->name}", $this->componentName);
                $this->resetUI();
                $this->emit('category-deleted', 'Categoria Eliminada :/');
            }
        }
    }
}