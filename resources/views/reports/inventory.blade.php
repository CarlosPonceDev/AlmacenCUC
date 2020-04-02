<table>
  <thead>
    <tr>
      <th style="width:8px; background-color: #b2bec3;">Código</th>
      <th style="width:70px; background-color: #b2bec3;">Descripción</th>
      <th style="width:21px; background-color: #b2bec3;">Categoría</th>
      <th style="width:11px; background-color: #b2bec3;">Stock final</th>
      <th style="width:15px; background-color: #b2bec3;">Stock Tomatlán</th>
      <th style="width:15px; background-color: #b2bec3;">Stock Gourmet</th>
      <th style="width:9px; background-color: #b2bec3;">Entradas</th>
      <th style="width:8px; background-color: #b2bec3;">Salidas</th>
      <th style="width:12px; background-color: #b2bec3;">Stock inicial</th>
    </tr>
  </thead>
  <tbody>
    @foreach($inventory as $product)
      <tr>
        <td> {{ $product->code }} </td>
        <td> {{ $product->description }} </td>
        <td> {{ $product->category }} </td>
        <td> {{ $product->cuc }} </td>
        <td> {{ $product->tomatlan }} </td>
        <td> {{ $product->gourmet }} </td>
        <td> {{ $product->entries }} </td>
        <td> {{ $product->exits }} </td>
        <td> {{ $product->initial_stock }} </td>
      </tr>
    @endforeach
  </tbody>
</table>