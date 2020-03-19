<a href="{{ route('inventario.category', $category->name) }}">
  <button class="btn btn-block border btn-lg">
    <div class="row">
      <div class="col-2 border-right">
        <i class="fas fa-{{ $category->icon }} fa-4x"></i>
      </div>
      <div class="col d-flex justify-content-start align-items-center">
        <h1>{{ $category->description }}</h1>
      </div>
    </div>
  </button>
</a>