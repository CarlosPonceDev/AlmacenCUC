@extends('layouts.app-sbadmin')

@section('content')
  <h1>Proveedores</h1>

  <div class="d-flex justify-content-end">
    <button class="btn btn-primary">
      Nuevo proveedor
    </button>
  </div>

  <div class="mt-4">
    <table class="table table-hover datatable">
      <thead class="thead-dark">
        <tr>
          <th>Nombre</th>
          <th>Código</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>ALDO</td>
          <td>31</td>
          <td>
            <button class="btn btn-warning"><i class="fas fa-pen"></i></button>
            <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
@endsection