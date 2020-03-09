@extends('layouts.app-sbadmin')

@section('content')
  <h1>Entrada</h1>

  <div class="card w-100 mt-4">
    <div class="card-body">
      <form action="{{ route('entradas.store') }}" method="post">
        @csrf
        <div class="row">
          <div class="col-3">
            <label for="date">Fecha:</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ date('Y-m-d') }}">
          </div>
          <div class="col-2">
            <label for="code">Código:</label>
            <input type="text" name="code" id="code" class="form-control text-uppercase" placeholder="Código..." autofocus>
          </div>
          <div class="col-7">
            <label for="description">Descripción:</label>
            <input type="text" name="description" id="description" class="form-control" placeholder="Descripción...">
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-5">
            <label for="category">Categoría:</label>
            <select name="category" id="category" class="custom-select">
              @foreach ($categories as $category)
                <option value="{{ $category->name }}">{{ $category->description }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-2">
            <label for="stock">Cantidad:</label>
            <input type="text" name="stock" id="stock" class="form-control">
          </div>
          <div class="col-3">
            <label for="unit">Unidad:</label>
            <select name="unit" id="unit" class="custom-select">
              @foreach ($units as $unit)
                <option value="{{ $unit->name }}">{{ $unit->description }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-2">
            <label for="minimum">Mínima:</label>
            <input type="text" name="minimum" id="minimum" class="form-control">
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-5">
            <label for="provider">Proveedor:</label>
            <select name="provider" id="provider" class="select2 custom-select">
              @foreach ($providers as $provider)
                  <option value="{{ $provider->id }}">{{ $provider->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-4">
            <label for="bill">Factura:</label>
            <input type="text" name="bill" id="bill" class="form-control">
          </div>
          <div class="col-3">
            <label for="place">Lugar:</label>
            <select name="place" id="place" class="custom-select">
              @foreach ($places as $place)
                  <option value="{{ $place->name }}">{{ $place->description }}</option>
              @endforeach
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
            <button type="submit" class="btn btn-lg btn-block btn-primary">Guadar entrada</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('inline-scripts')
    <script>
      window.onload = function(){
        $('form').submit(function (e) {
            $('body').prepend('<div class="loader"></div>');
            e.submit();
        });
        @if (Session::has('success'))
          notifier.success('{{ Session::get("success") }}', {
            labels: {
              success: 'Éxito'
            }
          });
        @endif
      }
    </script>
@endpush