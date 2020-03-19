@extends('layouts.app-sbadmin')

@section('content')
  <div class="d-flex justify-content-between mb-3">
    <h1>Inventario</h1>
    <a href="{{ route('inventario.create') }}">
      <button class="btn btn-lg btn-success btn-create">
        <i class="fas fa-plus mr-2"></i>Crear producto
      </button>
    </a>
  </div>

  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Inventario</li>
  </ol>

  <div class="card">
    <div class="card-header"><i class="fas fa-table mr-1"></i>Inventario</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="table-inventory">
          <thead>
            <tr>
              <th>Código</th>
              <th>Descripción</th>
              <th>Categoría</th>
              <th>CUC</th>
              <th>Tomatlán</th>
              <th>Gourmet</th>
              <th>Entradas</th>
              <th>Salidas</th>
              <th>Stock inicial</th>
              <th>Observaciones</th>
              <th>Acciones</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
@endsection

@push('inline-scripts')
    <script>
      function destroy(param) {
        notifier.confirm(
          '¿Seguro que quieres eliminar este producto?',
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
          ajax: "{{ route('laratables.inventory') }}",
          columns: [
            { name: 'code' },
            { name: 'description' },
            { name: 'category' },
            { name: 'cuc' },
            { name: 'tomatlan' },
            { name: 'gourmet' },
            { name: 'entries' },
            { name: 'exits' },
            { name: 'initial_stock' },
            { name: 'code' },
            { name: 'action', orderable: false, searchable: false },
          ]
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