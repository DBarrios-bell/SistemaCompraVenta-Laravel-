@include('livewire.salePoints.common.modalHead')

<select id="ptventa" name="ptventa"  class="form-control" wire:change="SelectPTVenta($event.target.value)">
     <option value="">Elegir</option>
    @foreach ($pventa as $category)
        <option value="{{ $category->id }}"><a href="{{ route('pos') }}">{{ $category->name }}</a></option>
    @endforeach
</select>

{{-- <a href="{{ route('categorias') }}"><button id="boton-guardar" class="btn btn-dark close-modal">Guardar</button></a> --}}


@include('livewire.salePoints.common.modalFooter')
@include('livewire.salePoints.common.script')


{{-- <select id="producto" name="producto" onchange="ShowSelected();">
<option value="12">Texto One</option>
<option value="13">Texto Two</option>
</select> --}}
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function(){

        window.livewire.on('point-added', msg =>{
            noty(msg);
        });
    });
</script>
