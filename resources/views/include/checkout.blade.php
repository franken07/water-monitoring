<div>
    <div>Total Price: $<span id="total-price">{{ $totalprice }}</span></div>
    <!-- Display total price -->

    <!-- Form to handle checkout -->
    <form id="checkout-form" action="{{ route('checkoutprod') }}" method="post">
        @csrf
        <input type="hidden" name="total_price" id="total-price-input" value="{{ $totalprice }}">
        <!-- Hidden input to send total price to the server -->
        <button type="submit" id="proceed-to-order-btn">CHECK OUT SELECTED</button>
    </form>

    <label><input type="checkbox" id="check-all"> Check All</label>
</div>