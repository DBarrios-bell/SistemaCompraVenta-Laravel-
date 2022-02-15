<script>
    var listener = new window.keypress.Listener();

    listener.simple_combo("f9", function() {
        console.log('f9')
        livewire.emit('saveSale')
    })
    listener.simple_combo("f8", function() {
        document.getElementById('cash').value=''
        document.getElementById('hiddenTotal').value=''
        document.getElementById('cash').focus()
    })
    listener.simple_combo("f4", function() {
        var total = parseFloat(document.getElementById('hiddenTotal').value)
        if(total > 0){
            confirm(0, 'clearCart', '¿Seguro de Eliminar el Carrito?')
        }else{
            noty('Agrega Productos a la Venta')
        }
    })
</script>