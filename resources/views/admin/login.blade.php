<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
    <!-- Title Page-->
    <title>Admin-Login</title>
 
    <link href="{{asset('admin_assets/css/font-face.css')}}" type="text/css" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/font-awesome-4.7/css/font-awesome.min.css')}}"type="text/css" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" type="text/css" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" type="text/css"    rel="stylesheet" media="all">
 
    <link href="{{asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.css')}}" type="text/css" rel="stylesheet" media="all">
 
    <link href="{{asset('admin_assets/css/theme.css')}}" type="text/css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                     <a href="#">
 
          <img src="{{asset('admin_assets/images/icon/shop1.png')}}" alt="WelcomeAdmin"></a>
                        </div>
                        <div class="login-form">
                            <form action="{{route('admin.auth')}}" method="POST">
                               @csrf
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">Remember Me
                                    </label>
                                    <label>
                                        <a href="#">Forgotten Password?</a>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                                @if(session()->has('error')) 
                                <div class="alert alert-danger"role="alert">
                              
                                   {{session('error')}}
                                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                     <span aria-hidden="true">⨉</span>
                                    </button>      
                                </div>
                                @endif
        
                            </form>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{asset('admin_assets/vendor/jquery-3.2.1.min.js')}}"></script>
 
    <script src="{{asset('admin_assets/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
 
    <script src="{{asset('admin_assets/vendor/wow/wow.min.js')}}"></script>
   
    <script src="{{asset('admin_assets/js/main.js')}}"></script>

</body>

</html>
<!-- end document-->