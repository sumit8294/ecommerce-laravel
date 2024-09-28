@extends('users.layout')
<!-- @include('components.carousel') -->
@section('content')
<div class="container py-4 sm:p-4 mt-10">

    @if(!$category_wise_products->isEmpty())

    @foreach($category_wise_products as $category)
    <div class="group cat-product bg-white sm:px-4 py-2 mb-4 shadow-xl relative">
        <div class="heading w-full font-bold bg-white border-b-4 border-[#ff4848] text-[#ff4848] text-2xl px-0 my-2">
            <a href="/category/{{$category->id}}">
                {{$category->name}}
            </a>
        </div>

        <div class="left-scroll-product hidden group-hover:flex z-20 h-[450px] w-16 absolute left-[-1px] flex  justify-center items-center">
            <span class="text-2xl cursor-pointer bg-gray-400 text-black opacity-40 px-4 py-4">
                <i class="fa-solid fa-caret-left"></i>
            </span>
        </div>
        <div class="right-scroll-product hidden group-hover:flex z-20 h-[450px] w-16 absolute right-[-1px] flex  justify-center items-center">
            <span class="text-2xl cursor-pointer bg-gray-400 text-black opacity-40 px-4 py-4">
                <i class="fa-solid fa-caret-right"></i>
            </span>
        </div>
        @if(! $category->products->isEmpty())
        <div class="category-product-row scroll-smooth flex overflow-x-auto bg-white w-[full] pb-4 pt-2 px-2 rounded-[4px]">
            @foreach($category->products as $product)
            <div class="mx-2">
                <div class="card" style="width: 14rem;">
                    <img src="{{asset('storage/'.$product->image)}}" style="height: 14rem;" class="card-img-top border-b" alt="...">
                    <div class="card-body pb-0 mt-1">
                        <span class="card-title font-bold mb-0 block">{{$product->name}}</span>
                        <span><i class="fa-solid fa-star text-yellow-400"></i></span>
                        <span><i class="fa-solid fa-star text-yellow-400"></i></span>
                        <span><i class="fa-solid fa-star text-yellow-400"></i></span>
                        <span><i class="fa-solid fa-star text-yellow-400"></i></span>
                        <p class="card-text text-[12px]">{{\Illuminate\Support\Str::limit($product->description, 30, '...')}}</p>
                    </div>
                    <div class="price px-[16px]">
                        <span class="mrp text-[18px] font-bold text-green-600">{{(int)$product->discount}}% off</span>
                        <span class="mrp line-through text- text-gray-400">{{$product->mrp}}</span>

                        <span class="text-xl font-bold text-gray-900 block"><i class="fa-solid fa-indian-rupee-sign"></i>{{$product->selling_price}}</span>
                    </div>
                    <div class="card-body flex ">
                        <button type="button" data-id="{{$product->id}}" class="add-to-cart text-sm btn btn-warning mr-2">Add to Cart</button>
                        <a type="button" href="/order/process/{{$product->id}}" class="btn text-sm bg-info">Buy Now</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    @endforeach

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


        var $productRows = $('.category-product-row');

        // Mouse enter and leave events for individual product rows
        $productRows.on('mouseenter', function() {
            $(this).data('isHovered', true); // Set flag on this specific row
        });

        $productRows.on('mouseleave', function() {
            $(this).data('isHovered', false); // Reset flag on this specific row
        });

        // Scroll buttons for products
        $('.left-scroll-product').on('click', function() {
            var productRow = $(this).siblings('.category-product-row');
            productRow.scrollLeft(productRow.scrollLeft() - 200);
        });

        $('.right-scroll-product').on('click', function() {
            var productRow = $(this).siblings('.category-product-row');
            productRow.scrollLeft(productRow.scrollLeft() + 200);
        });

        // Scroll buttons for categories
        $('.left-scroll-category').on('click', function() {
            var productRow = $(this).siblings('.category-row');
            productRow.scrollLeft(productRow.scrollLeft() - 200);
        });

        $('.right-scroll-category').on('click', function() {
            var productRow = $(this).siblings('.category-row');
            productRow.scrollLeft(productRow.scrollLeft() + 200);
        });

        // Auto-scroll logic
        function autoScroll() {
            $productRows.each(function() {
                var $thisRow = $(this);
                // Check if this specific row is hovered
                var isHovered = $thisRow.data('isHovered') || false;

                if (!isHovered) { // Only scroll if not hovered
                    var maxScroll = this.scrollWidth - $thisRow.outerWidth(); // Maximum scroll distance
                    var currentScroll = $thisRow.scrollLeft(); // Current scroll position

                    // If the user reaches the end, reset the scroll position to the beginning
                    if (currentScroll >= maxScroll) {
                        $thisRow.scrollLeft(0); // Reset this specific row's scroll to 0
                    } else {
                        $thisRow.scrollLeft(currentScroll + 200); // Continue scrolling
                    }
                }
            });
        }

        // Automatically scroll at a fixed interval
        setInterval(autoScroll, 1000); // Adjust the interval for speed





    })
</script>

@endsection('content')