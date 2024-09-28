@extends('users.layout')
<!-- @include('components.carousel') -->
@section('content')
<div class="content p-2">
    <div class="head  bg-white  flex justify-between font-bold rounded-[4px] pb-2 sm:p-4">
        <div class="heading text-2xl p-2 border-b-4 border-[#ff4848] w-full">
            Process Orders
        </div>

    </div>
    <div class="category-list ">
        <div class="categories">
            @if($product)

            <div class="w-full bg-white py-2 sm:p-4">
                <div class=" flex w-full items-center">
                    <img src="{{asset('storage/'.$product->image)}}" class="shrink card-img-top w-1/3 h-1/3 sm:w-[10rem] sm:h-[10rem]" alt="...">
                    <div class="order-product-info flex flex-column text-sm sm:text-base mx-2 grow">
                        <div class="card-body pb-0 mt-1 ">
                            <span class="card-title font-bold mb-0 block">{{$product->name}}</span>
                            <span><i class="fa-solid fa-star text-yellow-400"></i></span>
                            <span><i class="fa-solid fa-star text-yellow-400"></i></span>
                            <span><i class="fa-solid fa-star text-yellow-400"></i></span>
                            <span><i class="fa-solid fa-star text-yellow-400"></i></span>
                            <p class="">{{\Illuminate\Support\Str::limit($product->description, 20, '...')}}</p>
                        </div>
                        <div class="price ">
                            <span class="mrp font-bold text-green-600">{{(int)$product->discount}}% off</span>
                            <span class="mrp line-through text- text-gray-400">{{$product->mrp}}</span>
                            <span class=" font-bold text-gray-900">&#8377;{{$product->selling_price}}</span>
                        </div>
                        <div class="card-body mt-1">
                            <button type="button" data-id="{{$product->id}}" class="confirm-order bg-warning p-1 px-4 rounded-sm">Confirm</button>
                            <button type="button" onclick="history.go(-1)" class=" bg-info p-1 px-4 rounded-sm">cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            @else
            <div class="w-full text-center">No Orders Found</div>
            @endif
        </div>
    </div>

</div>





<div class="w-full h-full absolute top-0 hidden" id="proceed-order" style="background-color: rgba(0, 0, 0, 0.4);">
    <div class="order-dialog m-4 p-4 rounded-[4px] bg-white">
        <div class="head flex justify-between font-bold border-b-2 border-[#000220] mb-4 pb-2">
            <div class="heading text-2xl ">
                Confirm Order
            </div>
            <button class="btn btn-danger" id="order-confirm-cancel">Cancel</button>
        </div>
        <form action="/order/add" method="post" class="category-form h-[500px] overflow-y-auto">
            @csrf
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Product Ordered</label>
                <input type="text" name="" class="form-control " id="formGroupExampleInput" value="{{$product->name}}" disabled>
                <input type="hidden" name="product_id" class="form-control " id="formGroupExampleInput" value="{{$product->id}}">
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Quantity</label>
                <input type="number" name="quantity" class="form-control" id="formGroupExampleInput2" value="1">
            </div>
            <div class="mb-3 ">
                <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Buyer Name</label>
                <input type="text" name="" class="form-control" id="formGroupExampleInput2" value="{{\Illuminate\Support\Facades\Session::get('user')->name}}" disabled>

            </div>
            <div class="mb-3 ">
                <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Seller Name</label>
                <input type="text" name="" class="form-control" id="formGroupExampleInput2" value="{{$product->seller->name}}" disabled>
                <input type="hidden" name="seller_id" class="form-control" id="formGroupExampleInput2" value="{{$product->seller->id}}">
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
    $(document).ready(function() {
        $('#proceed-order').removeClass('hidden')
    })
</script>

@endif
<script>
    $(document).ready(function() {
        $('#order-confirm-cancel').on('click', function() {
            $('#proceed-order').addClass('hidden')
        })
        $('.confirm-order').on('click', function() {
            $('#proceed-order').removeClass('hidden')
        })
    })
</script>

@endsection('content')