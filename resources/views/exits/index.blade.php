@extends('layouts.app-sbadmin')

@section('content')
  <h1>Salida</h1>

  <div class="card w-100 mt-4">
    <div class="card-body">
      <form action="#" method="post">
        <div class="row">
          <div class="col-3">
            <label for="date">Fecha:</label>
            <input type="date" name="date" id="date" class="form-control">
          </div>
          <div class="col-2">
            <label for="code">Código:</label>
            <input type="text" name="code" id="code" class="form-control" placeholder="Código...">
          </div>
          <div class="col-7">
            <label for="description">Descripción:</label>
            <input type="text" name="description" id="description" class="form-control" placeholder="Descripción...">
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-5">
            <label for="employee">Empleado:</label>
            <select name="employee" id="employee" class="select2 custom-select">
              <option value="1">Hola</option>
            </select>
          </div>
          <div class="col-2">
            <label for="stock">Cantidad:</label>
            <input type="text" name="stock" id="stock" class="form-control">
          </div>
          <div class="col-2">
            <label for="unit">Unidad:</label>
            <input type="text" name="unit" id="unit" class="form-control">
          </div>
          <div class="col-3">
            <label for="place">Lugar:</label>
            <select name="place" id="place" class="custom-select">
              <option value="1">Hola</option>
            </select>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col">
            <label for="observations">Observaciones</label>
            <textarea name="observations" id="observations" cols="30" rows="10" class="form-control"></textarea>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col">
            <button type="button" class="btn btn-lg btn-block btn-primary">Guadar salida</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection