<div class="row mt-3">
    <div class="col-sm-12">
        <div>
            <div class="connect-sorting mt3">
                <h5 class="text-center mb-3">Resumen de Venta</h5>
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