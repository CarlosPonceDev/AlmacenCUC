@extends('layouts.app-sbadmin')

@section('content')
  <div class="d-flex justify-content-between mb-3">
    <h1>Entradas</h1>
    <a href="{{ route('entradas.create') }}">
      <button class="btn btn-lg btn-success btn-create">
        <i class="fas fa-plus mr-2"></i>Crear entrada
      </button>
    </a>
  </div>

  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Entradas</li>
  </ol>

  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <span><i class="fas fa-table mr-1"></i>Entradas</span>
        <a class="btn btn-sm btn-light border-success" href="{{ route('reports.entries') }}" target="_blank"><i class="fas fa-file-excel text-success mr-2"></i>Descargar</a>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover table-striped" id="table-entries" width="100%">
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Código</th>
              <th>Descripción</th>
              <th>Entrada</th>
              <th>Unidad</th>
              <th>Factura</th>
              <th>Proveedor</th>
              <th>Lugar</th>
              <th>Observación</th>
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
          '¿Seguro que quieres eliminar esta entrada?',
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
        $('#table-entries').DataTable({
          serverSide: true,
          ajax: "{{ route('laratables.entries') }}",
          columns: [
            { name: 'date' },
            { name: 'code' },
            { name: 'description' },
            { name: 'quantity' },
            { name: 'unit' },
            { name: 'bill' },
            { name: 'provider' },
            { name: 'place' },
            { name: 'observation' },
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