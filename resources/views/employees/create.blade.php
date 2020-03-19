@extends('layouts.app-sbadmin')

@section('content')
  <h1 class="mb-3">Crear empleado</h1>

  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('empleados.index') }}">Empleados</a></li>
    <li class="breadcrumb-item active">Crear empleado</li>
  </ol>

  <div class="card w-100 mt-4">
    <div class="card-header"><i class="fas fa-table mr-1"></i>Crear empleado</div>
    <div class="card-body">
      <form action="{{ route('empleados.store') }}" method="POST">
        @csrf
        <div class="row">
          <div class="col-12 col-lg-8 mb-2">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Nombre..." autofocus>
          </div>
          <div class="col-12 col-lg-4 mb-2">
            <label for="department">Departamento:</label>
            <select name="department" id="department" class="custom-select">
              @foreach ($departments as $department)
                <option value="{{ $department->name }}">{{ $department->description }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col">
            <button type="submit" id="save" class="btn btn-lg btn-block btn-primary">Guadar empleado</button>
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
              url: '{{ route("fetch.employees") }}',
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
            navigate(e.which, null, 'department');
          }
        });
        $('#department').keydown(function (e) {
          if (e.which == LEFT || e.which == RIGHT || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'name', 'save');
          }
        });
        $('#save').keydown(function (e) {
          if (e.which == LEFT || e.which == RIGHT || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'department', null);
          }
        });
      }
    </script>
@endpush