@extends('layouts.app-sbadmin')

@section('content')
  <style>
    .ui-widget-content{
      z-index: 1100;
    }
  </style>
  <div class="d-flex justify-content-between mb-2">
    <h1>Inventario</h1>
    <button class="btn btn-lg btn-success btn-create">
      <i class="fas fa-plus mr-2"></i>Nuevo producto
    </button>
  </div>

  <div class="mt-4 table-responsive">
    <table class="table table-hover table-striped" id="table-inventory">
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

@section('modals')
  <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="modal-create-label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-create-label">Agregar nuevo producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('inventario.store') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-12 col-lg-4 mb-2">
                <label for="date">Fecha:</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ date('Y-m-d') }}">
              </div>
              <div class="col-12 col-lg-8 mb-2">
                <label for="description">Descripción:</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="Descripción...">
              </div>
              <div class="col-12 col-lg-4 mb-2">
                <label for="quantity">Cantidad:</label>
                <input type="text" name="quantity" id="quantity" class="form-control">
              </div>
              <div class="col-12 col-lg-4 mb-2">
                <label for="unit">Unidad:</label>
                <select name="unit" id="unit" class="custom-select">
                  @foreach ($units as $unit)
                    <option value="{{ $unit->name }}">{{ $unit->description }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-12 col-lg-4 mb-2">
                <label for="minimum">Mínima:</label>
                <input type="text" name="minimum" id="minimum" class="form-control">
              </div>
              <div class="col-12 col-lg-4 mb-2">
                <label for="place">Lugar:</label>
                <select name="place" id="place" class="custom-select">
                  @foreach ($places as $place)
                      <option value="{{ $place->name }}">{{ $place->description }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-12 col-lg-8 mb-2">
                <label for="category">Categoría:</label>
                <select name="category" id="category" class="custom-select">
                  @foreach ($categories as $category)
                    <option value="{{ $category->name }}">{{ $category->description }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-12 mb-2">
                <label for="observations">Observaciones</label>
                <textarea name="observations" id="observations" cols="30" rows="10" class="form-control"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="col">
              <button type="button" class="btn btn-lg btn-block btn-secondary" id="close" data-dismiss="modal">Cerrar</button>
            </div>
            <div class="col">
              <button type="submit" class="btn btn-lg btn-block btn-success" id="save">Agregar</button>
            </div>
          </div>
        </form>
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
        $('#description').autocomplete({
          source: function (request, response) {
            $.ajax({
              url: '{{ route("fetch.description") }}',
              type: 'GET',
              dataType: 'json',
              data: {
                "_token": "{{ csrf_token() }}",
                "search": request.term
              },
              success: function (data) {
                response(data);
              }
            });
          }
        });
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
        $('.btn-create').click(function () {
          $('#modal-create').modal('show');
          $('#description').focus();
        });
        function navigate(keyCode, left = null, right = null) {
          switch(keyCode) {
              case LEFT:
                if (left != null) {
                  $('#' + left).focus();
                }
              break;

              case RIGHT: case TAB:
                if (right != null) {
                  $('#' + right).focus();
                }
              break;

              default: return;
            }
        }
        $('#date').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, null, 'description');
          }
        });
        $('#description').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'date', 'quantity');
          } else {
            $('#description').autocomplete('disabled');
          }
        });
        $('#quantity').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'description', 'unit');
          }
        });
        $('#unit').keydown(function (e) {
          if (e.which == LEFT || e.which == RIGHT || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'quantity', 'minimum');
          }
        });
        $('#minimum').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'unit', 'place');
          }
        });
        $('#place').keydown(function (e) {
          if (e.which == LEFT || e.which == RIGHT || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'minimum', 'category');
          }
        });
        $('#category').keydown(function (e) {
          if (e.which == LEFT || e.which == RIGHT || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'place', 'observations');
          }
        });
        $('#observations').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'category', 'close');
          }
        });
        $('#close').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'observations', 'save');
          }
        });
        $('#save').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'close', null);
          }
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