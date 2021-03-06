@extends('layouts.app')

@section('content')
  <h1 class="mb-3">Editar reparación</h1>

  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('reparaciones.index') }}">Reparaciones</a></li>
    <li class="breadcrumb-item active">Editar reparación</li>
  </ol>

  <div class="card w-100 mt-4">
    <div class="card-header"><i class="fas fa-table mr-1"></i>Editar reparación</div>
    <div class="card-body">
      <form action="{{ route('reparaciones.update', $repair) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-12 col-lg-3 mb-2">
            <label for="date">Fecha:</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ date('Y-m-d') }}">
          </div>
          <div class="col-12 col-lg-3 mb-2">
            <label for="id">ID:</label>
            <input type="text" name="id" id="id" class="form-control text-uppercase" value="{{ $repair->product->full_code }}" autofocus>
            <input type="hidden" name="product-id" id="product-id" value="{{ $repair->product_id }}">
          </div>
          <div class="col-12 col-lg-6 mb-2">
            <label for="description">Descripción del producto:</label>
            <input type="text" name="description" id="description" class="form-control" value="{{ $repair->product->description }}" autocomplete="off">
          </div>
          <div class="col-12 col-lg-3 mb-2">
            <label for="personal">Personal:</label>
            <select name="personal" id="personal" class="custom-select select2-tags">
              @foreach ($personals as $personal)
                <option value="{{ $personal->id }}" {{ $repair->personal->id == $personal->id ? 'selected' : '' }}>{{ $personal->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-12 col-lg-3 mb-2">
            <label for="business">Empresa:</label>
            <select name="business" id="business" class="custom-select select2-tags">
              @foreach ($businesses as $business)
                <option value="{{ $business->id }}" {{ $repair->business->id == $business->id ? 'selected' : '' }}>{{ $business->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-12 col-lg-6 mb-2">
            <label for="reason">Motivo de reparación:</label>
            <input type="text" name="reason" id="reason" class="form-control" value="{{ $repair->reason }}" autofocus>
          </div>
        </div>
        <hr>
        <div class="row mt-4">
          <div class="col">
            <a href="{{ route('reparaciones.index') }}"><button type="button" id="back" class="btn btn-lg btn-block btn-secondary"><i class="fas fa-arrow-left mr-3"></i>Regresar</button></a>
          </div>
          <div class="col">
            <button type="submit" id="save" class="btn btn-lg btn-block btn-success"><i class="fas fa-check mr-3"></i>Guadar reparacion</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('inline-scripts')
    <script>
      window.onload = function(){
        var $input = $('#id');
        var doneTypingTimer = 1000;
        var typingTimer;
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
            $('#id').val(product.category.prefix + product.code);
            $('#product-id').val(product.id);
          },
          search: function (event, ui) {
            if ($('#id').val('') != '') {
              $('#id').val('');
              $('#product-id').val('');
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
              $("label[for=id]").append('<div class="spinner-border spinner-border-sm text-success" school="status"><span class="sr-only">Cargando...</span></div>');
            },
            complete: function () {
              $("label[for=id] .spinner-border").remove();
            }
          })
          .done(function (data) {
            if (typeof data == 'object' && data != null) {
              let product = data.product;
              $('#description').val(product.description); 
              $('#product-id').val(product.id);
            } else {
              $('#description').val('');
              $('#product-id').val('');
            }
          });
        }

        function navigate(keyCode, left = null, right = null) {
          switch(keyCode) {
            case LEFT:
                if (left != null) {
                  if (left == 'personal' || left == 'business') {
                    $('#' + left).select2('focus');
                  } else {
                    $('#' + left).focus();
                  }
                }
              break;

              case RIGHT: case TAB:
                if (right != null) {
                  if (right == 'personal' || right == 'business') {
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
            navigate(e.which, null, 'id');
          }
        });
        $('#id').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'date', 'description');
          } else { 
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTypingCode, doneTypingTimer);
          }
        });
        $('#description').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'id', 'personal');
          }
        });
        $('#personal').next('.select2-container').keydown(function (e) {
          if (e.which == LEFT || e.which == RIGHT || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'description', 'business');
          }
        });
        $('#business').next('.select2-container').keydown(function (e) {
          if (e.which == LEFT || e.which == RIGHT || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'personal', 'reason');
          }
        });
        $('#reason').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'business', 'back');
          }
        });
        $('#back').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'reason', 'save');
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