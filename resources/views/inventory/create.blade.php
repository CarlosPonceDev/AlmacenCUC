@extends('layouts.app')

@section('content')
  <h1 class="mb-3">Crear producto</h1>

  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('inventario.index') }}">Inventario</a></li>
    <li class="breadcrumb-item active">Crear producto</li>
  </ol>

  <div class="card w-100 mt-4">
    <div class="card-header"><i class="fas fa-table mr-1"></i>Crear producto</div>
    <div class="card-body">
      <form action="{{ route('inventario.store') }}" method="POST">
        @csrf
        <div class="row">
          <div class="col-12 col-lg-4 mb-2">
            <label for="date">Fecha:</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ date('Y-m-d') }}">
          </div>
          <div class="col-12 col-lg-8 mb-2">
            <label for="description">Descripción:</label>
            <input type="text" name="description" id="description" class="form-control" placeholder="Descripción..." autofocus>
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
        <div class="row mt-4">
          <div class="col">
            <a href="{{ route('inventario.index') }}"><button type="button" id="back" class="btn btn-lg btn-block btn-secondary"><i class="fas fa-arrow-left mr-3"></i>Regresar</button></a>
          </div>
          <div class="col">
            <button type="submit" id="save" class="btn btn-lg btn-block btn-primary"><i class="fas fa-check mr-3"></i>Guadar producto</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('inline-scripts')
    <script>
      window.onload = function(){
        $('#description').autocomplete({
          source: function (request, response) {
            $.ajax({
              url: '{{ route("fetch.product") }}',
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
            navigate(e.which, 'category', 'back');
          }
        });
        $('#back').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'observations', 'save');
          }
        });
        $('#save').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'back', null);
          }
        });
      }
    </script>
@endpush