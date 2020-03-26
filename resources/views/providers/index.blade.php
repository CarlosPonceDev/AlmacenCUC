@extends('layouts.app-sbadmin')

@section('content')
  <div class="d-flex justify-content-between mb-3">
    <h1>Proveedores</h1>
    <a href="{{ route('proveedores.create') }}">
      <button class="btn btn-lg btn-success btn-create">
        <i class="fas fa-plus mr-2"></i>Crear proveedor
      </button>
    </a>
  </div>

  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Proveedores</li>
  </ol>

  <div class="card">
    <div class="card-header"><i class="fas fa-table mr-1"></i>Proveedores</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="table-inventory">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Código</th>
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
          '¿Seguro que quieres eliminar este empleado?',
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
          ajax: "{{ route('laratables.providers') }}",
          columns: [
            { name: 'name' },
            { name: 'id' },
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