@extends('layouts.app-sbadmin')

@section('content')
  <div class="row">
    <div class="col-3">
      @component('dashboard.components.info-card', [
        'link'  => 'inventario.index',
        'color' => 'primary',
        'icon'  => '<i class="fas fa-tools fa-4x"></i>',
        'count' => $products_count,
        'name'  => 'Productos'
      ])@endcomponent
    </div>

    <div class="col-3">
      @component('dashboard.components.info-card', [
        'link'  => 'empleados.index',
        'color' => 'info',
        'icon'  => '<i class="fas fa-briefcase fa-4x"></i>',
        'count' => $employees_count,
        'name'  => 'Empleados'
      ])@endcomponent
    </div>

    <div class="col-3">
      @component('dashboard.components.info-card', [
        'link'  => 'proveedores.index',
        'color' => 'success',
        'icon'  => '<i class="fas fa-truck fa-4x"></i>',
        'count' => $providers_count,
        'name'  => 'Proveedores'
      ])@endcomponent
    </div>

    <div class="col-3">
      @component('dashboard.components.info-card', [
        'link'  => 'categorias.index',
        'color' => 'danger',
        'icon'  => '<i class="fas fa-th-large fa-4x"></i>',
        'count' => $categories_count,
        'name'  => 'Categorías'
      ])@endcomponent
    </div>
  </div>

  <div class="row my-5">
    <table class="table table-hover w-100" id="table-minimum">
      <thead class="thead-dark">
        <tr>
          <th>Descripción</th>
          <th>Código</th>
          <th>Cantidad</th>
          <th>Estado</th>
        </tr>
      </thead>
    </table>
  </div>
@endsection

@push('inline-scripts')
    <script>
      window.onload = function() {
        $('#table-minimum').DataTable({
          serverSide: true,
          ajax: "{{ route('laratables.minimum') }}",
          columns: [
            { name: 'description' },
            { name: 'code' },
            { name: 'total' },
            { name: 'action', orderable: false, searchable: false },
          ]
        });
      }
    </script>
@endpush