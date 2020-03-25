@extends('layouts.app-sbadmin')

@section('content')
  <div class="d-flex justify-content-between mb-3">
    <h1>Reparaciones</h1>
    <a href="{{ route('reparaciones.create') }}">
      <button class="btn btn-lg btn-success btn-create">
        <i class="fas fa-plus mr-2"></i>Crear reparación
      </button>
    </a>
  </div>

  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Reparaciones</li>
  </ol>

  <div class="card">
    <div class="card-header"><i class="fas fa-table mr-1"></i>Reparaciones</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover table-striped" id="table-inventory">
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Descripción</th>
              <th>ID</th>
              <th>Motivo de reparación</th>
              <th>Personal</th>
              <th>Empresa</th>
              <th>Fecha de entrega</th>
              <th>Acción</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
@endsection

@section('modals')
<div class="modal fade" id="modal-delivery" tabindex="-1" role="dialog" aria-labelledby="modal-delivery-label" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-delivery-label">Recepción de reparación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('reparacion.delivery') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="date">Fecha de recibido:</label>
            <input type="date" class="form-control" name="date" id="date" value="{{ date('Y-m-d') }}">
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" id="id">
          <div class="col">
            <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
          <div class="col">
            <button type="submit" class="btn btn-block btn-primary">Guardar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('inline-scripts')
    <script>
      function delivery(param) {
        $('#id').val($(param).data('id'));
        $('#modal-delivery').modal('show');
      };
      function destroy(param) {
        notifier.confirm(
          '¿Seguro que quieres eliminar esta reparación?',
          function () {
            $(param).closest("form").submit();
          },
          null,
          {
            labels: {
              confirm: 'Atención',
              confirmCancel: 'Cancelar',
            }
          }
        )
      };
      window.onload = function() {
        $('#table-inventory').DataTable({
          serverSide: true,
          ajax: "{{ route('laratables.repairs') }}",
          columns: [
            { name: 'exit_date' },
            { name: 'description' },
            { name: 'repair_id' },
            { name: 'reason' },
            { name: 'personal' },
            { name: 'business' },
            { name: 'delivery_date' },
            { name: 'action', orderable: false, searchable: false },
          ],
          language: language
        });

        @if (Session::has('status'))
          notifier.info('{{ Session::get("status") }}', {
            labels: {
              success: 'Éxito'
            }
          });
        @endif
      }
    </script>
@endpush