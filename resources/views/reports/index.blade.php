@extends('layouts.app')

@section('content')
  <h1>Reportes</h1>

  <div class="card">
    <div class="card-header"><i class="fas fa-table mr-1"></i>Reportes</div>
    <div class="card-body">
      <div class="row">
        <div class="col">
          @component('reports.components.category-button', [
            'icon'  => 'sign-in-alt',
            'name'  => 'Entradas',
            'link'  => 'entradas.index'
          ])
          @endcomponent
        </div>
      </div>
      <div class="row mt-4">
        <div class="col">
          @component('reports.components.category-button', [
            'icon'  => 'sign-out-alt',
            'name'  => 'Salidas',
            'link'  => 'salidas.index'
          ])
          @endcomponent
        </div>
      </div>
      <div class="row mt-4">
        <div class="col">
          @component('reports.components.category-button', [
            'icon'  => 'people-carry',
            'name'  => 'Proveedores',
            'modal' => 'providers'
          ])
          @endcomponent
        </div>
      </div>
      <div class="row mt-4">
        <div class="col">
          @component('reports.components.category-button', [
            'icon'  => 'users',
            'name'  => 'Empleados',
            'modal' => 'employees'
          ])
          @endcomponent
        </div>
      </div>
    </div>
  </div>
@endsection

@section('modals')
<div class="modal fade" id="modal-providers" tabindex="-1" role="dialog" aria-labelledby="modal-providers-label" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-providers-label">Reporte de proveedores</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('reports.providers') }}" method="get" target="_blank">
        @csrf
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-12 col-md-6">
                <label for="start-date">Fecha inicial:</label>
                <input type="date" class="form-control" name="start-date" id="start-date" value="{{ date('Y-m-01') }}">
              </div>
              <div class="col-12 col-md-6">
                <label for="end-date">Fecha final:</label>
                <input type="date" class="form-control" name="end-date" id="end-date" value="{{ date('Y-m-d') }}">
              </div>
              <div class="col-12">
                <label for="provider">Proveedor:</label>
                <select name="provider" id="provider" class="select2">
                  <option value="all">Todos los proveedores</option>
                  @foreach ($providers as $provider)
                      <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            {{-- <div class="row mb-2">
              <div class="col">
                <button type="button" class="btn btn-link" data-toggle="collapse" href="#collapse-advanced" role="button" aria-expanded="false" aria-controls="collapse-advanced">
                  Opciones de reporte avanzadas
                </button>
              </div>
            </div>
            <div class="collapse" id="collapse-advanced">
              <div class="card card-body">
                <div class="row">
                  <div class="col-12 col-md-4 mb-2">
                    <label for="code">Código:</label>
                    <input type="text" name="code" id="code" class="form-control">
                  </div>
                  <div class="col-12 col-md-8 mb-2">
                    <label for="description">Descripción:</label>
                    <input type="text" name="description" id="description" class="form-control">
                  </div>
                  <div class="col-12 mb-2">
                    <label for="provider">Proveedor:</label>
                    <select name="provider" id="provider" class="select2">
                      <option value="">-- Seleccione el proveedor --</option>
                      @foreach ($providers as $provider)
                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div> --}}
          </div>
        </div>
        <div class="modal-footer">
          <div class="col">
            <button type="button" class="btn btn-block btn-lg btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
          <div class="col">
            <button type="submit" class="btn btn-block btn-lg btn-primary">Generar reporte</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-employees" tabindex="-1" role="dialog" aria-labelledby="modal-employees-label" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-employees-label">Reporte de empleados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('reports.employees') }}" method="get" target="_blank">
        @csrf
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-12 col-md-6">
                <label for="start-date">Fecha inicial:</label>
                <input type="date" class="form-control" name="start-date" id="start-date" value="{{ date('Y-m-01') }}">
              </div>
              <div class="col-12 col-md-6">
                <label for="end-date">Fecha final:</label>
                <input type="date" class="form-control" name="end-date" id="end-date" value="{{ date('Y-m-d') }}">
              </div>
              <div class="col-12">
                <label for="employee">Empleados:</label>
                <select name="employee" id="employee" class="select2">
                  <option value="all">Todos los empleados</option>
                  @foreach ($employees as $employee)
                      <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            {{-- <div class="row mb-2">
              <div class="col">
                <button type="button" class="btn btn-link" data-toggle="collapse" href="#collapse-advanced" role="button" aria-expanded="false" aria-controls="collapse-advanced">
                  Opciones de reporte avanzadas
                </button>
              </div>
            </div>
            <div class="collapse" id="collapse-advanced">
              <div class="card card-body">
                <div class="row">
                  <div class="col-12 col-md-4 mb-2">
                    <label for="code">Código:</label>
                    <input type="text" name="code" id="code" class="form-control">
                  </div>
                  <div class="col-12 col-md-8 mb-2">
                    <label for="description">Descripción:</label>
                    <input type="text" name="description" id="description" class="form-control">
                  </div>
                  <div class="col-12 mb-2">
                    <label for="provider">Proveedor:</label>
                    <select name="provider" id="provider" class="select2">
                      <option value="">-- Seleccione el proveedor --</option>
                      @foreach ($providers as $provider)
                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div> --}}
          </div>
        </div>
        <div class="modal-footer">
          <div class="col">
            <button type="button" class="btn btn-block btn-lg btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
          <div class="col">
            <button type="submit" class="btn btn-block btn-lg btn-primary">Generar reporte</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection