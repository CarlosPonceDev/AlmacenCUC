@extends('layouts.app-sbadmin')

@section('content')
  <h1>Categorías</h1>

  <div class="w-100">
    @foreach ($categories as $category)
      <div class="row mt-4">
        <div class="col">
          @component('categories.components.category-button', [
            'icon'  => $category->icon,
            'name'  => $category->description
          ])
          @endcomponent
        </div>
      </div>
    @endforeach
  </div>
@endsection