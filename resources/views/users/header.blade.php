<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Ecommerce - User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/fontawesome.min.css" integrity="sha512-B46MVOJpI6RBsdcU307elYeStF2JKT87SsHZfRSkjVi4/iZ3912zXi45X5/CBr/GbCyLx6M1GQtTKYRd52Jxgw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/solid.min.css" integrity="sha512-/r+0SvLvMMSIf41xiuy19aNkXxI+3zb/BN8K9lnDDWI09VM0dwgTMzK7Qi5vv5macJ3VH4XZXr60ip7v13QnmQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <style>
    *{
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    .parent-hover:hover>.child-hover {
      display: block;
    }

    @media (max-width: 540px) {


      .signup {
        min-width: 24rem;
      }
    }

    @media (max-width: 320px) {
      .order-product-info{
        font-size: 12px !important;
        margin: 1px !important;
      }
    }
    
  </style>


</head>

<body class="roboto-regular">
  <div class=" bg-[#ff4848] p-[15px]">
    <div class="container-fluid flex justify-between">
      <div>
        <a class="text-white font-bold text-xl" href="/">E commerce</a>
        <div class="hidden sm:inline-block">
          @if(Session::has('user'))
          <a href="/orders" class="visible font- text-white ml-4"><i class="fa-solid fa-box"></i> Orders</a>
          <a href="/cart" class="visible font- text-white ml-2"><i class="fa-solid fa-cart-shopping"></i> Cart</a>

          @endif
        </div>
      </div>
      <div class="text-[20px] hidden sm:block">

        @if(Session::has('seller'))
        <a href="/seller/logout" class="visible font-bold text-white">Logout Seller</a>
        @elseif(Session::has('user'))
        <a href="/logout" class="visible font- text-white">Logout</a>
        @else
        <a href="/login-form" class="visible font-bold text-white">Login</a>
        @endif

      </div>
      <div class="text-[20px] block sm:hidden text-white">

        <button id="show-sidebar"><i class="fa-solid fa-bars"></i></button>

      </div>
    </div>
  </div>

  @php $path = request()->path(); @endphp
  @if($path === '/')
  <nav class="w-full absolute ">
    <div class="category-row scroll-smooth relative h-[100vh] overflow-x-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-200">
      <ul class="z-10 flex shadow-xl relative space-x-4 pr-[200px]">
        @foreach ($categories as $category)
        @include('components._category', ['category' => $category, 'level' => 0])
        @endforeach
      </ul>
    </div>
    <div class="left-scroll-category cursor-pointer z-40 w-12 absolute left-[-1px] top-0 py-[4px] px-2 bg-gray-400 text-black opacity-40">
      <span class="text-2xl ">
        <i class="fa-solid fa-caret-left"></i>
      </span>
    </div>
    <div class="right-scroll-category cursor-pointer z-40 w-12 absolute right-[-1px] top-0 py-[4px] px-2 bg-gray-400 text-black opacity-40">
      <span class="text-2xl ">
        <i class="fa-solid fa-caret-right"></i>
      </span>
    </div>
  </nav>
  @endif

  <div class="offcanvas offcanvas-start text-[#ff4848] " tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title font-bold text-2xl" id="offcanvasLabel">E commerce</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close" id="close-sidebar"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="w-full font-bold text-xl ">

        @if(Session::has('user'))
        <li class="p-2">
          <a href="/orders" class="visible "><i class="fa-solid fa-box"></i> Orders</a>
        </li>
        <li class="p-2 ">
          <a href="/cart" class="visible "><i class="fa-solid fa-cart-shopping"></i> Cart</a>
        </li>
        @endif

        @if(Session::has('seller'))
        <li class="p-2">
        <a href="/seller/logout" class="visible font-bold ">Logout Seller</a>
        </li>
        @elseif(Session::has('user'))
        <li class="p-2">
        <a href="/logout" class="visible font-bold">Logout</a>
        </li>
        @else
        <li class="p-2">
        <a href="/login-form" class="visible font-bold">Login</a>
        </li>
        @endif



      </ul>
    </div>
  </div>

  
</body>
<script>
  $(document).ready(function() {
    $('#show-sidebar').on('click', function() {
      $('#offcanvas').addClass('show')
    })
    $('#close-sidebar').on('click', function() {
      $('#offcanvas').removeClass('show')
    })
  })
</script>

</html>
