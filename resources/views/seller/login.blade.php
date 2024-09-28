<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <style>
        @media (max-width: 540px) {


            .signup {
                min-width: 24rem;
                display: flex;
                justify-content: center;
            }

            .signup label {
                font-size: 14px;
            }

            .signup input {
                font-size: 14px;
                width: 20rem;
            }
            

        }
        body{
            width: 100%;
        }
    </style>
  <body>
  <div class="main w-full h-[100vh] flex items-center">
    
    <div hidden class="login min-w-[30rem] w-[30rem] m-auto sm:border-1 rounded-[4px] sm:shadow-xl">
        
            <div class="form p-10">
                <div class="head">
                 <label for="formGroupExampleInput" class="form-label w-full text-[#ff4848] text-center text-xl font-bold mb-4">Seller Login</label>
               
                </div>
                @if(session('error'))
                <div class="alert w-full rounded-[4px] bg-red-200 text-red-800 font-bold">{{session('error')}}</div>
                @endif
                <form action="/seller/login" method="post" class="login-form">
                    @csrf
                    <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Username</label>
                    <input type="text" name="name" class="form-control " id="formGroupExampleInput" placeholder="Enter Username">
                    </div>
                    <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Password</label>
                    <input type="text" name="password" class="form-control" id="formGroupExampleInput2" placeholder="Enter Password">
                    </div>
                    <div class="mb-3">
                   
                    <input type="submit" class="form-control bg-[#ff4848]" id="formGroupExampleInput3" >
                    </div>
                </form>
                Not have an Account - <button onclick="changeForm('signup')" class="font-bold text-[#ff4848]">Signup</button>
            </div>
        
    </div>

    <div  class=" signup min-w-[30rem] w-[30rem] m-auto sm:border-1 rounded-[4px] sm:shadow-xl">
        
            <div class="form p-10">
                <div class="head">
                 <label for="formGroupExampleInput" class="form-label w-full text-[#ff4848] text-center text-xl font-bold mb-4">Seller Signup</label>
               
                </div>
                @if(session('error'))
                <div class="alert w-full rounded-[4px] bg-red-200 text-red-800 font-bold">{{session('error')}}</div>
                @endif
                <form action="/seller/signup" method="post" class="signup-form">
                    @csrf
                    <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Email</label>
                    <input type="text" name="email" class="form-control " id="formGroupExampleInput" placeholder="Enter Email">
                   @error('email'){{$message}}@enderror
                    </div>
                    <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Username</label>
                    <input type="text" name="name" class="form-control " id="formGroupExampleInput" placeholder="Enter Username">
                    @error('name'){{$message}} @enderror
                </div>
                    <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label text-[#ff4848]">Password</label>
                    <input type="text" name="password" class="form-control" id="formGroupExampleInput2" placeholder="Enter Password">
                    @error('password'){{$message}}@enderror
                    </div>
                    <div class="mb-3">
                   
                    <input type="submit" class="form-control bg-[#ff4848]" id="formGroupExampleInput3" >
                    </div>
                </form>
                Already have an Account - <button onclick="changeForm('login')" class="font-bold text-[#ff4848]">Login</button>
            </div>
        
    </div>
<div>
  </body>
  <script >
    const loginForm = document.getElementsByClassName('login')[0];
    const signupForm = document.getElementsByClassName('signup')[0];
    function changeForm(type){
        loginForm.hidden = type !== "login"
        signupForm.hidden = type !== "signup"

    }
    </script>
</html>
