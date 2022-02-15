@include('common.modalHead')

<div class="row">
    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" wire:model.lazy='name' class="form-control" placeholder="Ej: Devinsky">
            @error('name') <span class="text-danger er">{{$message}}</span>@enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Telefono</label>
            <input type="text" wire:model.lazy='phone' class="form-control" placeholder="Ej: 301 xxxx xxx" maxlength="10">
            @error('phone') <span class="text-danger er">{{$message}}</span>@enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Email</label>
            <input type="text" wire:model.lazy='email' class="form-control" placeholder="Ej: ejemplo@gmail.com">
            @error('email') <span class="text-danger er">{{$message}}</span>@enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" wire:model.lazy='password' class="form-control">
            @error('password') <span class="text-danger er">{{$message}}</span>@enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Estado</label>
            <select wire:model.lazy='status' class="form-control">
                <option value="Elegir" selected>Elegir</option>
                <option value="Active">Activo</option>
                <option value="Locked">Bloqueado</option>
            </select>
            @error('status') <span class="text-danger er">{{$message}}</span>@enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Asignar Perfil</label>
            <select wire:model.lazy='profile' class="form-control">
                <option value="Elegir" selected>Elegir</option>
                @foreach ($roles as $role)
                    <option value="{{$role->name}}">{{$role->name}}</option>
                @endforeach
            </select>
            @error('profile') <span class="text-danger er">{{$message}}</span>@enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Imagen de Perfil</label>
            <input type="file" wire:model='image' accept="image/x-png, image/jpeg, image/gif" class="form-control">
            @error('image') <span class="text-danger er">{{$message}}</span>@enderror
        </div>
    </div>
</div>

@include('common.modalFooter')