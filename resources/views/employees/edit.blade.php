@extends('layouts.app-sbadmin')

@section('content')
  <h1 class="mb-3">Editar empleado</h1>

  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('empleados.index') }}">Empleados</a></li>
    <li class="breadcrumb-item active">Editar empleado</li>
  </ol>

  <div class="card w-100 mt-4">
    <div class="card-header"><i class="fas fa-table mr-1"></i>Editar empleado</div>
    <div class="card-body">
      <form action="{{ route('empleados.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-12 col-lg-6 mb-2">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" value="{{ $employee->name }}" class="form-control" placeholder="Nombre..." autofocus>
          </div>
          <div class="col-12 col-lg-6 mb-2">
            <label for="department">Departamento:</label>
            <select name="department" id="department" class="custom-select select2-tags">
              @foreach ($departments as $department)
                <option value="{{ $department->name }}" {{ $employee->department->id == $department->id ? 'selected' : '' }}>{{ $department->description }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col">
            <a href="{{ route('empleados.index') }}"><button type="button" id="back" class="btn btn-lg btn-block btn-secondary"><i class="fas fa-arrow-left mr-3"></i>Regresar</button></a>
          </div>
          <div class="col">
            <button type="submit" id="save" class="btn btn-lg btn-block btn-success"><i class="fas fa-check mr-3"></i>Guadar empleado</button>
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
                  if (left == 'department') {
                    $('#' + left).select2('focus');
                  } else {
                    $('#' + left).focus();
                  }
                }
              break;

              case RIGHT: case TAB:
                if (right != null) {
                  if (right == 'department') {
                    $('#' + right).select2('focus');
                  } else {
                    $('#' + right).focus();
                  }
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
        $('#department').next('.select2-container').keydown(function (e) {
          if (e.which == LEFT || e.which == RIGHT || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'name', 'back');
          }
        });
        $('#back').keydown(function (e) {
          if (e.which == LEFT || e.which == RIGHT || e.which == TAB) {
            e.preventDefault();
            navigate(e.which, 'department', 'save');
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