<div class="d-flex flex-row">
  <a href="{{ route('proveedores.edit', $provider) }}"><button class="btn btn-warning mr-2"><i class="fas fa-pen"></i></button></a>
  <form action="{{ route('proveedores.destroy', $provider) }}" method="POST" class="d-inline">
    @method('DELETE')
    @csrf
    <button type="button" class="btn btn-danger btn-destroy" onclick="destroy(this)"><i class="fas fa-trash-alt"></i></button>
  </form>
</div>