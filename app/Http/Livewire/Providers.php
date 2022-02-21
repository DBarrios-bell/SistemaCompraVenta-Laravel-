<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Provider;
use Livewire\WithPagination;

class Providers extends Component
{

    use WithPagination;

    public $name, $nit, $email, $phone, $status, $search, $selected_id, $pageTitle, $componentName;
    private $pagination = 5;

    public function PaginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Proveedores';
        $this->status = 'Elegir';
    }

    public function render()
    {
         if(strlen($this->search)>0)
            $providers = Provider::where('name', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        else
            $providers = Provider::orderBy('name','asc')->paginate($this->pagination);

        return view('livewire.provider.providers', [
            'providers' => $providers
            ])
            ->extends('layouts.theme.app')
            ->section('content');
        }

    public function resetUI()
    {
        $this->name = '';
        $this->nit = '';
        $this->phone = '';
        $this->email = '';
        $this->status = '';
        $this->status ='Elegir';
        $this->selected_id =0;
        $this->resetValidation();
        $this->resetPage();
    }

    public function Store()
    {
        $rules = [
            'name' => 'required|min:5|unique:providers,name',
            'nit' => 'required|min:7|unique:providers,nit',
            'phone' => 'required|min:10|max:10|unique:providers,phone',
            'email' => 'required|min:10|unique:providers,email',
            'status' => 'required|not_in:Elegir'
        ];
        $messages = [
            'name.required' => 'El nombre del proveedor es requerido',
            'name.unique' => 'El rol ya existe',
            'name.min' => 'El nombre Rol min. 5 caracteres',
            'nit.required' => 'El nit es Requerido',
            'nit.min' => 'El Nit min. 7 caracteres',
            'nit.unique' => 'El Nit ya existe',
            'phone.required' => 'El telefono es requerido',
            'phone.min' => 'Minimo 10 Caracteres',
            'phone.max' => 'Maximo 10 Caracteres',
            'phone.unique' => 'El telefono ya existe',
            'email.required' => 'La direccion de Correo Electronico es requerido',
            'email.min' => 'Minimo 10 caracteres',
            'email.unique' => 'El correo esta relacionado a otro proveedor',
            'status.required' => 'Seleccione el estado',
            'status.not_in' => 'Seleccione el estado',
        ];

        $this->validate($rules, $messages);

        $provider = Provider::create([
            'name' => $this->name,
            'nit' => $this->nit,
            'phone' => $this->phone,
            'email' => $this->email,
            'status' => $this->status
        ]);

        $provider->save();
        $this->emit('role-added', 'Se registro el rol con exito');
        $this->resetUI();
    }

}
