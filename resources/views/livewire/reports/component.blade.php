<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget">
            <div class="widget-heading">
                <h4 class="card-title text-center"><b>{{ $componentName }}</b></h4>
            </div>
            <div class="widget-content">
                <dir class="row">
                    <div class="col-sm-12 col-md-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Elige el Usuario</h6>
                                <div class="form-group">
                                    <select wire:model="userId" class="form-control">
                                        <option value="0">Todos</option>
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <h6>Elige Tipo de Reporte</h6>
                                <div class="form-group">
                                    <select wire:model="reportType" class="form-control">
                                        <option value="0">Ventas del Dia</option>
                                        <option value="1">Ventas por Fecha</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-2">
                                <h6>Fecha Desde</h6>
                                <div class="form-group">
                                    <input type="text" wire:model="dateFrom" class="form-control flatpickr"
                                        placeholder="Click para elegir">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <h6>Fecha Hasta</h6>
                                <div class="form-group">
                                    <input type="text" wire:model="dateTo" class="form-control flatpickr"
                                        placeholder="Click para elegir">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button wire:click="$refresh" class="btn btn-dark btn-block">Consultar</button>
                                @can('10.1 Reporte Excel')
                                    <a class="btn btn-dark btn-block {{ count($data) < 1 ? 'disabled' : '' }}"
                                        href="{{ url('report/pdf' . '/' . $userId . '/' . $reportType . '/' . $dateFrom . '/' . $dateTo) }}"
                                        target="_blank">Generar PDF</a>
                                @endcan
                                @can('10.2 Reporte Pdf')
                                    <a class="btn btn-dark btn-block {{ count($data) < 1 ? 'disabled' : '' }}"
                                        href="{{ url('report/excel' . '/' . $userId . '/' . $reportType . '/' . $dateFrom . '/' . $dateTo) }}"
                                        target="_blank">Exportar a Excel</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-9">
                        {{-- Tabla --}}
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mt-1" id="myTable">
                                <thead class="text-white" style="background: #3B3F5C">
                                    <tr>
                                        <th class="table-th text-white text-center">ID</th>
                                        <th class="table-th text-white text-center">TOTAL</th>
                                        <th class="table-th text-white text-center">ITEM</th>
                                        <th class="table-th text-white text-center">STATUS</th>
                                        <th class="table-th text-white text-center">USUARIO</th>
                                        <th class="table-th text-white text-center">PUNTO VENTA</th>
                                        <th class="table-th text-white text-center">FECHA</th>
                                        <th class="table-th text-white text-center" width="18%"></th>
                                        {{-- <th class="table-th text-white text-center" width="60px"></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($data) < 1)
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                <h5>Sin Resultado</h5>
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach ($data as $d)
                                        <tr>
                                            <td class="text-center">
                                                <h6>{{ $d->id }}</h6>
                                            </td>
                                            <td class="text-end">
                                                <h6>${{ number_format($d->total, 2) }}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>{{ $d->items }}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>{{ $d->status }}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>{{ $d->user }}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>{{ $d->puntoventa }}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>{{ \Carbon\Carbon::parse($d->created_at)->format('d-m-Y') }}</h6>
                                            </td>
                                            <td class="text-center" width="50px">
                                                <h6>
                                                    <button wire:click.prevent="getDetails({{ $d->id }})"
                                                        class="btn btn-dark btn-sm" title="Detalle de Venta">
                                                        <i class="fas fa-list"></i>
                                                    </button>
                                                    @if ($d->status == 'Pago')
                                                        <a href="javascript:void(0)"
                                                            onclick="cancelSale({{ $d->id }})"
                                                            class="btn btn-dark btn-sm" title="Revertir">
                                                            <i class="fas fa-undo"></i>
                                                        </a>
                                                    @endif
                                                </h6>
                                            </td>
                                            {{-- <td class="text-center" width="50px">
                                                <h6>
                                                    <button wire:click.prevent="cancelSale({{ $d->id }})"
                                                        class="btn btn-dark btn-sm">
                                                        <i class="fas fa-undo"> Revertir</i>
                                                    </button>

                                                </h6>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- {{$data->links()}} --}}
                        </div>
                    </div>
                </dir>
            </div>
        </div>
    </div>
    @include('livewire.reports.sales-detail')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr(document.getElementsByClassName('flatpickr'), {
            enableTime: false,
            dateFormat: 'Y-m-d',
            locale: {
                firstDayofWeek: 1,
                weekdays: {
                    shorthand: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
                    longhand: [
                        "Domingo",
                        "Lunes",
                        "Martes",
                        "Miércoles",
                        "Jueves",
                        "Viernes",
                        "Sábado",
                    ],
                },
                months: {
                    shorthand: [
                        "Ene",
                        "Feb",
                        "Mar",
                        "Abr",
                        "May",
                        "Jun",
                        "Jul",
                        "Ago",
                        "Sep",
                        "Oct",
                        "Nov",
                        "Dic",
                    ],
                    longhand: [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre",
                    ],
                },
            }
        })

        //eventos
        window.livewire.on('show-modal', Msg => {
            $('#modalDetails').modal('show')
        })
        window.livewire.on('sale-revertir', Msg => {
            noty(Msg)
        })
    })

    function cancelSale(id) {
        swal.fire({
            title: 'CONFIRMA',
            text: 'REVERTIR LA VENTA?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#2C272E',
            confirmButtonColor: '#3b3f5c',
            confirmButtonText: 'Aceptar',
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('cancelSale', id)
                swal.close()
            }
        })
    }
</script>
