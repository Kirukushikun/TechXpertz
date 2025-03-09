<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TechXpertz</title>
        <link rel="icon" href="{{ asset('images/TechXpertz-Icon.ico') }}">
        <link rel="stylesheet" href="{{asset('css/Customer/0 - Login.css')}}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    </head>
    <body>

    
        <div class="container">
            <div class="left">
                <img src="{{asset('images/login-background.png')}}" alt="" />
            </div>

            <div class="right">
                <div class="form-container">
                    <h1>Tech<span>X</span>pertz</h1>
                    @if(session()->has('error'))
                        <p class="error-message">{{session('error')}}</p>
                    @elseif(session()->has('success'))
                        <p class="success-message">{{session('success')}}</p>
                    @endif
                    <form action="{{route('customer.loginCustomer')}}" method="post">
                        @csrf   
                        <input type="email" name="email" id="email" placeholder="email" required />
                        <div class="input-password">
                            <input type="password" name="password" id="password" placeholder="Password" required />
                            <i id="icon" class="fa-solid fa-eye-slash" onmousedown="reveal('password')" onmouseup="unreveal('password')"></i>
                        </div>
                        
                        <div class="remember-me">
                            <label>
                                <label class="switch">
                                    <input type="checkbox" name="remember_me" id="dark-mode-toggle">
                                    <span class="slider round"></span>
                                </label>         
                                <p>Remember Me</p>
                            </label>
                            
                            <a href="/customer/password/forgot">Forgot password?</a>
                        </div>
                        <button type="submit" id="submit" class="load">Sign in</button>
                    </form>
                    <div class="social-login">
                        <!-- <button class="google-login" id="google-login">
                            <img src="{{asset('images/google-icon.png')}}" alt="" />
                            Or sign in with Google
                        </button> -->
                    </div>
                    <div class="signup-link">
                        <p>Don't have an account? <a href="/customer/signup">Sign up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script>
        function reveal(input) {
            let password = document.getElementById(input);
            let icon = document.getElementById("icon");
            password.type = "text";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }

        function unreveal(input) {
            let password = document.getElementById("password");
            let icon = document.getElementById("icon");
            password.type = "password";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        }
    </script>

</html>
