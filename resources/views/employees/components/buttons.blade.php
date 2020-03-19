<div class="d-flex flex-row">
  <a href="{{ route('inventario.edit', $employee) }}"><button class="btn btn-warning mr-2"><i class="fas fa-pen"></i></button></a>
  <form action="{{ route('inventario.destroy', $employee) }}" method="POST" class="d-inline">
    @method('DELETE')
    @csrf
    <button type="button" class="btn btn-danger btn-destroy" onclick="destroy(this)"><i class="fas fa-trash-alt"></i></button>
  </form>
</div>