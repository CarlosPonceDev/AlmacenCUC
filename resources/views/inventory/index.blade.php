@extends('layouts.app-sbadmin')

@section('content')
  <h1>Inventario</h1>

  <div class="d-flex justify-content-end">
    <button class="btn btn-primary">
      Nuevo producto
    </button>
  </div>

  <div class="mt-4">
    <table class="table table-hover table-responsive datatable">
      <thead class="thead-dark">
        <tr>
          <th>Código</th>
          <th>Descripción</th>
          <th>Categoría</th>
          <th>CUC</th>
          <th>Tomatlán</th>
          <th>Gourmet</th>
          <th>Entradas</th>
          <th>Salidas</th>
          <th>Observaciones</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>H1</td>
          <td>Pala de cortar</td>
          <td>Herramienta</td>
          <td>100</td>
          <td>0</td>
          <td>0</td>
          <td>100</td>
          <td>0</td>
          <td>Holakas jdhksajhdsajkdh askhjdgsjahg dsaggahjgda shsakj dhajkdkjhsa kdhajkdsk glaskjdsajkldjsa asljdkjsalkjkdas lasj dlkjal</td>
          <td>
            <button class="btn btn-warning"><i class="fas fa-pen"></i></button>
            <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
@endsection