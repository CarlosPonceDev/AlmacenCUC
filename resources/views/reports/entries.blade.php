<table>
  <thead>
    <tr>
      <th>Fecha</th>
      <th>Código</th>
      <th>Descripción</th>
      <th>Entrada</th>
      <th>Unidad</th>
      <th>Factura</th>
      <th>Proveedor</th>
      <th>Lugar</th>
      <th>Observación</th>
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