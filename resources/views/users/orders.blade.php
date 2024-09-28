@extends('users.layout')

@section('content')

<div class="content p-2">
    <div class="head  bg-white  flex justify-between font-bold rounded-[4px] pb-2 sm:p-4">
        <div class="heading text-2xl p-2 border-b-4 border-[#ff4848] w-full">
            Orders
        </div>

    </div>
    <div class="category-list ">
        <div class="categories">
            @if($orders && !$orders->isEmpty())


            @foreach($orders as $order)
                @if($order->product)

                <div class="w-full bg-white py-2 ">
                    <div class=" flex w-full items-center">
                        <img src="{{asset('storage/'.$order->product->image)}}" class="shrink card-img-top w-1/3 h-1/3 sm:w-[10rem] sm:h-[10rem]" alt="...">
                        <div class="order-product-info flex flex-column text-sm sm:text-base mx-2 grow">
                            <div class="card-body pb-0 mt-1 ">
                                <span class="card-title font-bold mb-0 block">{{$order->product->name}}</span>
                                <span><i class="fa-solid fa-star text-yellow-400"></i></span>
                                <span><i class="fa-solid fa-star text-yellow-400"></i></span>
                                <span><i class="fa-solid fa-star text-yellow-400"></i></span>
                                <span><i class="fa-solid fa-star text-yellow-400"></i></span>
                                <p class="">{{\Illuminate\Support\Str::limit($order->product->description, 20, '...')}}</p>
                            </div>
                            <div class="price ">
                                <span class="mrp font-bold text-green-600">{{(int)$order->product->discount}}% off</span>
                                <span class="mrp line-through text- text-gray-400">{{$order->product->mrp}}</span>
                                <span class=" font-bold text-gray-900">&#8377;{{$order->product->selling_price}}</span>
                            </div>
                            <div class="card-body">
                                <button type="button" class="bg-green-200 p-1 text-green-800 rounded-sm">{{$order->status}}</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach

            @else
            <div class="w-full text-center">No Orders Found</div>
            @endif
        </div>
    </div>

</div>


@endsection