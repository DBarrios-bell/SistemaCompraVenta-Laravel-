<div class="row sales layout-top-sparcing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title text-center">
                    <b class="text-center">Registros Del Sistema</b>
                </h4>
            </div>
            <div class="widget-content">
                <diw class="row">
                    {{-- <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label>Modulos</label>
                            <select wire:model="moduloid" class="form-control">
                                <option value="0" disable>Elegir</option>
                                @foreach ($logs as $log)
                                    <option value="{{$log->categories}}">{{$log->categories}}</option>
                                @endforeach
                            </select>
                            @error('moduloid')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div> --}}
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label>Usuario</label>
                            <select wire:model="userid" class="form-control">
                                <option value="0" disable>Elegir</option>
                                @foreach ($users as $u)
                                    <option value="{{$u->id}}">{{$u->name}}</option>
                                @endforeach
                            </select>
                            @error('userid')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label>Punto Venta</label>
                            <select wire:model="ptventa" class="form-control">
                                <option value="0" disable>Elegir</option>
                                @foreach ($salepoints as $salepoint)
                                    <option value="{{$salepoint->id}}">{{$salepoint->name}}</option>
                                @endforeach
                            </select>
                            @error('ptventa')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-13 col-md-3">
                        <div class="form-group">
                            <label>Fecha Inicial</label>
                            <input type="date" wire:model.lazy="fromDate" class="form-control">
                            @error('fromDate')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-13 col-md-3">
                        <div class="form-group">
                            <label>Fecha Final</label>
                            <input type="date" wire:model.lazy="toDate" class="form-control">
                            @error('toDate')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- botones que se alinean al aparecer  --}}
                    {{-- <div class="col-sm-12 col-md-3 align-self-center d-flex justify-content-around">
                        @if ($userid > 0 && $fromDate != null && $toDate != null)
                            <button wire:click="$refresh" class="btn btn-dark btn-block">Consultar</button>
                        @endif
                            <button wire:click.prevent="Print()" type="button"
                            class="btn btn-dark">Imprimir</button>
                    </div> --}}
                </diw>
            </div>
            @include('common.searchbox')
            <div class="row">
                <div class="col-sm-10 col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mt-1">
                            <thead class="text-white">
                                <tr>
                                    <th class="table-th text-center text-white">ID</th>
                                    <th class="table-th text-center text-white">ACCION</th>
                                    <th class="table-th text-center text-white">MODULO</th>
                                    <th class="table-th text-center text-white">DETALLE</th>
                                    <th class="table-th text-center text-white">USUARIO</th>
                                    <th class="table-th text-center text-white">FECHA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                                    <tr>
                                        <td class="text-center"><h6>{{$log->id}}</h6></td>
                                        <td class="text-center"><h6>{{$log->action}}</h6></td>
                                        <td class="text-center"><h6>{{$log->categories}}</h6>
                                        <td class="text-center"><h6>{{$log->message}}</h6></td>
                                        <td class="text-center"><h6>{{$log->user}}</h6></td>
                                        <td class="text-center"><h6>{{$log->created_at}}</h6></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{$logs->links()}} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>