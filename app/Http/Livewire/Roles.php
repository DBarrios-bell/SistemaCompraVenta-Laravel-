<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use App\Models\User;
use DB;

class Roles extends Component
{
    use WithPagination;

    public $roleName, $search, $selected_id, $pageTitle, $componentName;
    private $pagination = 5;

    public function PaginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Roles';
    }

    public function render()
    {
        if(strlen($this->search)>0)
            $roles = Role::where('name', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        else
            $roles = Role::orderBy('name','asc')->paginate($this->pagination);

        return view('livewire.roles.component', [
            'roles' => $roles
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function CreateRole()
    {
        $rules = ['roleName' => 'required|min:2|unique:roles,name'];
        $messages = [
            'roleName.required' => 'El nombre del rol es requerido',
            'roleName.unique' => 'El rol ya existe',
            'roleName.min' => 'El nombre Rol min. 2 caracteres'
        ];

        $this->validate($rules, $messages);

        $role = Role::create(['name' => $this->roleName]);
        $role->save();
        Logs::logs('Crear',"Id: {$role->id} - nombre: {$role->name}", $this->componentName);
        $this->emit('role-added', 'Rol Registrado');
        $this->resetUI();
    }

    public function Edit($id)
    {
        $role = Role::find($id);
        $this->selected_id = $role->id;
        $this->roleName = $role->name;

        // $this->emit('show-modal', 'Show Modal');
        $this->emit('show-modal', 'show modal!');
    }

    public function UpdateRole()
    {
        $rules = ['roleName' => "required|min:2|unique:roles,name,{$this->selected_id}"];
        $messages = [
            'roleName.required' => 'El nombre del rol es requerido',
            'roleName.unique' => 'El rol ya existe',
            'roleName.min' => 'El nombre Rol min. 2 caracteres'
        ];

        $this->validate($rules, $messages);

        $role = Role::find($this->selected_id);
        $role->name = $this->roleName;
        $role->save();
        Logs::logs('Editar',"Id: {$role->id} - nombre: {$role->name}", $this->componentName);
        $this->emit('role-updated', 'Rol Actualizado');
        $this->resetUI();
    }

    protected $listeners = ['deleteRow' => 'Destroy'];


    public function Destroy($id)
    {
        $permissionsCount = Role::find($id)->permissions->count();
        if($permissionsCount > 0)
        {
            $this->emit('role-error', 'Tiene Permisos Asocidado');
            return;
        }
        $role = Role::find($id);
        $role->delete();
        Logs::logs('Eliminar',"Id: {$role->id} - nombre: {$role->name}", $this->componentName);
        $this->emit('role-deleted', 'Rol Eliminado');
    }

    public function resetUI()
    {
        $this->roleName = '';
        $this->search = '';
        $this->selected_id =0;
        $this->resetValidation();
    }
}
