<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
  <div class="sb-sidenav-menu">
    <div class="nav">
      <div class="sb-sidenav-menu-heading">Panel de administrador</div>
      <a class="nav-link" href="{{ route('dashboard') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
        Inicio
      </a>
      <div class="sb-sidenav-menu-heading">Módulos</div>
      @component('include.parts.nav-link-collapse', [
        'route'         => 'entradas',
        'icon'          => 'sign-in-alt',
        'indexLegend'   => 'Ver todas las entradas',
        'createLegend'  => 'Crear entrada',
      ])
      @endcomponent
      @component('include.parts.nav-link-collapse', [
        'route'         => 'salidas',
        'icon'          => 'sign-out-alt',
        'indexLegend'   => 'Ver todas las salidas',
        'createLegend'  => 'Crear salida',
      ])
      @endcomponent
      <a class="nav-link collapsed {{ Request::is('inventario') || Request::is('categorias') || Request::is('inventario/*') ? 'active' : '' }}" href="#" data-toggle="collapse" data-target="#collapse-inventario" aria-expanded="{{ Request::is('inventario') || Request::is('categorias') || Request::is('inventario/*') ? 'true' : 'false' }}" aria-controls="collapse-inventario">
        <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>Inventario<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
      </a>
      <div class="collapse {{ Request::is('inventario') || Request::is('categorias') || Request::is('inventario/*') ? 'show' : '' }}" id="collapse-inventario" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
          <a class="nav-link" href="{{ route('inventario.index') }}">Ver el inventario</a>
          <a class="nav-link" href="{{ route('categorias.index') }}">Categorías</a>
          <a class="nav-link" href="{{ route('inventario.create') }}">Crear un producto</a>
        </nav>
      </div>
      @component('include.parts.nav-link-collapse', [
        'route'         => 'empleados',
        'icon'          => 'user-friends',
        'indexLegend'   => 'Ver todos los empleados',
        'createLegend'  => 'Crear empleado',
      ])
      @endcomponent
      @component('include.parts.nav-link-collapse', [
        'route'         => 'proveedores',
        'icon'          => 'people-carry',
        'indexLegend'   => 'Ver todos los proveedores',
        'createLegend'  => 'Crear proveedor',
      ])
      @endcomponent
      @component('include.parts.nav-link-collapse', [
        'route'         => 'reparaciones',
        'icon'          => 'toolbox',
        'indexLegend'   => 'Ver todas las reparaciones',
        'createLegend'  => 'Crear reparación',
      ])
      @endcomponent
      <div class="sb-sidenav-menu-heading">Extras</div>
      <a class="nav-link" href="{{ route('reportes.index') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
        Reportes
      </a>
    </div>
  </div>
  <div class="sb-sidenav-footer">
    <div class="small">Sesión iniciada como:</div>
    <span class="text-light">{{ auth()->user()->username }}</span>
  </div>
</nav>