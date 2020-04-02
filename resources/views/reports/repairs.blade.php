<table>
  <thead>
    <tr>
      <th style="width:11px; background-color: #b2bec3;">Fecha</th>
      <th style="width:60px; background-color: #b2bec3;">Descripción</th>
      <th style="width:20px; background-color: #b2bec3;">ID</th>
      <th style="width:60px; background-color: #b2bec3;">Motivo de reparación</th>
      <th style="width:33px; background-color: #b2bec3;">Personal</th>
      <th style="width:8px; background-color: #b2bec3;">Empresa</th>
      <th style="width:17px; background-color: #b2bec3;">Fecha de entrega</th>
    </tr>
  </thead>
  <tbody>
    @foreach($repairs as $repair)
      <tr>
        <td> @if ($repair->exit_date) {{ $repair->exit_date->format('Y-m-d') }} @else <i style="color: #6c757d;">N/A</i></td> @endif
        <td> @if ($repair->description && $repair->description != '') {{ $repair->description }} @else <i style="color: #6c757d;">N/A</i></td> @endif
        <td> @if ($repair->repair_id) {{ $repair->repair_id }} @else <i style="color: #6c757d;">N/A</i></td> @endif
        <td> @if ($repair->reason && $repair->reason != '') {{ $repair->reason }} @else <i style="color: #6c757d;">N/A</i></td> @endif
        <td> @if ($repair->personal && $repair->personal->name != '') {{ $repair->personal->name }} @else <i style="color: #6c757d;">N/A</i></td> @endif
        <td> @if ($repair->business && $repair->business->name != '') {{ $repair->business->name }} @else <i style="color: #6c757d;">N/A</i></td> @endif
        <td> @if ($repair->delivery_date) {{ $repair->delivery_date->format('Y-m-d') }} @else <i style="color: #6c757d;">N/A</i></td> @endif
      </tr>
    @endforeach
  </tbody>
</table>