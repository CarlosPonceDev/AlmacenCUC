@extends('layouts.app')

@section('content')
  <h1 class="mb-4">Categorías</h1>

  <div class="card">
    <div class="card-header"><i class="fas fa-table mr-1"></i>Categorias</div>
    <div class="card-body">
      @foreach ($categories as $category)
        <div class="row mb-3">
          <div class="col">
            @component('categories.components.category-button', [
              'category'  => $category
            ])
            @endcomponent
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection