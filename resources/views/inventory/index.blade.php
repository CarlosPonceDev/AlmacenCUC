@extends('layouts.app-sbadmin')

@section('content')
  <h1>Inventario</h1>

  <div class="d-flex justify-content-end">
    <button class="btn btn-primary">
      Nuevo producto
    </button>
  </div>

  <div class="mt-4 table-responsive">
    <table class="table table-hover" id="table-inventory">
      <thead class="thead-dark">
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
@endsection

@push('inline-scripts')
    <script>
      function dele(param) {
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
        @if (Session::has('delete'))
          notifier.success('{{ Session::get("delete") }}', {
            labels: {
              success: 'Éxito'
            }
          });
        @endif
      }
    </script>
@endpush