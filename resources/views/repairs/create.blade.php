@extends('layouts.app-sbadmin')

@section('content')
  <h1 class="mb-3">Crear reparación</h1>

  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('reparaciones.index') }}">Reparaciones</a></li>
    <li class="breadcrumb-item active">Crear reparación</li>
  </ol>

  <div class="card w-100 mt-4">
    <div class="card-header"><i class="fas fa-table mr-1"></i>Crear reparación</div>
    <div class="card-body">
      <form action="{{ route('reparaciones.store') }}" method="POST">
        @csrf
        <div class="row">
          <div class="col-12 col-lg-3 mb-2">
            <label for="date">Fecha:</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ date('Y-m-d') }}">
          </div>
          <div class="col-12 col-lg-3 mb-2">
            <label for="id">ID:</label>
            <input type="text" name="id" id="id" class="form-control" autofocus>
          </div>
          <div class="col-12 col-lg-6 mb-2">
            <label for="description">Descripción del producto:</label>
            <input type="text" name="description" id="description" class="form-control" autocomplete="off">
          </div>
          <div class="col-12 col-lg-3 mb-2">
            <label for="personal">Personal:</label>
            <select name="personal" id="personal" class="custom-select">
              @foreach ($personals as $personal)
                <option value="{{ $personal->id }}">{{ $personal->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-12 col-lg-3 mb-2">
            <label for="business">Empresa:</label>
            <select name="business" id="business" class="custom-select">
              @foreach ($businesses as $business)
                <option value="{{ $business->id }}">{{ $business->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-12 col-lg-6 mb-2">
            <label for="reason">Motivo de reparación:</label>
            <input type="text" name="reason" id="reason" class="form-control" autofocus>
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
            navigate(e.which, null, 'id');
          }
        });
        $('#id').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'date', 'description');
          }
        });
        $('#description').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'id', 'personal');
          }
        });
        $('#personal').keydown(function (e) {
          if (e.which == LEFT || e.which == RIGHT || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'description', 'business');
          }
        });
        $('#business').keydown(function (e) {
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