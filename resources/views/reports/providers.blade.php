<table>
  <thead>
    <tr>
      <th style="width:11px; background-color: #b2bec3;">Fecha</th>
      <th style="width:8px; background-color: #b2bec3;">Código</th>
      <th style="width:60px; background-color: #b2bec3;">Descripción</th>
      <th style="width:8px; background-color: #b2bec3;">Entrada</th>
      <th style="width:8px; background-color: #b2bec3;">Unidad</th>
      <th style="width:20px; background-color: #b2bec3;">Factura</th>
      <th style="width:33px; background-color: #b2bec3;">Proveedor</th>
      <th style="width:17px; background-color: #b2bec3;">Lugar</th>
      <th style="width:60px; background-color: #b2bec3;">Observación</th>
    </tr>
  </thead>
  <tbody>
    @foreach($entries as $entry)
      <tr>
        <td>{{ $entry->date ? $entry->date->format('Y-m-d') : 'N/A' }}</td>
        <td>{{ $entry->product ? ($entry->product->category ? $entry->product->category->prefix.$entry->product->code : 'N/A') : 'N/A' }}</td>
        <td>{{ $entry->product ? $entry->product->description : 'N/A' }}</td>
        <td>{{ $entry->quantity ? $entry->quantity : 'N/A' }}</td>
        <td>{{ $entry->unit ? $entry->unit->description : 'N/A' }}</td>
        <td>{{ $entry->bill ? $entry->bill : 'N/A' }}</td>
        <td>{{ $entry->provider ? $entry->provider->name : 'N/A' }}</td>
        <td>{{ $entry->place ? $entry->place->description : 'N/A' }}</td>
        <td>{{ $entry->observation ? $entry->observation->description : 'N/A' }}</td>
      </tr>
    @endforeach
  </tbody>
</table>