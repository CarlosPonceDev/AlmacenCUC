@extends('layouts.app-sbadmin')

@section('content')
  <h1 class="mb-3">Editar proveedor</h1>

  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('proveedores.index') }}">Proveedores</a></li>
    <li class="breadcrumb-item active">Editar proveedor</li>
  </ol>

  <div class="card w-100 mt-4">
    <div class="card-header"><i class="fas fa-table mr-1"></i>Editar proveedor</div>
    <div class="card-body">
      <form action="{{ route('proveedores.update', $provider->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" value="{{ $provider->name }}" class="form-control" placeholder="Nombre..." autofocus>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col">
            <a href="{{ route('proveedores.index') }}"><button type="button" id="back" class="btn btn-lg btn-block btn-secondary"><i class="fas fa-arrow-left mr-3"></i>Regresar</button></a>
          </div>
          <div class="col">
            <button type="submit" id="save" class="btn btn-lg btn-block btn-primary"><i class="fas fa-check mr-3"></i>Editar proveedor</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('inline-scripts')
    <script>
      window.onload = function(){
        $('#name').autocomplete({
          source: function (request, response) {
            $.ajax({
              url: '{{ route("fetch.providers") }}',
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
        $('#name').keydown(function (e) {
          if (e.which == LEFT || e.which == UP || e.which == RIGHT || e.which == DOWN || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, null, 'back');
          }
        });
        $('#back').keydown(function (e) {
          if (e.which == LEFT || e.which == RIGHT || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'name', 'save');
          }
        });
        $('#save').keydown(function (e) {
          if (e.which == LEFT || e.which == RIGHT || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'back', null);
          }
        });
      }
    </script>
@endpush