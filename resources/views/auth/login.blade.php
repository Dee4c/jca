<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/c/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      /* Google Font Link */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
        *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins" , sans-serif;
        }
        body{
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-image: url('images/bg1.jpg');
        background-size: 100vw 100vh;
        background-repeat:  no-repeat;
        padding: 30px;
        }
        .container{
        position: relative;
        max-width: 850px;
        width: 100%;
        background: #c5b358;
        opacity: 80%;
        padding: 40px 30px;
        box-shadow: 0 5px 10px rgba(0,0,0,0.2);
        perspective: 2700px;
        }
        .container .cover{
        position: absolute;
        top: 0;
        left: 50%;
        height: 100%;
        width: 50%;
        z-index: 98;
        transition: all 1s ease;
        transform-origin: left;
        transform-style: preserve-3d;
        }

        .container .cover .front,
        .container .cover .back{
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100.5%;
        }
        .container .cover::before,
        .container .cover::after{
        content: '';
        position: absolute;
        height: 100%;
        width: 100%;
        opacity: 0.5;
        z-index: 12;
        }
        .container .cover::after{
        opacity: 0.3;
        transform: rotateY(180deg);
        backface-visibility: hidden;
        }
        .container .cover img{
        position: absolute;
        height: 100%;
        width: 100%;
        object-fit: cover;
        z-index: 10;
        }
        .container .cover .text{
        position: absolute;
        z-index: 130;
        height: 100%;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        }
        .cover .text .text-1,
        .cover .text .text-2{
        font-size: 26px;
        font-weight: 600;
        color: #c5b358;
        text-align: center;
        }
        .cover .text .text-2{
        font-size: 15px;
        font-weight: 500;
        }
        .container .forms{
        height: 100%;
        width: 100%;
        background: #c5b358;
        }
        .container .form-content{
        display: flex;
        align-items: center;
        justify-content: space-between;
        }
        .form-content .login-form,
        .form-content .signup-form{
        width: calc(100% / 2 - 25px);
        }
        .forms .form-content .title{
        position: relative;
        font-size: 24px;
        font-weight: 500;
        color: #333;
        }
        .forms .form-content .title:before{
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        height: 3px;
        width: 25px;
        background: black;
        }
        .forms .signup-form  .title:before{
        width: 20px;
        }
        .forms .form-content .input-boxes{
        margin-top: 30px;
        background-color: #c5b358;
        }
        .forms .form-content .input-box{
        display: flex;
        align-items: center;
        height: 50px;
        background-color: #c5b358;
        width: 100%;
        margin: 10px 0;
        position: relative;
        }
        .form-content .input-box input{
        height: 100%;
        width: 100%;
        outline: none;
        background-color: #c5b358;
        border: none;
        padding: 0 30px;
        font-size: 16px;
        font-weight: 500;
        border-bottom: 2px solid rgba(0,0,0,0.2);
        transition: all 0.3s ease;
        }
        .form-content .input-box input:focus,
        .form-content .input-box input:valid{
        border-color: black;
        }
        .form-content .input-box i{
        position: absolute;
        color: black;
        font-size: 17px;
        }
        .forms .form-content .text{
        font-size: 14px;
        font-weight: 500;
        color:black;
        }
        .forms .form-content .text a{
        text-decoration: none;
        }
        .forms .form-content .text a:hover{
        text-decoration: underline;
        }
        .forms .form-content .button{
        color: #c5b358;
        margin-top: 40px;
        }
        .forms .form-content .button input{
        color: #c5b358;
        background: #0d062a;
        border-radius: 6px;
        padding: 0;
        cursor: pointer;
        transition: all 0.4s ease;
        }
        .forms .form-content .button input:hover{
        background: #f0ffff ;
        }
        .forms .form-content label{
        color: #5b13b9;
        cursor: pointer;
        }
        .forms .form-content label:hover{
        text-decoration: underline;
        }
        .forms .form-content .login-text,
        .forms .form-content .sign-up-text{
        text-align: center;
        margin-top: 25px;
        }
        .container #flip{
        display: none;
        }
        @media (max-width: 730px) {
        .container .cover{
            display: none;
        }
        .form-content .login-form,
        .form-content .signup-form{
            width: 100%;
        }
        .form-content .signup-form{
            display: none;
        }
        .container #flip:checked ~ .forms .signup-form{
            display: block;
        }
        .container #flip:checked ~ .forms .login-form{
            display: none;
        }
        }
    </style>
   </head>
<body>
  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="/images/logo.png" alt="">
      </div>
      <div class="back">
      </div>
    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Log in</div>
            <form action="{{route('login-user')}}" method="post">
                @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if(Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                @endif
                @csrf
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" class="form-control" placeholder="Enter Username" name="username" value="{{old('username')}}">
                <span class="text-danger">@error('username') {{$message}} @enderror</span>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                    <input type="password" class="form-control" placeholder="Enter Password" name="password" value="{{old('username')}}">
                    <span class="text-danger">@error('password') {{$message}} @enderror</span>
              </div>
              <div class="button input-box">
                <input type="submit" value="Submit">
              </div>
            </div>
        </form>
      </div>
      </form>
    </div>
    </div>
    </div>
  </div>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var inputUsername = document.querySelector('input[name="username"]');
        var inputPassword = document.querySelector('input[name="password"]');
        
        // Function to check if Caps Lock is on
        function checkCapsLock(event) {
          var isCapsLockOn = event.getModifierState && event.getModifierState('CapsLock');
          if (isCapsLockOn) {
            alert("Warning: Caps Lock is on. Double-check your typing.");
          }
        }
        
        // Attach event listener to username and password inputs
        inputUsername.addEventListener('keyup', checkCapsLock);
        inputPassword.addEventListener('keyup', checkCapsLock);
      });
    </script>
</body>
</html>
