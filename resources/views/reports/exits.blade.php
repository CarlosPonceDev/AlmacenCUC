<table>
  <thead>
    <tr>
      <th style="width:11px; background-color: #b2bec3;">Fecha</th>
      <th style="width:8px; background-color: #b2bec3;">Código</th>
      <th style="width:60px; background-color: #b2bec3;">Descripción</th>
      <th style="width:8px; background-color: #b2bec3;">Entrada</th>
      <th style="width:8px; background-color: #b2bec3;">Unidad</th>
      <th style="width:33px; background-color: #b2bec3;">Empleado</th>
      <th style="width:17px; background-color: #b2bec3;">Lugar</th>
      <th style="width:60px; background-color: #b2bec3;">Observación</th>
    </tr>
  </thead>
  <tbody>
    @foreach($exits as $exit)
      <tr>
        <td>{{ $exit->date ? $exit->date->format('Y-m-d') : 'N/A' }}</td>
        <td>{{ $exit->product ? ($exit->product->category ? $exit->product->category->prefix.$exit->product->code : 'N/A') : 'N/A' }}</td>
        <td>{{ $exit->product ? $exit->product->description : 'N/A' }}</td>
        <td>{{ $exit->quantity ? $exit->quantity : 'N/A' }}</td>
        <td>{{ $exit->unit ? $exit->unit->description : 'N/A' }}</td>
        <td>{{ $exit->employee ? $exit->employee->name : 'N/A' }}</td>
        <td>{{ $exit->place ? $exit->place->description : 'N/A' }}</td>
        <td>{{ $exit->observation ? $exit->observation->description : 'N/A' }}</td>
      </tr>
    @endforeach
  </tbody>
</table>