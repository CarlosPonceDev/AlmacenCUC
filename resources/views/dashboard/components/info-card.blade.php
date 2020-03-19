<div class="card">
  <a href="{{ route($link) }}" class="text-dark" style="text-decoration: none !important">
    <div class="d-flex flex-row">
      <div class="bg-{{ $color }} d-flex justify-content-center">
        <span class="m-3 text-light">{!! $icon !!}</span>
      </div>
      <div class="my-3 ml-3">
        <span class="h2">{{ $count }}</span><br>
        <span class="lead">{{ $name }}</span>
      </div>
    </div>
  </a>
</div>