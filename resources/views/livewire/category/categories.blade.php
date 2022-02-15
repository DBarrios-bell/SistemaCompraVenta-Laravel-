<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b> {{ $componentName }} | {{ $pageTitle }}</b>
                </h4>
                <ul class="tabs tab-pills">
                    @can('1.1 Crear_Categoria')
                        <li>
                            <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal" data-target="#theModal"
                                style="text-decoration: none">Agregar</a>
                        </li>
                    @endcan
                </ul>
            </div>
            @include('common.searchbox')
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-1" id="myTable">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th class="table-th text-white">DESCRIPCIÓN</th>
                                <th class="table-th text-white">IMAGEN</th>
                                <th class="table-th text-white">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>
                                        <h6>{{ $category->name }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <span>
                                            <img src="{{ asset('storage/categorias/' . $category->imagen) }}"
                                                alt="Sin Imagen" height="30" width="40" class="rounded">
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @can('1.2 Editar_Categoria')
                                            <a href="javascript:void(0)" wire:click="Edit({{ $category->id }})"
                                                class="btn btn-dark mtmobile" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('1.3 Eliminar_Categoria')
                                            <a href="javascript:void(0)"
                                                onclick="Confirm('{{ $category->id }}','{{ $category->products->count() }}')"
                                                class="btn btn-dark " title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.category.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('category-added', msg => {
            $('#theModal').modal('hide');
            noty(msg);
        })
        window.livewire.on('category-updated', msg => {
            $('#theModal').modal('hide');
            noty(msg);
        })
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show');
        })
        window.livewire.on('category-deleted', msg => {
            noty(msg);
        })
        window.livewire.on('hide-modal', msg => {
            $('#theModal').modal('hide');
        })
        $('#theModal').on('hidden.bs.modal', function(e) {
            $('.er').css('display', 'none');
        });
    });

    function Confirm(id, products) {
        if (products > 0) {
            swal('NO SE PUEDE ELIMINAR LA CATEGORIA PORQUE TIENE PRODUCTOS RELACIONADOS')
            return;
        }
        swal.fire({
            title: 'CONFIRMAR',
            text: 'CONFIRMAS ELIMINAR EL REGISTRO?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#2C272E',
            confirmButtonColor: '#3b3f5c',
            confirmButtonText: 'Aceptar',
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRow', id)
                swal.close()
            }
        })
    }
</script>
