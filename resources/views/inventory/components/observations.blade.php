<button type="button" class="btn btn-primary" onclick="show(this)" data-id="{{ $product->id }}">
  Ver observaciones <span class="badge badge-light">{{ \App\Product::find($product->id)->observations->count() }}</span>
</button>