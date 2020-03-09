@extends('layouts.app-sbadmin')

@section('content')
  <h1>Reportes</h1>

  <div class="w-100 mt-4">
    <div class="row">
      <div class="col">
        @component('reports.components.category-button', [
          'icon'  => 'sign-in-alt',
          'name'  => 'Entradas'
        ])
        @endcomponent
      </div>
    </div>
    <div class="row mt-4">
      <div class="col">
        @component('reports.components.category-button', [
          'icon'  => 'sign-out-alt',
          'name'  => 'Salidas'
        ])
        @endcomponent
      </div>
    </div>
    <div class="row mt-4">
      <div class="col">
        @component('reports.components.category-button', [
          'icon'  => 'calendar-alt',
          'name'  => 'Mensuales'
        ])
        @endcomponent
      </div>
    </div>
    <div class="row mt-4">
      <div class="col">
        @component('reports.components.category-button', [
          'icon'  => 'broom',
          'name'  => 'Materiales'
        ])
        @endcomponent
      </div>
    </div>
    <div class="row mt-4">
      <div class="col">
        @component('reports.components.category-button', [
          'icon'  => 'people-carry',
          'name'  => 'Proveedores'
        ])
        @endcomponent
      </div>
    </div>
    <div class="row mt-4">
      <div class="col">
        @component('reports.components.category-button', [
          'icon'  => 'users',
          'name'  => 'Empleados'
        ])
        @endcomponent
      </div>
    </div>
  </div>
@endsection