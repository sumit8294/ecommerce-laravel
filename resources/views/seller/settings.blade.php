@extends('seller.layout')

@section('content')
<div class="content m-4 bg-white shadow-lg p-4 rounded-[4px]">
    <div class="head flex text-2xl w-full justify-between font-bold border-b-2 border-[#000220] mb-4 pb-2">
        Account Settings
    </div>

    <form action="/seller/settings/{{$seller->id}}"  method="post" class="seller-setting-form h-[500px] overflow-y-auto px-2" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="put" />
            
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label text-[#003366]">Seller Profile</label>
                <div class="profile-container flex items-center justify-between">
                    @if($seller->profile)
                        <img src="{{ asset('storage/'. $seller->profile) }}" alt="" class="profile h-16 w-16 rounded-full">
                    @else
                        <img src="{{asset('images/temp-user.png')}}" alt="" class="profile h-16 w-16 rounded-full">
                    @endif
                    
                    <input type="file" name="profile" class="form-control mx-2" id="formGroupExampleInput" >
                </div>
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label text-[#003366]">Seller Name</label>
                <div class="profile-container flex items-center justify-between">
                    <input type="text" name="name" class="form-control" id="seller-name" value="{{$seller->name}}" disabled>
                    <button onclick="setIsEditable(event,this)" class="bg-[#003366] rounded-[4px] mx-2 p-1 px-2 text-white"><i class="fa-solid fa-pen-to-square"></i></button>
                </div>
                @error('name') {{$message}} @enderror
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label text-[#003366]">Email</label>
                <div class="profile-container flex items-center justify-between">
                    <input type="text" name="email" class="form-control" id="seller-email" value="{{$seller->email}}" disabled>
                    <button onclick="setIsEditable(event,this)" class="bg-[#003366] rounded-[4px] mx-2 p-1 px-2 text-white"><i class="fa-solid fa-pen-to-square"></i></button>
                </div>
                @error('email') {{$message}} @enderror
            </div>
            <div class="mb-3 ">
                <label for="formGroupExampleInput2" class="form-label text-[#003366]">Gst Invoice</label>
                <div class="profile-container flex items-center justify-between">
                    <input type="text" name="gst_number" class="form-control" id="seller-gst" value="{{$seller->gst_number}}" disabled>
                    <button onclick="setIsEditable(event,this)" class="bg-[#003366] rounded-[4px] mx-2 p-1 px-2 text-white"><i class="fa-solid fa-pen-to-square"></i></button>
                </div>
            </div>
            <div class="mb-3 ">
                <label for="formGroupExampleInput2" class="form-label text-[#003366]">Address</label>
                <div class="profile-container flex items-center justify-between">
                    <input type="text" name="address" class="form-control" id="seller-address" value="{{$seller->address}}" disabled>
                    <button onclick="setIsEditable(event,this)" class="bg-[#003366] rounded-[4px] mx-2 p-1 px-2 text-white"><i class="fa-solid fa-pen-to-square"></i></button>
                </div>
            </div>

            <div class="mb-3">
                <button type="submit" class="form-control bg-[#003366] text-white font-bold" id="formGroupExampleInput3">Update</button>
            </div>
        </form>
</div>

<script>
    $(document).ready(function(){
        $('.seller-setting-form').on('submit',function(){
            $(this).find(':input:disabled').prop('disabled',false);
        })
    })
</script>

@endsection