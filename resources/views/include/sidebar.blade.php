<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
  <div class="sb-sidenav-menu">
    <div class="nav">
      <div class="sb-sidenav-menu-heading">Panel de administrador</div>
      <a class="nav-link" href="{{ route('dashboard') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
        Inicio
      </a>
      <div class="sb-sidenav-menu-heading">Módulos</div>
      <a class="nav-link collapsed {{ Request::is('entradas') || Request::is('entradas/*') ? 'active' : '' }}" href="#" data-toggle="collapse" data-target="#collapse-entries" aria-expanded="{{ Request::is('entradas') || Request::is('entradas/*') ? 'true' : 'false' }}" aria-controls="collapse-entries">
        <div class="sb-nav-link-icon"><i class="fas fa-sign-in-alt"></i></div>Entradas<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
      </a>
      <div class="collapse {{ Request::is('entradas') || Request::is('entradas/*') ? 'show' : '' }}" id="collapse-entries" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
          <a class="nav-link" href="{{ route('entradas.index') }}">Ver todas las entradas</a>
          <a class="nav-link" href="{{ route('entradas.create') }}">Crear entrada</a>
        </nav>
      </div>
      {{-- <a class="nav-link" href="{{ route('entradas.create') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-sign-in-alt"></i></div>
        Entradas
      </a> --}}
      <a class="nav-link collapsed {{ Request::is('salidas') || Request::is('salidas/*') ? 'active' : '' }}" href="#" data-toggle="collapse" data-target="#collapse-salidas" aria-expanded="{{ Request::is('salidas') || Request::is('salidas/*') ? 'true' : 'false' }}" aria-controls="collapse-salidas">
        <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>Salidas<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
      </a>
      <div class="collapse {{ Request::is('salidas') || Request::is('salidas/*') ? 'show' : '' }}" id="collapse-salidas" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
          <a class="nav-link" href="{{ route('salidas.index') }}">Ver todas las salidas</a>
          <a class="nav-link" href="{{ route('salidas.create') }}">Crear entrada</a>
        </nav>
      </div>
      {{-- <a class="nav-link" href="{{ route('salidas.create') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
        Salidas
      </a> --}}
      <a class="nav-link" href="{{ route('categorias.index') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-th"></i></div>
        Categorías
      </a>
      <a class="nav-link" href="{{ route('inventario.index') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
        Inventario
      </a>
      <a class="nav-link" href="{{ route('reportes.index') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
        Reportes
      </a>
      <a class="nav-link" href="{{ route('empleados.index') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
        Empleados
      </a>
      <a class="nav-link" href="{{ route('proveedores.index') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-people-carry"></i></div>
        Proveedores
      </a>
      <a class="nav-link" href="{{ route('reparaciones.index') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-toolbox"></i></div>
        Reparaciones
      </a>
    </div>
  </div>
  <div class="sb-sidenav-footer">
    <div class="small">Sesión iniciada como:</div>
    <span class="text-light">{{ auth()->user()->username }}</span>
  </div>
</nav>