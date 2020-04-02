@extends('layouts.app')

@section('content')
  <div class="d-flex justify-content-between mb-3">
    <h1>Reparaciones</h1>
    <a href="{{ route('reparaciones.create') }}">
      <button class="btn btn-lg btn-primary btn-create">
        <i class="fas fa-plus mr-2"></i>Crear reparación
      </button>
    </a>
  </div>

  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Reparaciones</li>
  </ol>

  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <span><i class="fas fa-table mr-1"></i>Reparaciones</span>
        <button class="btn btn-success" data-toggle="modal" data-target="#modal-report"><i class="fas fa-file-excel mr-2"></i>Descargar</button>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover table-striped" id="table-inventory" width="100%">
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

<div class="modal fade" id="modal-report" tabindex="-1" role="dialog" aria-labelledby="modal-report-label" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-report-label">Reporte de reparaciones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('reports.repairs') }}" method="get" target="_blank">
        @csrf
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-12 col-md-6">
                <label for="start-date">Fecha inicial:</label>
                <input type="date" class="form-control" name="start-date" id="start-date" value="{{ date('Y-m-01') }}">
              </div>
              <div class="col-12 col-md-6">
                <label for="end-date">Fecha final:</label>
                <input type="date" class="form-control" name="end-date" id="end-date" value="{{ date('Y-m-d') }}">
              </div>
            </div>
            {{-- <div class="row mb-2">
              <div class="col">
                <button type="button" class="btn btn-link" data-toggle="collapse" href="#collapse-advanced" role="button" aria-expanded="false" aria-controls="collapse-advanced">
                  Opciones de reporte avanzadas
                </button>
              </div>
            </div>
            <div class="collapse" id="collapse-advanced">
              <div class="card card-body">
                <div class="row">
                  <div class="col-12 col-md-4 mb-2">
                    <label for="code">Código:</label>
                    <input type="text" name="code" id="code" class="form-control">
                  </div>
                  <div class="col-12 col-md-8 mb-2">
                    <label for="description">Descripción:</label>
                    <input type="text" name="description" id="description" class="form-control">
                  </div>
                  <div class="col-12 mb-2">
                    <label for="provider">Proveedor:</label>
                    <select name="provider" id="provider" class="select2">
                      <option value="">-- Seleccione el proveedor --</option>
                      @foreach ($providers as $provider)
                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div> --}}
          </div>
        </div>
        <div class="modal-footer">
          <div class="col">
            <button type="button" class="btn btn-block btn-lg btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
          <div class="col">
            <button type="submit" class="btn btn-block btn-lg btn-primary">Generar reporte</button>
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