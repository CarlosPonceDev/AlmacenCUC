<a href="{{ isset($link) ? route($link) : '#' }}" class="btn btn-block border btn-lg">
  <div class="row">
    <div class="col-2 border-right">
      <i class="fas fa-{{ $icon }} fa-4x"></i>
    </div>
    <div class="col d-flex justify-content-start align-items-center">
      <h1>{{ $name }}</h1>
    </div>
  </div>
</a>