@extends('layouts.app-sbadmin')

@section('content')
  <h1>Entrada</h1>

  <div class="card w-100 mt-4">
    <div class="card-body">
      <form action="{{ route('entradas.store') }}" method="post">
        @csrf
        <div class="row">
          <div class="col-3">
            <label for="date">Fecha:</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ date('Y-m-d') }}">
          </div>
          <div class="col-2">
            <label for="code">Código:</label>
            <input type="text" name="code" id="code" class="form-control text-uppercase" placeholder="Código..." autofocus autocomplete="off">
          </div>
          <div class="col-7">
            <label for="description">Descripción:</label>
            <input type="text" name="description" id="description" class="form-control" placeholder="Descripción...">
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-5">
            <label for="category">Categoría:</label>
            <select name="category" id="category" class="custom-select">
              @foreach ($categories as $category)
                <option value="{{ $category->name }}">{{ $category->description }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-2">
            <label for="quantity">Cantidad:</label>
            <input type="text" name="quantity" id="quantity" class="form-control">
          </div>
          <div class="col-3">
            <label for="unit">Unidad:</label>
            <select name="unit" id="unit" class="custom-select">
              @foreach ($units as $unit)
                <option value="{{ $unit->name }}">{{ $unit->description }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-2">
            <label for="minimum">Mínima:</label>
            <input type="text" name="minimum" id="minimum" class="form-control">
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-5">
            <label for="provider">Proveedor:</label>
            <select name="provider" id="provider" class="select2 custom-select">
              @foreach ($providers as $provider)
                  <option value="{{ $provider->id }}">{{ $provider->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-4">
            <label for="bill">Factura:</label>
            <input type="text" name="bill" id="bill" class="form-control">
          </div>
          <div class="col-3">
            <label for="place">Lugar:</label>
            <select name="place" id="place" class="custom-select">
              @foreach ($places as $place)
                  <option value="{{ $place->name }}">{{ $place->description }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col">
            <label for="observations">Observaciones</label>
            <textarea name="observations" id="observations" cols="30" rows="10" class="form-control"></textarea>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col">
            <button type="submit" id="save" class="btn btn-lg btn-block btn-primary">Guadar entrada</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('inline-scripts')
    <script>
      window.onload = function(){
        $('form').submit(function (e) {
            $('body').prepend('<div class="loader"></div>');
            e.submit();
        });
        function navigate(keyCode, left = null, right = null, up = null, down = null) {
          switch(keyCode) {
              case UP:
                if (up != null) {
                  if (up == 'provider') {
                    $('#' + up).select2('focus');
                  } else {
                    $('#' + up).focus();
                  }
                }
              break;

              case DOWN:
                if (down != null) {
                  if (down == 'provider') {
                    $('#' + down).select2('focus');
                  } else {
                    $('#' + down).focus();
                  }
                }
              break;

              case LEFT:
                if (left != null) {
                  if (left == 'provider') {
                    $('#' + left).select2('focus');
                  } else {
                    $('#' + left).focus();
                  }
                }
              break;

              case RIGHT: case TAB:
                if (right != null) {
                  if (right == 'provider') {
                    $('#' + right).select2('focus');
                  } else {
                    $('#' + right).focus();
                  }
                }
              break;

              default: return;
            }
        }

        $('#date').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, null, 'code', null, 'category');
          }
        });

        $('#code').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == ENTER || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'date', 'description', null, 'category');
          }
        });

        $('#description').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == ENTER || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'code', 'category', null, 'quantity');
          }
        });

        $('#category').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'description', 'quantity', 'date', 'provider');
          }
        });

        $('#quantity').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == ENTER || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'category', 'unit', 'description', 'bill');
          }
        });

        $('#unit').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'quantity', 'minimum', 'description', 'bill');
          }
        });

        $('#minimum').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == ENTER || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'unit', 'provider', 'description', 'place');
          }
        });

        $('#provider').next('.select2-container').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'minimum', 'bill', 'category', 'observations');
          }
        });

        $('#bill').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == ENTER || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'provider', 'place', 'quantity', 'observations');
          }
        });

        $('#place').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'bill', 'observations', 'minimum', 'observations');
          }
        });

        $('#observations').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == ENTER || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'place', 'save', 'provider', 'save');
          }
        });

        $('#save').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == ENTER || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'observations', null, 'observations', null);
          }
        });

        @if (Session::has('success'))
          notifier.success('{{ Session::get("success") }}', {
            labels: {
              success: 'Éxito'
            }
          });
        @endif
      }
    </script>
@endpush