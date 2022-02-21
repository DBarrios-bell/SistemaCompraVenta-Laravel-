@include('common.modalHead')

<div class="row">
    <div class="col-sm-12 col-md-7">
        <div class="form-group">
            <label>Nombre Proveedor</label>
            <input type="text" wire:model.lazy='name' class="form-control" placeholder="Ej: Proveedor">
            @error('name') <span class="text-danger er">{{$message}}</span>@enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-5">
        <div class="form-group">
            <label>Nit</label>
            <input type="text" wire:model.lazy='nit' class="form-control" placeholder="Ej: 301 xxxx xxx" maxlength="10">
            @error('nit') <span class="text-danger er">{{$message}}</span>@enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
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
            <label>Estado</label>
            <select wire:model.lazy='status' class="form-control">
                <option value="Elegir" selected>Elegir</option>
                <option value="Activo">Activo</option>
                <option value="Bloqueado">Bloqueado</option>
            </select>
            @error('status') <span class="text-danger er">{{$message}}</span>@enderror
        </div>
    </div>
</div>

@include('common.modalFooter')