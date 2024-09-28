@extends('users.layout')
<!-- @include('components.carousel') -->
@section('content')
<div class="w-full p-2">
    <div class="bg-white flex-column sm:flex justify-between py-3">
        <div class="font-bold m-2 text-2xl border-b-4 border-yellow-400 mb-4"><i class="fa-solid fa-shopping-cart text-yellow-400"></i> Your Cart</div>
        <div class="font-bold text-2xl flex justify-between sm:p-2">
            <button class="btn font-bold" id="total-price" total="{{$total_price}}">Total - ₹{{$total_price}}.00</button>
            <button class="confirm-order btn btn-warning text-white" >Place Order</button>
        </div>
    </div>
</div>
<div class="w-full flex flex-col sm:flex-row items-center py-4 overflow-x-auto">
        @if($cart_products && !$cart_products->isEmpty())
        @foreach($cart_products as $cart_item)
        <div class="shrink-0 w-[16rem] m-2">
            <div class="card flex-column">
                <img src="{{asset('storage/'.$cart_item->product->image)}}" class="mx-auto card-img-top w-[16rem] h-[16rem] border-b" alt="...">
                <div>
                    <div class="card-body pb-0 mt-1">
                        <span class="card-title font-bold mb-0 block">{{$cart_item->product->name}}</span>
                        <span><i class="fa-solid fa-star text-yellow-400"></i></span>
                        <span><i class="fa-solid fa-star text-yellow-400"></i></span>
                        <span><i class="fa-solid fa-star text-yellow-400"></i></span>
                        <span><i class="fa-solid fa-star text-yellow-400"></i></span>
                        <p class="card-text text-[12px]">{{\Illuminate\Support\Str::limit($cart_item->product->description, 30, '...')}}</p>
                    </div>
                    <div class="price px-[16px]">
                        <span class="mrp text-[18px] font-bold text-green-600">{{(int)$cart_item->product->discount}}% off</span>
                        <span class="mrp line-through text- text-gray-400">{{$cart_item->product->mrp}}</span>

                        <span class="text-xl font-bold text-gray-900 block"><i class="fa-solid fa-indian-rupee-sign"></i>{{$cart_item->product->selling_price}}</span>
                    </div>
                    <div class="card-body border-1 flex justify-center p-0">
                        <button type="button" data-id="{{$cart_item->id}}" class="decrease-quantity btn flex-grow font-bold">-</button>
                        <button data-quantity="{{$cart_item->quantity}}" class="quantity btn">Quantity {{$cart_item->quantity}}</button>
                        <button type="button" data-id="{{$cart_item->id}}" class="increase-quantity btn flex-grow font-bold">+</button>
                        <input type="hidden" class="product-price" price="{{$cart_item->product->selling_price}}">
                    </div>
                    <div class="card-body">
                        <button type="button" data-id="{{$cart_item->id}}" class="remove-from-cart btn bg-warning">Remove</button>
                        <a type="button" href="/order/process/{{$cart_item->product->id}}" class="btn bg-info">Buy Now</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
</div>

<div class="w-full h-full absolute top-0 hidden" id="proceed-order" style="background-color: rgba(0, 0, 0, 0.4);">
    <div class="order-dialog m-4 p-4 rounded-[4px] bg-white">
        <div class="head flex justify-between font-bold border-b-2 border-[#000220] mb-4 pb-2">
            <div class="heading text-2xl ">
                Confirm Order
            </div>
            <button class="btn btn-danger" id="order-confirm-cancel">Cancel</button>
        </div>
        <form action="/order/bulk" method="post" class="category-form h-[500px] overflow-y-auto">
            @csrf
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Product Ordered</label>
                <table class=" w-full m-2 table  table-striped">
                    <thead>
                        <tr>
                            <th>Sr.</th>
                            <th>name</th>
                            <th>quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach($cart_products as $cart_item)
                        <tr id="confirm-list-cart-product-{{$cart_item->id}}">

                            <td>
                                <div class="sr font-bold">{{$count}}</div>
                            </td>
                            <td>
                                <div class="category-name px-2 flex flex-column">
                                    <span>{{$cart_item->product->name}}</span>
                                </div>
                            </td>
                            <td>
                                <div class="parent-category-name px-2 flex flex-column">
                                    <span id="cart-product-quantity-{{$cart_item->id}}">{{$cart_item->quantity}}</span>
                                </div>
                            </td>
                           
                        </tr>
                        @php $count++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mb-3 ">
                <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Buyer Name</label>
                <input type="text" name="" class="form-control" id="formGroupExampleInput2" value="{{\Illuminate\Support\Facades\Session::get('user')->name}}" disabled>

            </div>

            <div class="mb-3 ">
                <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Address</label>
                <input type="text" name="address" class="form-control" id="formGroupExampleInput2" value="" placeholder="Enter Address">
                @error('address') {{ $message }} @enderror
            </div>

            <div class="mb-3">
                <button type="submit" class="form-control bg-[#ff4848] text-white font-bold" id="formGroupExampleInput3">Confirm</button>
            </div>
        </form>
    </div>
</div>

@if($errors->any())
<script>
    
    $(document).ready(function(){
        $('#proceed-order').removeClass('hidden')
    })
</script>
@endif

<script>
    $(document).ready(function(){
        $('#order-confirm-cancel').on('click',function(){
            $('#proceed-order').addClass('hidden')
        })
        $('.confirm-order').on('click',function(){
            
            $('#proceed-order').removeClass('hidden')
        })
    })
</script>

<script>
    $(document).ready(function() {


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.remove-from-cart').on('click', function() {
            var cartId = $(this).data('id')

            $.ajax({
                url: `/cart/delete/${cartId}`,
                method: "delete",
                success: function(data) {
                    $('#alert-success').text(data.success)
                    $('#alert-success').fadeIn()
                    setTimeout(function() {
                        $('#alert-success').fadeOut()
                    }, 3000)
                    $(this).closest('.col').fadeOut();
                    $(`#confirm-list-cart-product-${cartId}`).fadeOut();
                }.bind(this),
                error: function(data) {
                    $('#alert-error').text(data.responseJSON.error)
                    $('#alert-error').fadeIn()
                    setTimeout(function() {
                        $('#alert-error').fadeOut()
                    }, 3000)
                    console.log(data.responseText)
                }

            })
        })

        $('.decrease-quantity').on('click', function() {
            
            var cartId = $(this).data('id')
            var quantity = Number($(this).siblings('.quantity').attr('data-quantity'))

            if (quantity < 2) return;

            $.ajax({
                url: `/cart/update/${cartId}`,
                method: "put",
                data: {
                    quantity: quantity - 1,
                },
                success: function(data) {
                    $('#alert-success').text(data.message)
                    $('#alert-success').fadeIn()
                    setTimeout(function() {
                        $('#alert-success').fadeOut()
                    }, 3000)
                    var newQuantity = quantity - 1;
                    $(this).siblings('.quantity').text(`Quantity ${newQuantity}`);
                    $(this).siblings('.quantity').attr('data-quantity', newQuantity);
                    $(`#cart-product-quantity-${cartId}`).text(newQuantity)
                    var product_price = Number($(this).siblings('.product-price').attr('price'));
                    var total_price = Number($('#total-price').attr('total'));
                    var updatedTotalPrice = total_price - product_price;
                    $('#total-price').attr('total', updatedTotalPrice);
                    $('#total-price').text(`Total: ₹${updatedTotalPrice.toFixed(2)}`);
                }.bind(this),
                error: function(data) {
                    $('#alert-error').text(data.responseJSON.message)
                    $('#alert-error').fadeIn()
                    setTimeout(function() {
                        $('#alert-error').fadeOut()
                    }, 3000)
                    console.log(data.responseText)
                }

            })
        })

        $('.increase-quantity').on('click', function() {
            var cartId = $(this).data('id')
            var quantity = Number($(this).siblings('.quantity').attr('data-quantity'))

            $.ajax({
                url: `/cart/update/${cartId}`,
                method: "put",
                data: {
                    quantity: quantity + 1,
                },
                success: function(data) {
                    $('#alert-success').text(data.message)
                    $('#alert-success').fadeIn()
                    setTimeout(function() {
                        $('#alert-success').fadeOut()
                    }, 3000)
                    var newQuantity = quantity + 1;
                    $(this).siblings('.quantity').text(`Quantity ${newQuantity}`);
                    $(this).siblings('.quantity').attr('data-quantity', newQuantity);
                    $(`#cart-product-quantity-${cartId}`).text(newQuantity)

                    var product_price = Number($(this).siblings('.product-price').attr('price'));
                    var total_price = Number($('#total-price').attr('total'));
                    var updatedTotalPrice = total_price + product_price;
                    $('#total-price').attr('total', updatedTotalPrice);
                    $('#total-price').text(`Total: ₹${updatedTotalPrice.toFixed(2)}`);
                }.bind(this),
                error: function(data) {
                    $('#alert-error').text(data.responseJSON.message)
                    $('#alert-error').fadeIn()
                    setTimeout(function() {
                        $('#alert-error').fadeOut()
                    }, 3000)
                    console.log(data.responseText)
                }

            })
        })
    })
</script>

@endsection('content')