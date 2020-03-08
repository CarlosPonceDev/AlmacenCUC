@extends('layouts.app-sbadmin')

@section('content')
  <div class="row">
    <div class="col-3">
      @component('dashboard.components.info-card', [
          'color' => 'primary',
          'icon'  => '<i class="fas fa-tools fa-4x"></i>',
          'count' => '1000',
          'name'  => 'Productos'
      ])@endcomponent
    </div>

    <div class="col-3">
      @component('dashboard.components.info-card', [
          'color' => 'info',
          'icon'  => '<i class="fas fa-briefcase fa-4x"></i>',
          'count' => '132',
          'name'  => 'Empleados'
      ])@endcomponent
    </div>

    <div class="col-3">
      @component('dashboard.components.info-card', [
          'color' => 'success',
          'icon'  => '<i class="fas fa-truck fa-4x"></i>',
          'count' => '33',
          'name'  => 'Proveedores'
      ])@endcomponent
    </div>

    <div class="col-3">
      @component('dashboard.components.info-card', [
          'color' => 'danger',
          'icon'  => '<i class="fas fa-th-large fa-4x"></i>',
          'count' => '9',
          'name'  => 'Categorías'
      ])@endcomponent
    </div>
  </div>

  <div class="row my-5">
    <table class="table table-hover">
      <thead class="thead-dark">
        <tr>
          <th>Descripción</th>
          <th>Cantidad</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Bolsa</td>
          <td>10</td>
          <td class="lead"><span class="badge badge-danger w-100">Peligro</span></td>
        </tr>
      </tbody>
    </table>
  </div>
@endsection