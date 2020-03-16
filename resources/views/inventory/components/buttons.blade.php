<div class="d-flex flex-row">
  <a href="{{ route('inventario.edit', $product) }}"><button class="btn btn-warning mr-2"><i class="fas fa-pen"></i></button></a>
  <form action="{{ route('inventario.destroy', $product) }}" method="POST" class="d-inline">
    @method('DELETE')
    @csrf
    <button type="button" class="btn btn-danger btn-delete" onclick="dele(this)"><i class="fas fa-trash-alt"></i></button>
  </form>
</div>