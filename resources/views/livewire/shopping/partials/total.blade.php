<div class="row mt-3">
    <div class="col-sm-12">
        <div>
            <div class="connect-sorting mt3">
                <div>
                    <h6 for="">Proveedor</h6>
                    <select wire:model='provider_id' class="form-control">
                            <option value="0">Elegir</option>
                        @foreach ($providers as $provider)
                            <option value="{{$provider->id}}">{{$provider->name}}</option>
                        @endforeach
                    </select>
                        @error('provider_id') <span class="text-danger er">{{$message}}</span>@enderror
                </div>
                <h5 class="text-center mb-3">Resumen de Compra</h5>
                <div class="connect-content">
                    <div class="card simple-title-task ui-sortable-handle">
                        <div class="card-body">
                            <div class="task-header">
                                <div><h4>TOTAL: ${{number_format($total,2)}}</h4></div>
                                <input type="hidden" id="hiddenTotal" value="{{$total}}">
                            </div>
                            <div>
                                <h6 class="mt-3">Articulos: {{$itemsQuantity}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>