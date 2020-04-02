<a class="nav-link collapsed {{ Request::is($route) || Request::is($route.'/*') ? 'active' : '' }}" href="#" data-toggle="collapse" data-target="#collapse-{{ $route }}" aria-expanded="{{ Request::is($route) || Request::is($route.'/*') ? 'true' : 'false' }}" aria-controls="collapse-{{ $route }}">
  <div class="sb-nav-link-icon"><i class="fas fa-{{ $icon }}"></i></div>{{ ucfirst($route) }}<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse {{ Request::is($route) || Request::is($route.'/*') ? 'show' : '' }}" id="collapse-{{ $route }}" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
  <nav class="sb-sidenav-menu-nested nav">
    <a class="nav-link" href="{{ route($route.'.index') }}">{{ $indexLegend }}</a>
    <a class="nav-link" href="{{ route($route.'.create') }}">{{ $createLegend }}</a>
  </nav>
</div>