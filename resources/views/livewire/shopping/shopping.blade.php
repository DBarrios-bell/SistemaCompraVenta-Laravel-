<div>
    <style></style>

    <div class="row layout-top-spacing">
        <div class="col-sm-12 col-md-8">
            {{-- DETALLES --}}
            @include('livewire.shopping.partials.detail')
        </div>
        <div class="col-sm-12 col-md-4">
            {{-- TOTAL --}}
            @include('livewire.shopping.partials.total')

            {{-- DENOMINATIONS --}}
            @include('livewire.shopping.partials.coins')
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

@include('livewire.shopping.scripts.shortcuts')
@include('livewire.shopping.scripts.events')
@include('livewire.shopping.scripts.general')
