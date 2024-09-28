@include('users.header')
<div id="alert-success" class="bg-green-200 w-56 z-10 text-green fixed right-8 top-24 rounded-[4px] p-2 " style="display:none;">

</div>
<div id="alert-error" class="bg-[#f8d7da] text-[#721c24] w-56 z-10 fixed right-8 top-24 rounded-[4px] p-2" style="display:none;">

</div>
<div class="bg-white sm:bg-gradient-to-b sm:from-gray-200 sm:to-white-500 roboto-regular relative">

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif (session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
    @endif
    @section('content')
    @show
</div>
@include('users.footer')