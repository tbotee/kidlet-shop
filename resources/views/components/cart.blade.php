@if($items->isEmpty())
    <p class="text-center">Your is empty</p>
@else
    @foreach($items as $item)
        <div class="cart-item align-items-center">
            <div class="d-flex align-items-center">
                <img src="{{ asset('assets/images/' . $item->product->image_path) }}" alt="">
                <p class="ml-2">{{ $item->product->name }} - ${{ $item->product->price }}</p>
            </div>
            <i class="fa fa-trash remove-item-from-cart"
               aria-hidden="true"
               data-id="{{ $item->product->id }}"
            ></i>
        </div>
    @endforeach
    <h4 class="d-flex justify-content-between pt-3">
        <span>Total: </span>
        <span>${{ $total }}</span>
    </h4>
    <div id="loading-spinner" style="display: none;">Loading...</div>
@endif
