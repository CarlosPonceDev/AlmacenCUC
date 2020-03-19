@extends('layouts.app-sbadmin')

@section('content')
  <h1 class="mb-3">Editar producto</h1>

  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('inventario.index') }}">Inventario</a></li>
    <li class="breadcrumb-item active">Editar producto</li>
  </ol>

  <div class="card w-100 mt-4">
    <div class="card-header"><i class="fas fa-table mr-1"></i>Editar producto</div>
    <div class="card-body">
      <form action="{{ route('inventario.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-12 col-lg-7 mb-2">
            <label for="description">Descripción:</label>
            <input type="text" name="description" id="description" value="{{ $product->description }}" class="form-control" placeholder="Descripción..." autofocus>
          </div>
          <div class="col-12 col-lg-2 mb-2">
            <label for="quantity">Stock inicial:</label>
            <input type="text" name="quantity" id="quantity" value="{{ $product->inventory->initial_stock }}" class="form-control">
          </div>
          <div class="col-12 col-lg-3 mb-2">
            <label for="unit">Unidad:</label>
            <select name="unit" id="unit" class="custom-select">
              @foreach ($units as $unit)
                <option value="{{ $unit->name }}" {{ $product->unit->id == $unit->id ? 'selected' : '' }}>{{ $unit->description }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-12 col-lg-7 mb-2">
            <label for="category">Categoría:</label>
            <select name="category" id="category" class="custom-select">
              @foreach ($categories as $category)
                <option value="{{ $category->name }}" {{ $product->category->id == $category->id ? 'selected' : '' }}>{{ $category->description }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-12 col-lg-5 mb-2">
            <label for="minimum">Mínima:</label>
            <input type="text" name="minimum" id="minimum" value="{{ $product->inventory->minimum }}" class="form-control">
          </div>
        </div>
        <div class="row mt-4">
          <div class="col">
            <button type="submit" id="save" class="btn btn-lg btn-block btn-primary">Editar producto</button>
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
        $('#description').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, null, 'quantity');
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
            navigate(e.which, 'quantity', 'category');
          }
        });
        $('#category').keydown(function (e) {
          if (e.which == LEFT || e.which == RIGHT || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'unit', 'minimum');
          }
        });
        $('#minimum').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'category', 'save');
          }
        });
        $('#save').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'minimum', null);
          }
        });
      }
    </script>
@endpush