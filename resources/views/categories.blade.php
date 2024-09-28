@extends('users.layout')
<!-- @include('components.carousel') -->
@section('content')
<div class="container p-4 bg-white">

<div class="heading w-full font-bold bg-white border-b-4 border-[#ff4848] text-[#ff4848] text-2xl px-0 my-2">
            <a href="/category/{{$category->id}}">
                {{$category->name}}
            </a>
        </div>
        @if(! $products->isEmpty())
        <div class=" bg-white pb-4 pt-2 px-2 rounded-[4px] flex flex-column items-center">
            @foreach($products as $product)
            
           
                <div class="w-[80%] block category-card sm:flex sm:flex-row border-2 items-center grow-0 mb-2" >
                    <img src="{{asset('storage/'.$product->image)}}" class="card-img-top sm:h-52 sm:w-52 lg:h-44 lg:w-44 " alt="...">
                    <div class="sm:flex-column lg:flex lg:justify-between grow-0 lg:items-center w-full m-2">
                        <div class="card-body pb-0 mt-1">
                            <span class="card-title font-bold mb-0 block">{{$product->name}}</span>
                            <span><i class="fa-solid fa-star text-yellow-400"></i></span>
                            <span><i class="fa-solid fa-star text-yellow-400"></i></span>
                            <span><i class="fa-solid fa-star text-yellow-400"></i></span>
                            <span><i class="fa-solid fa-star text-yellow-400"></i></span>

                            <span class="product-text text-[12px] block pr-1">{{\Illuminate\Support\Str::limit($product->description)}}</span>
                        </div>
                        <div class="price ">
                            <span class="mrp text-[18px] font-bold text-green-600">{{(int)$product->discount}}% off</span>
                            <span class="mrp line-through text- text-gray-400">{{$product->mrp}}</span>

                            <span class="text-[20px] font-bold text-gray-900 block"><i class="fa-solid fa-indian-rupee-sign"></i>{{$product->selling_price}}</span>
                        </div>
                        <div class="card-body md:flex-column lg:flex lg:grow">
                            <button type="button" data-id="{{$product->id}}" class="add-to-cart text-sm btn btn-warning mr-2">Add to Cart</button>
                            <a type="button" href="/order/process/{{$product->id}}" class="btn text-sm bg-info">Buy Now</a>
                        </div>
                    </div>
                </div>
            
            @endforeach
        </div>
        @endif

</div>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.add-to-cart').on('click', function() {
            var productId = $(this).data('id');
            $.ajax({
                url: `/cart/add/${productId}`,
                method: 'post',
                success: function(data) {

                    $('#alert-success').text(data.message)
                    $('#alert-success').fadeIn()
                    setTimeout(function() {
                        $('#alert-success').fadeOut()
                    }, 3000)
                },
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