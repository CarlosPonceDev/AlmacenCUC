@extends('layouts.app-sbadmin')

@section('content')
  <h1>Reparaciones</h1>

  <div class="d-flex justify-content-end">
    <button class="btn btn-primary">
      Nueva reparación
    </button>
  </div>

  <div class="mt-4">
    <table class="table table-sm table-hover datatable">
      <thead class="thead-dark">
        <tr>
          <th>Fecha</th>
          <th>Descripción</th>
          <th>ID</th>
          <th>Motivo de reparación</th>
          <th>Personal</th>
          <th>Empresa</th>
          <th>Fecha de entrega</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>2020-01-20</td>
          <td>Bomba de cisterna</td>
          <td>S/N</td>
          <td>Mantenimiento</td>
          <td>Francisco Patiño</td>
          <td>Patiño</td>
          <td>2020-02-01</td>
          <td>
            <button class="btn btn-primary"><i class="fas fa-undo"></i></button>
            <button class="btn btn-warning"><i class="fas fa-pen"></i></button>
            <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
@endsection