<div class="d-flex flex-row">
  <button class="btn btn-primary btn-return mr-2" onclick="delivery(this)" data-id="{{ $repair->id }}"><i class="fas fa-undo-alt"></i></button>
  <a href="{{ route('reparaciones.edit', $repair) }}"><button class="btn btn-warning mr-2"><i class="fas fa-pen"></i></button></a>
  <form action="{{ route('reparaciones.destroy', $repair) }}" method="POST" class="d-inline">
    @method('DELETE')
    @csrf
    <button type="button" class="btn btn-danger btn-destroy" onclick="destroy(this)"><i class="fas fa-trash-alt"></i></button>
  </form>
</div>