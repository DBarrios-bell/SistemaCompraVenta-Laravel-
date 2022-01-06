<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog madal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-white">
            <b> {{$ComponentName}}</b> | {{$selected_id > 0 ? 'Editar' : 'Crear'}}
        </h5>
        <h6 class="text-center text-warning" Wwire:loading>POR FAVOR ESPERE</h6>
      </div>
      <div class="modal-body">