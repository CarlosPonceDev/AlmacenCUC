@extends('layouts.app')

@section('content')
  <div class="d-flex justify-content-between mb-3">
    <h1>Inventario{{ isset($category) ? ' - ' . $category->description : '' }}</h1>
    <a href="{{ route('inventario.create') }}">
      <button class="btn btn-lg btn-success btn-create">
        <i class="fas fa-plus mr-2"></i>Crear producto
      </button>
    </a>
  </div>

  <ol class="breadcrumb mb-4">
    @if (isset($category))
      <li class="breadcrumb-item"><a href="{{ route('inventario.index') }}">Inventario</a></li>
      <li class="breadcrumb-item active">{{ $category->description }}</li>
    @else
      <li class="breadcrumb-item active">Inventario</li>
    @endif
  </ol>

  <div class="card">
    <div class="card-header"><i class="fas fa-table mr-1"></i>Inventario</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover table-striped" id="table-inventory" width="100%">
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

@section('modals')
<div class="modal fade" id="modal-observations" tabindex="-1" role="dialog" aria-labelledby="modal-observations-label" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-observations-label">Observaciones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="observations"></div>
      </div>
      <div class="modal-footer">
        <div class="col">
          <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('inline-scripts')
    <script>
      function show(param) {
        let id = $(param).data('id');
        $.ajax({
          method: 'GET',
          url: "{{ route('fetch.observations') }}",
          data: {
            "_token": "{{ csrf_token() }}",
            "id": id
          },
        }).done(function (observations) {
          console.log(observations);
          let html = '';
          if (observations != '') {
            html += '<ul class="list-group list-group-flush">';
            $.each(observations, function (key, value) {
              html += 
                '<li class="list-group-item">' +
                  '<div class="row">' +
                    '<div class="col-2 border-right">' +
                      '<strong>' + value.created_at.substring(0, 10) + '</strong>' +
                    '</div>' +
                    '<div class="col-10">' +
                      value.description +
                    '</div>' +
                  '</div>' +
                '</li>'
            });
            html += '</ul>';
            $('#observations').html(html);
          } else {
            $('#observations').html('<h2>No tiene observaciones</h2>');
          }
          $('#modal-observations').modal('show');
        });
      }
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
          ajax: "{{ isset($category) ? route('laratables.categories', $category) :  route('laratables.inventory') }}",
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
            { name: 'observations', orderable: false, searchable: false },
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