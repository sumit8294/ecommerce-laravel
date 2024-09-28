@extends('seller.layout')

@section('content')
<div class="content m-4 bg-white shadow-lg p-4 rounded-[4px]">
    <div class="head flex justify-between font-bold border-b-2 border-[#000220] mb-2 p-2">
        <div class="heading text-2xl ">
            Products
        </div>
        <button class="add-product-btn px-2 py-1 text-[12px] bg-primary rounded-xl text-white" onclick="showProductModal(true)">Add Product</button>
    </div>

    <div class="text-[12px] sm:text-[14px] lg:text-[16px] flex justify-end">
        <form action="/seller/products" method="get" class=" ">
            <div class="product-search border-b-2 border-[#0d6efd] font-normal flex">
                <input type="text" name="search" class=" p-1 border-none outline-none w-full" placeholder="search product" value="{{$search}}">
                <button type="submit" class="text-[#0d6efd] px-2">search</button>
            </div>
        </form>
    </div>
    <div class="product-list ">
        <div class="products overflow-x-auto w-full mb-10">
            @if(!$products->isEmpty())
            <table class="categories w-full m-2 mb-10 table text-[12px] sm:text-[16px] xl:text-[16px] table-striped fixed-table">
                <thead>
                    <tr class="flex">
                        <th class="shrink-0">Sr.</th>
                        <th class="shrink-0 w-20">Image</th>
                        <th class="shrink-0 w-40 xl:w-56">Name</th>
                        <th class="shrink-0 w-40 xl:w-56">Category</th>
                        <th class="shrink-0 w-40">MRP</th>
                        <th class="shrink-0 w-40">Selling price</th>
                        <th class="shrink-0 w-40">Quantity</th>
                        <th class="shrink-0 w-40">Visible</th>
                        <th class="shrink-0 w-40">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @php $count = ($products->currentPage() - 1) * $products->perPage() + 1; @endphp
                    @foreach($products as $product)
                    <tr class="flex">

                        <td class="shrink-0">
                            <div class="sr font-bold">{{$count}}</div>
                        </td>
                        <td class="shrink-0 w-20">
                            <div class="product-image px-2 flex flex-column">
                                <img src="{{ asset('storage/'. $product->image) }}" class="h-10 w-10 rounded-full" />
                            </div>
                        </td>
                        <td class="shrink-0 w-40 xl:w-56">
                            <div class="product-name px-2 flex flex-column">
                                <span class="truncate whitespace-nowrap">{{$product->name}} </span>
                            </div>
                        </td>
                        <td class="shrink-0 w-40 xl:w-56">
                            <div class="product-cat px-2 flex flex-column">
                                <span class="truncate whitespace-nowrap">{{$product->category->name}}</span>
                            </div>
                        </td>
                        <td class="shrink-0 w-40">
                            <div class="product-cat px-2 flex flex-column">
                                <span>{{$product->mrp}}</span>
                            </div>
                        </td>
                        <td class="shrink-0 w-40">
                            <div class="product-cat px-2 flex flex-column">
                                <span>{{$product->selling_price}}</span>
                            </div>
                        </td>
                        <td class="shrink-0 w-40">
                            <div class="product-cat px-2 flex flex-column">
                                <span>{{$product->quantity}}</span>
                            </div>
                        </td>
                        <td class="shrink-0 w-40">
                            <div class="product-cat px-2 flex flex-column">
                                <span>
                                    @if($product->visible)
                                    Yes
                                    @else No
                                    @endif
                                </span>
                            </div>
                        </td>
                        <td class="shrink-0 w-40">
                            <div class="actions flex">
                                <form action="/seller/products/delete/{{$product->id}}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete" />
                                    <button class="delete btn btn-danger text-[12px] sm:text-[14px]">Delete</button>
                                </form>
                                <button class="update btn btn-warning mx-2 text-[12px] sm:text-[14px]" data-id="{{$product->id}}" id="update-product">Update</button>
                            </div>
                        </td>
                    </tr>
                    @php $count++; @endphp
                    @endforeach
                </tbody>

            </table>
            <div>{{ $products->links() }}</div>
            @else
            <div class="w-full text-center">No Products Found</div>
            @endif
        </div>
    </div>

</div>
<div class="w-full h-full absolute top-0 hidden" id="add-product" style="background-color: rgba(0, 0, 0, 0.4);">
    <div class="product-form m-4 p-4 rounded-[4px] bg-white">
        <div class="head flex justify-between font-bold border-b-2 border-[#000220] mb-4 pb-2">
            <div class="heading text-2xl ">
                Add Product
            </div>
            <button class="btn btn-danger" onclick="showProductModal(false)">Cancel</button>
        </div>
        <form action="/seller/products/add" method="post" id="product-form" class=" h-[500px] overflow-y-auto px-2" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Product name</label>
                <input type="text" name="name" class="form-control " id="product-name" placeholder="Enter product name">
                @error('name') {{$message}} @enderror

            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Category</label>
                <select name="category_id" class="form-select" id="category-select" onchange="">

                </select>
                @error('category_id') {{$message}} @enderror
            </div>
            <div class="mb-3 ">
                <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Product Image</label>
                <img src="" class="w-10 h-10 rounded-full hidden" id="previous-product-image" />
                <input type="file" name="image" class="form-control " id="product-image">
                @error('image') {{$message}} @enderror
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Product Sku</label>
                <input type="text" name="sku" class="form-control" id="product-sku" placeholder="Enter product Sku">
                @error('sku') {{$message}} @enderror
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">MRP</label>
                <input type="number" name="mrp" class="form-control" id="product-mrp" placeholder="Enter MRP">
                @error('mrp') {{$message}} @enderror
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Selling Price</label>
                <input type="number" name="selling_price" class="form-control" id="product-selling-price" placeholder="Enter Selling Price">
                @error('selling_price') {{$message}} @enderror
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Product Description</label>
                <input type="text" name="description" class="form-control" id="product-description" placeholder="Enter product Description">
                @error('description') {{$message}} @enderror
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Quantity</label>
                <input type="number" name="quantity" class="form-control" id="product-quantity" placeholder="Enter product Quantity">
                @error('quantity') {{$message}} @enderror
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Tags</label>
                <input type="text" name="tags" class="form-control" id="product-tags" placeholder="Enter product Tags | i.e. smartphone, smartphone under 10000">
                @error('tags') {{$message}} @enderror
            </div>
            <div class="mb-3">
                <button type="submit" class="form-control bg-[#ff4848] text-white font-bold" id="product-submit">Add</button>
            </div>
        </form>
    </div>
</div>


@if($errors->any())
<script>
    $(document).ready(function() {
        $('#add-product').removeClass('hidden')

        fetchCategories()
    })
</script>

@endif

<script>
    $(document).ready(function() {
        $('#update-product').on('click', function() {
            var id = $(this).data('id')

            fetchProductToUpdate(id)
            $('#previous-product-image').removeClass('hidden');
        })
    })
</script>


@endsection