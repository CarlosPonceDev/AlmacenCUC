@extends('layouts.app')

@section('content')
  <div class="row mb-4">
    <div class="col-3 pr-0">
      @component('dashboard.components.info-card', [
        'link'  => 'inventario.index',
        'color' => 'primary',
        'icon'  => '<i class="fas fa-tools fa-4x"></i>',
        'count' => $products_count,
        'name'  => 'Productos'
      ])@endcomponent
    </div>

    <div class="col-3 pr-0">
      @component('dashboard.components.info-card', [
        'link'  => 'empleados.index',
        'color' => 'info',
        'icon'  => '<i class="fas fa-briefcase fa-4x"></i>',
        'count' => $employees_count,
        'name'  => 'Empleados'
      ])@endcomponent
    </div>

    <div class="col-3 pr-0">
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

  <div class="card">
    <div class="card-header"><i class="fas fa-table mr-1"></i>Mínima</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover table-striped" id="table-minimum" width="100%">
          <thead class="thead-dark">
            <tr>
              <th>Código</th>
              <th>Descripción</th>
              <th>Cantidad</th>
              <th>Estado</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
@endsection

@push('inline-scripts')
    <script>
      window.onload = function() {
        $('#table-minimum').DataTable({
          serverSide: true,
          ajax: "{{ route('laratables.minimum') }}",
          columns: [
            { name: 'code' },
            { name: 'description' },
            { name: 'total' },
            { name: 'action', orderable: false, searchable: false },
          ],
          language: language
        });
      }
    </script>
@endpush