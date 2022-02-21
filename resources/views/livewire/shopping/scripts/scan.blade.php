<script>
    try {
        onScan.attachTo(document, {
            suffixKeyCodes: [13],
            onScan: function(barcode){
                console.log(barcode)
                window.livewire.emit('scan-code', barcode)
            },
            onScanError: function(e){
                console.log(e)
            }
        })

        console.log('Scanner Ready!')
    } catch (e) {
        console.log('Error de Lectura: ' , e)
    }
</script>