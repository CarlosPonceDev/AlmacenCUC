@extends('layouts.app-sbadmin')

@section('content')
  <h1>Reportes</h1>

  <div class="card">
    <div class="card-header"><i class="fas fa-table mr-1"></i>Reportes</div>
    <div class="card-body">
      <div class="row">
        <div class="col">
          @component('reports.components.category-button', [
            'icon'  => 'sign-in-alt',
            'name'  => 'Entradas',
            'link'  => 'entradas.index'
          ])
          @endcomponent
        </div>
      </div>
      <div class="row mt-4">
        <div class="col">
          @component('reports.components.category-button', [
            'icon'  => 'sign-out-alt',
            'name'  => 'Salidas',
            'link'  => 'salidas.index'
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
  </div>
@endsection