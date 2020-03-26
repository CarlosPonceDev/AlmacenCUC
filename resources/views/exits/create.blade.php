@extends('layouts.app-sbadmin')

@section('content')
  <h1>Salida</h1>

  <div class="card w-100 mt-4">
    <div class="card-body">
      <form action="{{ route('salidas.store') }}" method="post">
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
            <label for="employee">Empleado:</label>
            <select name="employee" id="employee" class="select2 custom-select">
              @foreach ($employees as $employee)
                  <option value="{{ $employee->id }}">{{ $employee->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-2">
            <label for="quantity">Cantidad:</label>
            <input type="text" name="quantity" id="quantity" class="form-control">
          </div>
          <div class="col-2">
            <label for="unit">Unidad:</label>
            <select name="unit" id="unit" class="custom-select select2-tags">
              @foreach ($units as $unit)
                <option value="{{ $unit->name }}">{{ $unit->description }}</option>
              @endforeach
            </select>
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
            <a href="{{ route('salidas.index') }}"><button type="button" id="back" class="btn btn-lg btn-block btn-secondary"><i class="fas fa-arrow-left mr-3"></i>Regresar</button></a>
          </div>
          <div class="col">
            <button type="submit" id="save" class="btn btn-lg btn-block btn-success"><i class="fas fa-check mr-3"></i>sGuadar salida</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('inline-scripts')
    <script>
      window.onload = function(){
        var $input = $('#code');
        var doneTypingTimer = 1000;
        var typingTimer;
        $('form').submit(function (e) {
            $('body').prepend('<div class="loader"></div>');
            e.submit();
        });
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
          },
          select: function (event, ui) {
            let product = ui.item.product;
            $('#code').val(product.category.prefix + product.code);
            $('#description').val(ui.item.label);
            $('#unit').val(product.unit.name);
          },
          search: function (event, ui) {
            if ($('#code').val('') != '') {
              $('#code').val('');
            }
          }
        });

        function doneTypingCode() {
          $.ajax({
            method: 'GET',
            url: '{{ route("fetch.code") }}',
            data: {
              "_token": "{{ csrf_token() }}",
              "code":   $input.val()
            },
            beforeSend: function () {
              $("label[for=code]").append('<div class="spinner-border spinner-border-sm text-success" school="status"><span class="sr-only">Cargando...</span></div>');
            },
            complete: function () {
              $("label[for=code] .spinner-border").remove();
            }
          })
          .done(function (data) {
            if (typeof data == 'object' && data != null) {
              let product = data.product;
              $('#description').val(product.description); 
              $('#unit').val(product.unit.name);
            } else {
              $('#description').val(''); 
            }
          });
        }

        function navigate(keyCode, left = null, right = null) {
          switch(keyCode) {

              case LEFT:
                if (left != null) {
                  if (left == 'employee' || left == 'unit') {
                    $('#' + left).select2('focus');
                  } else {
                    $('#' + left).focus();
                  }
                }
              break;

              case RIGHT: case TAB:
                if (right != null) {
                  if (right == 'employee' || right == 'unit') {
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
            navigate(e.which, null, 'code');
          }
        });

        $('#code').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == ENTER || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'date', 'description');
          } else {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTypingCode, doneTypingTimer);
          }
        });

        $('#description').keydown(function (e) {
          if (e.which == LEFT || e.which == RIGHT || e.which == ENTER || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'code', 'employee');
          }
        });

        $('#employee').next('.select2-container').keydown(function (e) {
          if (e.which == LEFT || e.which == RIGHT || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'description', 'quantity');
          }
        });

        $('#quantity').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == ENTER || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'employee', 'unit');
          }
        });

        $('#unit').next('.select2-container').keydown(function (e) {
          if (e.which == LEFT || e.which == RIGHT || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'quantity', 'place');
          }
        });

        $('#place').keydown(function (e) {
          if (e.which == LEFT || e.which == RIGHT || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'unit', 'observations');
          }
        });

        $('#observations').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == ENTER || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'place', 'back');
          }
        });

        $('#back').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == ENTER || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'observations', 'save');
          }
        });

        $('#save').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == ENTER || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'back', null);
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