<?php

namespace App\Http\Livewire;

use App\Models\Log;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\withFileUploads;
use Livewire\withPagination;
use App\Models\Sale;
use App\Models\Shopping;
use App\Models\User;

class Users extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $name, $phone, $email, $status, $image, $password, $selected_id, $fileLoaded, $profile, $pageTitle, $componentName, $search;
    private $pagination = 5;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

   public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Usuarios';
        $this->status = 'Elegir';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
            $data = User::where('name', 'like', '%'. $this->search . '%')
        ->select('*')->orderBy('name', 'asc')->paginate($this->pagination);
        else
            $data = User::select('*')->orderBy('name', 'asc')->paginate($this->pagination);
        return view('livewire.users.component',[
            'data' => $data,
            'roles' => Role::orderBy('name', 'asc')->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function resetUI()
    {
        $this->name ='';
        $this->email ='';
        $this->password ='';
        $this->phone ='';
        $this->image ='';
        $this->search ='';
        $this->status ='Elegir';
        $this->selected_id =0;
        $this->resetValidation();
        $this->resetPage();
    }

    public function Edit(User $user)
    {
        $this->selected_id = $user->id;
        $this->name = $user->name;
        $this->phone = $user->phone;
        $this->profile = $this->profile;
        $this->status = $this->status;
        $this->email = $user->email;
        $this->password = '';

        $this->emit('show-modal', 'open!');
    }

    protected $listeners =[
        'deleteRow' => 'destroy',
        'resetUI' => 'resetUI'
    ];

    public function Store()
    {
        $rules =[
            'name' => 'required|min:3',
            'email' => 'required|unique:users|email',
            'status' => 'required|not_in:Elegir',
            'profile' => 'required|not_in:Elegir',
            'password' => 'required|min:6',
        ];
        $messages =[
            'name.required' => 'Ingresa el Nombre',
            'name.min' => 'El numbre de usuario debe tener al menos 3 caracteres',
            'email.required' => 'Ingresa el correo',
            'email.email' => 'Ingresa un correo valido',
            'email.unique' => 'el correo ya existe',
            'status.required' => 'Seleccione el estado',
            'status.not_in' => 'Seleccione el estado',
            'profile.required' => 'selecciona el rol',
            'profile.not_in' => 'Selecciona un Perfil',
            'password.required' => 'Ingresa la Contraseña',
            'password.min' => 'minimo 6 caracteres'
        ];
        $this->validate($rules, $messages);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
            'profile' => $this->profile,
            'password' => bcrypt($this->password)
        ]);

        // asigna el rol al usuario
        $user->syncRoles($this->profile);

        $customFileName;
        if($this->image){
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/users', $customFileName);
            $user->image = $customFileName;
            $user->save();
        }
        Logs::logs('Crear',"Id: {$user->id} - nombre: {$user->name}", $this->componentName);
        $this->resetUI();
        $this->emit('user-added', 'Usuario Registrado');
    }

    public function Update()
    {
        $rules =[
            'email' => "required|email|unique:users,email,{$this->selected_id}",
            'name' => 'required|min:3',
            'status' => 'required|not_in:Elegir',
            'profile' => 'required|not_in:Elegir',
            'password' => 'required|min:6',
        ];
        $messages =[
            'name.required' => 'Ingresa el Nombre',
            'name.min' => 'El numb re de usuario debe tener al menos 3 caracteres',
            'email.required' => 'Ingresa el correo',
            'email.email' => 'Ingresa un correo valido',
            'email.unique' => 'el correo ya existe',
            'status.required' => 'Seleccione el estado',
            'status.not_in' => 'Seleccione el estado',
            'profile.required' => 'selecciona el rol',
            'profile.not_in' => 'Selecciona un Perfil',
            'password.required' => 'Ingresa la Contraseña',
            'password.min' => 'minimo 6 caracteres'
        ];
        $this->validate($rules, $messages);

        $user = User::find($this->selected_id);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
            'profile' => $this->profile,
            'password' => bcrypt($this->password)
        ]);

        $user->syncRoles($this->profile);

        if($this->image){
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/users', $customFileName);
            $imageTemp = $user->image;
            $user->image = $customFileName;
            $user->save();

            if($imageTemp !=null)
            {
                if(file_exists('storage/users/'. $imageTemp)){
                    unlink('storage/users/' . $imageTemp);
                }
            }
        }
        Logs::logs('Editar',"Id: {$user->id} - nombre: {$user->name}", $this->componentName);
        $this->resetUI();
        $this->emit('user-updated', 'Usuario Actualizado');
    }

    public function destroy(User $user)
    {
        if($user){
            $sales = Sale::where('user_id' , $user->id)->count();
            $shopping = Shopping::where('user_id' , $user->id)->count();
            $logs = Log::where('user_id' , $user->id)->count();
            if($sales > 0){
                $this->emit('user-withsales', 'Usuario Con Ventas Registradas');
            }else if($shopping > 0){
                $this->emit('user-withsales', 'Usuario Con Compras Registradas');
            }else if($logs > 0){
                $this->emit('user-withsales', 'Usuario Con Movimientos');
            }else{
                $user->delete();
                Logs::logs('Eliminar',"Id: {$user->id} - nombre: {$user->name}", $this->componentName);
                $this->resetUI();
                $this->emit('user-deleted', 'Usuario Eliminado :/');
            }
        }
    }
}
