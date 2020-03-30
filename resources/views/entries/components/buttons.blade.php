<div class="d-flex flex-row justify-content-center">
  {{-- <a href="{{ route('entradas.edit', $entry->id) }}"><button class="btn btn-warning mr-2"><i class="fas fa-pen"></i></button></a> --}}
  <form action="{{ route('entradas.destroy', $entry->id) }}" method="POST" class="d-inline">
    @method('DELETE')
    @csrf
    <button type="button" class="btn btn-danger btn-destroy" onclick="destroy(this)"><i class="fas fa-trash-alt"></i></button>
  </form>
</div>