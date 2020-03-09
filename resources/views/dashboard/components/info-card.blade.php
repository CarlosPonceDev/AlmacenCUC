<div class="card pr-0">
  <a href="{{ route($link) }}" class="text-dark" style="text-decoration: none !important">
    <div class="row">
      <div class="col-5 bg-{{ $color }} d-flex justify-content-center">
        <span class="m-3 text-light">{!! $icon !!}</span>
      </div>
      <div class="col">
        <div class="my-3">
          <span class="h2">{{ $count }}</span><br>
          <span class="lead">{{ $name }}</span>
        </div>
      </div>
    </div>
  </a>
</div>