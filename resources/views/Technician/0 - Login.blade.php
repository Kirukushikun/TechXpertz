<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TechXpertz</title>
        <link rel="icon" href="{{ asset('images/TechXpertz-Icon.ico') }}">
        <link rel="stylesheet" href="{{asset('css/Technician/0 - Login.css')}}" />
    </head>
    <body>
        <div class="container">
            <div class="right">
                <div class="form-container">
                    <div class="logo">
                        <h1>Tech<span>X</span>pertz</h1>
                        <p>Technician</p>
                    </div>
                    @if(session()->has('error'))
                        <p class="error-message">{{session('error')}}</p>
                    @elseif(session()->has('success'))
                        <p class="success-message">{{session('success')}}</p>
                    @endif
                    <form action="{{route('technician.loginTechnician')}}" method="POST">
                        @csrf
                        <input type="email" name="email" placeholder="Email" required />
                        <input type="password" name="password" placeholder="Password" required />
                        <div class="remember-me">
                            <label>
                                <label class="switch">
                                    <input type="checkbox" name="remember_me" id="dark-mode-toggle">
                                    <span class="slider round"></span>
                                </label>         
                                Remember Me
                            </label>
                            <a href="/technician/password/forgot">Forgot password?</a>
                        </div>
                        <button type="submit">Sign in</button>
                    </form> 
                </div>
            </div>
        </div>
    </body>
</html>
