<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ecommerce- Seller</title>
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
       
       
    .seller-header{
      display: none;
    }
    @media (max-width: 640px) {
      .seller-header{
        display: block;
      }
      .seller-sidebar{
        display: none;
      }
    }
    @media (max-width: 640px) {
      .seller-info{
       display: block;
      }
      .seller-info div{
        width: 100%;
        text-align: center;
      }
      .simple-bar-chart > .item > .label { 
        inset: 100% 0 auto 0;
        font-size: 10px;
      }
      
    }
    @media (max-width: 420px) {
      .content{
        margin: 0px !important;
        padding: 2px !important;
      }
      .simple-bar-chart > .item > .label { 
        inset: 100% 0 auto 0;
        font-size: 8px;
      }
    }
    @media (max-width: 1024px) {

      .monthly-sale .simple-bar-chart > .item > .label {
        display: none;
      }
    }



    
  </style>
</head>

<body>
  <div class="seller-header bg-[#000328] p-[15px] shadow-2xl">
    <div class="container-fluid flex justify-between">
      <a class="text-white font-bold text-xl" href="#">E commerce</a>
      <div class="text-[20px] block sm:hidden text-white">

        <button id="show-sidebar"><i class="fa-solid fa-bars"></i></button>

      </div>
    </div>
     
  </div>

  <div class="offcanvas offcanvas-start bg-[#000328] text-white " tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title font-bold text-2xl" id="offcanvasLabel">E commerce</h5>
      <button type="button" class="btn-close text-reset text-white" aria-label="Close" id="close-sidebar"><i class="fa-solid fa-close"></i></button>
    </div>
    <div class="offcanvas-body">
      <ul class="w-full font-bold text-xl ">

      <ul class="navigation p-2 text-[18px] text-white ">
    <li class="links px-2 w-full">
        <a href="/seller">
            <div class="p-2 px-2 border-[#003366] border-b w-full cursor-pointer">
                <i class="fa-solid fa-arrow-up-right-dots"></i>&nbsp;
                Sales
            </div>
        </a>  
    </li>
    <li class="links px-2 w-full">
        <a href="/seller/products">
            <div class="p-2 px-2 border-[#003366] border-b w-full cursor-pointer">
                <i class="fa-solid fa-boxes-stacked"></i>&nbsp;
                Products
            </div>
        </a>  
    </li>
    <li class="links px-2 w-full">
        <a href="/seller/categories">
            <div class="p-2 px-2 border-[#003366] border-b w-full cursor-pointer">
                <i class="fa-solid fa-layer-group"></i>&nbsp;
                Categories
            </div>  
        </a>
    </li>
    <li class="links px-2 w-full">
        <a href="/seller/orders">
            <div class="p-2 px-2 border-[#003366] border-b w-full cursor-pointer">
                <i class="fa-solid fa-cart-shopping"></i>&nbsp;
                Orders
            </div> 
        </a> 
    </li>
    <li class="links px-2 w-full">
        <a href="/seller/settings">
            <div class="p-2 px-2 border-[#003366] border-b w-full cursor-pointer">
                <i class="fa-solid fa-gear"></i>&nbsp;
                Account Settings
            </div>
        </a>  
    </li>
    <li class="links px-2 w-full">
        <a href="/seller/logout">
            <div class="p-2 px-2 border-[#003366] border-b w-full cursor-pointer">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp;
                Logout
            </div>
        </a>  
    </li>
   </ul>



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