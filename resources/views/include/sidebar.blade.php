<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
  <div class="sb-sidenav-menu">
    <div class="nav">
      <div class="sb-sidenav-menu-heading">Panel de administrador</div>
      <a class="nav-link" href="{{ route('dashboard') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
        Inicio
      </a>
      <a class="nav-link" href="{{ route('entradas.index') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-sign-in-alt"></i></div>
        Entradas
      </a>
      <a class="nav-link" href="{{ route('salidas.index') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
        Salidas
      </a>
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
    </div>
  </div>
  <div class="sb-sidenav-footer">
    <div class="small">Logged in as:</div>
    Start Bootstrap
  </div>
</nav>