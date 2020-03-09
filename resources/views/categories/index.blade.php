@extends('layouts.app-sbadmin')

@section('content')
  <h1>Categorías</h1>

  <div class="card w-100 mt-4">
    <div class="card-body">
      <div class="row">
        <div class="col">
          @component('categories.components.category-button', [
            'icon'  => 'tools',
            'name'  => 'Herramientas'
          ])
          @endcomponent
        </div>
      </div>
      <div class="row mt-4">
        <div class="col">
          @component('categories.components.category-button', [
            'icon'  => 'broom',
            'name'  => 'Limpieza'
          ])
          @endcomponent
        </div>
      </div>
      <div class="row mt-4">
        <div class="col">
          @component('categories.components.category-button', [
            'icon'  => 'cog',
            'name'  => 'General'
          ])
          @endcomponent
        </div>
      </div>
      <div class="row mt-4">
        <div class="col">
          @component('categories.components.category-button', [
            'icon'  => 'toilet-paper',
            'name'  => 'Fontanería'
          ])
          @endcomponent
        </div>
      </div>
      <div class="row mt-4">
        <div class="col">
          @component('categories.components.category-button', [
            'icon'  => 'bolt',
            'name'  => 'Electricidad'
          ])
          @endcomponent
        </div>
      </div>
      <div class="row mt-4">
        <div class="col">
          @component('categories.components.category-button', [
            'icon'  => 'fan',
            'name'  => 'Aires Acondicionados'
          ])
          @endcomponent
        </div>
      </div>
      <div class="row mt-4">
        <div class="col">
          @component('categories.components.category-button', [
            'icon'  => 'oil-can',
            'name'  => 'Jardinería'
          ])
          @endcomponent
        </div>
      </div>
      <div class="row mt-4">
        <div class="col">
          @component('categories.components.category-button', [
            'icon'  => 'brush',
            'name'  => 'Píntura'
          ])
          @endcomponent
        </div>
      </div>
      <div class="row mt-4">
        <div class="col">
          @component('categories.components.category-button', [
            'icon'  => 'people-carry',
            'name'  => 'Servicio'
          ])
          @endcomponent
        </div>
      </div>
    </div>
  </div>
@endsection