@extends('seller.layout')

@section('content')
<div class="content m-4 bg-white shadow-lg p-4 rounded-[4px]">
    <div class="head flex justify-between font-bold border-b-2 border-[#000220] mb-4 sm:p-2 sm:p-0 sm:pb-2">
        <div class="heading text-2xl ">
            Orders
        </div>
    </div>
    <div class="category-list ">
        <div class="categories overflow-x-auto w-full mb-10">
            @if(!$orders->isEmpty())
            @php $count = ($orders->currentPage() -1) * $orders->perPage() +1; @endphp
            <table class="categories w-full m-2 mb-10 table text-[12px] sm:text-[16px] table-striped fixed-table">
                <thead>
                    <tr class="flex">
                        <th>Sr.</th>
                        <th class="shrink-0 w-[30%]">Product</th>
                        <th class="shrink-0 w-[15%]">Quantity</th>
                        <th class="shrink-0 w-[30%]">Buyer</th>
                        <th class="shrink-0 w-[30%]">Address</th>
                        <th class="shrink-0 w-[30%]">Status</th>
                        <th class="shrink-0 w-[30%]">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($orders as $order)
                    <tr class="flex">

                        <td class="shrink-0 ">
                            <div class="sr font-bold">{{$count++}}</div>
                        </td>
                        <td class="shrink-0 w-[30%]">
                            <div class="product-name px-2 flex flex-column">
                                <span>
                                    @if($order->product)
                                    {{$order->product->name}}</span>
                                    @endif
                            </div>
                        </td>
                        <td class="shrink-0 w-[15%]">
                            <div class="product-name px-2 flex flex-column">
                                <span>{{$order->quantity}}</span>
                            </div>
                        </td>
                        <td class="shrink-0 w-[30%]">
                            <div class="product-name px-2 flex flex-column">
                                <span>
                                    @if($order->user)
                                    {{$order->user->name}}
                                    @endif
                                </span>
                            </div>
                        </td>
                        <td class="shrink-0 w-[30%]">
                            <div class="product-name px-2 flex flex-column">
                                <span>{{$order->address}}</span>
                            </div>
                        </td>
                        <td class="shrink-0 w-[30%]">
                            <div class="product-name px-2 flex flex-column">
                                <span class="badge text-bg-info">{{$order->status}}</span>
                            </div>
                        </td>
                        <td class="shrink-0 w-[30%]">
                            <div class="actions">
                                <button class="update btn btn-warning open-order-modal text-[12px] sm:text-[14px]" data-id="{{$order->id}}" id="">Manage</button>
                            </div>
                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
            <div>{{$orders->links()}}</div>
            @else
            <div class="w-full text-center">No Products Found</div>
            @endif
        </div>
    </div>

</div>
<div class="manage-order w-full h-full absolute top-0 hidden" id="manage-order" style="background-color: rgba(0, 0, 0, 0.4);">
    <div class="order-dialog m-2 p-2 sm:m-4 sm:p-4 rounded-[4px] bg-white">
        <div class="head flex justify-between font-bold border-b-2 border-[#000220] mb-4 pb-2">
            <div class="heading text-xl sm:text-2xl ">
                Manage Order
            </div>
            <button class="btn btn-danger text-[12px] sm:text-[14px]" id="close-order-modal ">Cancel</button>
        </div>
        <form action="/seller/orders/update" method="post" class="category-form h-[500px] overflow-y-auto">
            @csrf
            <input type="hidden" name="_method" value="put">
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Product Ordered</label>
                <input type="text" name="" class="form-control " id="manage-product" value="{{$order->product->name}}" disabled>
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Quantity</label>
                <input type="text" name="" class="form-control" id="manage-quantity" value="{{$order->quantity}}" disabled>
            </div>
            <div class="mb-3 ">
                <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Buyer Name</label>
                <input type="text" name="" class="form-control" id="manage-username" value="{{$order->user->name}}" disabled>
            </div>
            <div class="mb-3 ">
                <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Address</label>
                <input type="text" name="" class="form-control" id="manage-address" value="{{$order->address}}" disabled>
            </div>


            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Status</label>
                <input type="hidden" name="order_id" value="" id="manage-order-id">
                <select name="status" class="form-select" id="order-status">

                </select>

            </div>

            <div class="mb-3">
                <button type="submit" class="form-control bg-[#ff4848] text-white font-bold" id="formGroupExampleInput3">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.open-order-modal').on('click', function() {
            var orderId = $(this).data('id')
            $.ajax({
                url: "{{ route('orders') }}/" + orderId,
                method: 'get',
                success: function(data) {

                    $('#manage-product').val(data[0].product.name)
                    $('#manage-quantity').val(data[0].quantity)
                    $('#manage-username').val(data[0].user.name)
                    $('#manage-address').val(data[0].address)
                    $('#manage-order-id').val(data[0].id)


                    let options = `
                    <option value="pending" ${data[0].status === 'pending' ? 'selected' : ''}>Pending</option>
                    <option value="shipped" ${data[0].status === 'shipped' ? 'selected' : ''}>Shipped</option>
                    <option value="out-of-delivery" ${data[0].status === 'out-of-delivery' ? 'selected' : ''}>Out of Delivery</option>
                    <option value="delivered" ${data[0].status === 'delivered' ? 'selected' : ''}>Delivered</option>
                `;
                    $('#order-status').html('')
                    $('#order-status').append(options)

                }
            })
            $('#manage-order').removeClass('hidden')
        })
        $('#close-order-modal').on('click', function() {
            $('#manage-order').addClass('hidden')
        })

    })
</script>

@endsection