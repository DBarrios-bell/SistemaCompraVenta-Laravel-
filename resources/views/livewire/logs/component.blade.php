<div class="row sales layout-top-sparcing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title text-center">
                    <b class="text-center">Registros Del Sistema</b>
                </h4>
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
                        {{$logs->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>