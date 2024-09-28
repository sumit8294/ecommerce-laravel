@include('seller.header')

<div class="main flex relative roboto-regular">
    @include('seller.sidebar')
    <div class="w-full sm:w-[72%] shrink bg-[#edffff] relative">
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
</div>

@include('seller.footer')