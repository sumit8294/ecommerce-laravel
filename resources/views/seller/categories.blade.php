@extends('seller.layout')

@section('content')

<div class="content m-4 bg-white shadow-lg p-4 rounded-[4px]">
    <div class="head flex justify-between font-bold border-b-2 border-[#000220] mb-4 p-2 sm:pb-0 sm:pb-2">
        <div class="heading text-2xl ">
            Categories
        </div>
        <button class="add-product-btn px-2 py-1 text-[12px] bg-primary rounded-xl text-white" onclick="showCategoryModal(true)">Add Category</button>
    </div>
    <div class="category-list ">
        <div class="categories  overflow-x-auto w-full mb-10">
            @if(!$categories->isEmpty())
            <table class="categories w-full m-2 mb-10 table text-[12px] sm:text-[16px] table-striped fixed-table">
                <thead>
                    <tr class="flex">
                        <th class="shrink-0 w-[10%]">Sr.</th>
                        <th class="shrink-0 w-[30%]">Category</th>
                        <th class="shrink-0 w-[30%]">Parent Cat.</th>
                        <th class="shrink-0 w-[30%]">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $count = ($categories->currentPage()-1) * $categories->perPage() +1; @endphp
                    @foreach($categories as $category)
                    <tr class="flex">

                        <td class="shrink-0 w-[10%]">
                            <div class="sr font-bold">{{$count}}</div>
                        </td>
                        <td class="shrink-0 w-[30%]">
                            <div class="category-name px-2 flex flex-column">
                                <span class="whitespace-nowrap">{{$category->name}}</span> 
                            </div>
                        </td>
                        <td class="shrink-0 w-[30%]">
                            <div class="parent-category-name px-2 flex flex-column">
                                <span class="whitespace-nowrap">{{$category->parent->name ?? '--'}}</span> 
                            </div>
                        </td>
                        <td class="shrink-0 w-[30%]">
                            <div class="actions flex ">
                                <form action="./category/delete/{{$category->id}}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button type="submit" class="delete btn btn-danger text-[12px] sm:text-[14px]">Delete</a>
                                </form>
                                <button class="update btn btn-warning mx-2 text-[12px] sm:text-[14px]" onclick="showCategoryModal(true,'{{$category->id}}')">Update</button>
                            </div>
                        </td>
                    </tr>
                    @php $count++; @endphp
                    @endforeach
                </tbody>
            </table>
            <div>{{ $categories->links() }}</div>
            @else
                <div class="w-full text-center">No Records Found</div>
            @endif
        </div>
    </div>

</div>
<div class="add-category w-full h-full absolute top-0 hidden" id="add-category" style="background-color: rgba(0, 0, 0, 0.4);">
    <div class="category-form m-2 sm:m-4 p-2 sm:p-4 rounded-[4px] bg-white">
        <div class="head flex justify-between font-bold border-b-2 border-[#000220] mb-4 pb-2">
            <div class="heading text-xl sm:text-2xl " id="category-heading">
                Add Category
            </div>
            <button class="btn btn-danger text-[12px] sm:text-[16px]" onclick="showCategoryModal(false)">Cancel</button>
        </div>
        <form action="./category/add" method="post" id="category-form" class=" h-[500px] overflow-y-auto">
            @csrf
            
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Category name</label>
                <input type="text" name="name" class="form-control " id="catName" placeholder="Enter Category Name">
                <div class="flex items-center mt-2">
                    <input type="checkbox" name="hasparent" id="hasParent" onchange="showParentCategories()" class="w-4 h-4 text-red-600 accent-[#ff4848] focus:ring-red-500 border-gray-300 rounded">
                    <label for="hasParent" class="ml-2 text-sm text-[#ff4848] font-medium">Has ParentCategory</label>
                </div>
            </div>
            <div class="mb-3 parent-cat-field hidden">
                <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Parent Category</label>
                <select name="parent_id" class="form-select" id="category-select">
                    
                </select>
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Category Description</label>
                <input type="text-area" name="description" class="form-control" id="parentCatDescription" placeholder="Enter Category Description">
            </div>
            <div class="mb-3">
                <button type="submit" class="form-control bg-[#ff4848] text-white font-bold" id="category-submit">Add</button>
            </div>
        </form>
    </div>
</div>


@endsection