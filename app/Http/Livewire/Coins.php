<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Denomination;
use Illuminate\Support\Facades\Storage; //uso de img
use Livewire\WithFileUploads;  //trait para cargue de img livewire
use Livewire\WithPagination;
use RealRashid\SweetAlert\Facades\Alert;


class Coins extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $type, $value, $search, $image, $selected_id, $pageTitle, $componentName;
    private $pagination = 5;

    // protected $queryString = ['search'];


    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Denominaciones';
        $this->type = 'Elegir';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
           $data = Denomination::where('type', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        else
            $data = Denomination::orderBy('value', 'asc')->paginate($this->pagination);

            return view('livewire.denominations.component', ['data' => $data])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function Edit($id){
        $record = Denomination::find($id, ['id','type','value','image']);
        $this->type = $record->type;
        $this->value = $record->value;
        $this->selected_id = $record->id;
        $this->image = null;

        $this->emit('show-modal', 'show modal!');

    }

    public function Store(){
        $rules =[
            'type' => 'required|not_in:Elegir',
            'value' => 'required|unique:denominations'
        ];
        $messages =[
            'type.required' => 'El tipo es requerido',
            'type.not_in' => 'Elige un valor para el tipo diferente a Elegir',
            'value.required' =>  'El valor es requerido',
            'value.unique' =>  'ya existe el valor',
        ];

        $this->validate($rules, $messages);

        $denomination = Denomination::create([
            'type' => $this->type,
            'value' => $this->value
        ]);

        if($this->image)
        {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/denominations', $customFileName);
            $denomination->image = $customFileName;
            $denomination->save();
        }
        Logs::logs('Crear',"Id: {$denomination->id} - nombre: {$denomination->name}", $this->componentName);
        $this->resetUI();
        $this->emit('item-added', 'Denominacion Registrada');
    }

    public function Update(){
        $rules =[
            'type' => 'required|not_in:Elegir',
            'value' => "required|unique:denominations,value,{$this->selected_id}"
        ];
        $messages =[
            'type.required' => 'El tipo es requerido',
            'type.not_in' => 'Elige un tipo valido',
            'value.required' => 'El valor es requerido',
            'value.unico' => 'El valor ya existe',
        ];
        $this->validate($rules, $messages);

        $denomination = Denomination::find($this->selected_id);
        $denomination->update([
            'type' => $this->type,
            'value' => $this->value
        ]);
        if($this->image){
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/denominations', $customFileName);
            $imageName = $denomination->image;
            $denomination->image = $customFileName;
            $denomination->save();

            if($imageName !=null){
                if(file_exists('storage/denominations' . $imageName)){
                    unlink('storage/denominations' . $imageName);
                }
            }
        }
        Logs::logs('Editar',"Id: {$denomination->id} - nombre: {$denomination->name}", $this->componentName);
        $this->resetUI();
        $this->emit('item-updated', 'Denominacion Actualizada');
    }

    public function resetUI(){
        $this->type = '';
        $this->value = '';
        $this->image = null;
        $this->search ='';
        $this->selected_id=0;
    }
    protected $listeners =[
        'deleteRow' => 'Destroy'
    ];

    public function Destroy(Denomination $denomination){
        // $denomination = Denomination::find($denomination);

        $imageName = $denomination->image;
        $denomination->delete();

        if($imageName !=null){
            unlink('storage/denominations/' .$imageName);
        }
        Logs::logs('Eliminar',"Id: {$denomination->id} - nombre: {$denomination->name}", $this->componentName);
        $this->resetUI();
        $this->emit('item-deleted', 'Denominacion Eliminada');
    }
}

