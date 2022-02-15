<div>
    <style></style>

    <div class="row layout-top-spacing">
        <div class="col-sm-12 col-md-8">
            {{-- DETALLES --}}
            @include('livewire.pos.partials.detail')
        </div>
        <div class="col-sm-12 col-md-4">
            {{-- TOTAL --}}
            @include('livewire.pos.partials.total')

            {{-- DENOMINATIONS --}}
            @include('livewire.pos.partials.coins')
        </div>
    </div>
</div>
<script>

    try {
        onScan.attachTo(document, {
            suffixKeyCodes: [13],
            onScan: function(barcode){
                window.livewire.emit('scan-code', barcode)
            },
            onScanError: function(e){
                //console.log(e)
            }
        })

        console.log('Scanner Ready!')
    } catch (e) {
        console.log('Scanner Ready!')
    }
</script>

@include('livewire.pos.scripts.shortcuts')
@include('livewire.pos.scripts.events')
@include('livewire.pos.scripts.general')
