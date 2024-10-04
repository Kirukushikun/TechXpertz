<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TechXpertz</title>
        <link rel="stylesheet" href="{{asset('css/Admin/0 - Login.css')}}" />
    </head>
    <body>
        <div class="container">
            <div class="right">
                <div class="form-container">
                    <div class="logo">
                        <h1>Tech<span>X</span>pertz</h1>
                        <p>ADMIN</p>
                    </div>
                    @if(session()->has('error'))
                        <p class="error-message">{{session('error')}}</p>
                    @endif
                    <form action="{{route('admin.loginAdmin')}}" method="POST">
                        @csrf
                        <input type="email" name="email" placeholder="Email" required />
                        <input type="password" name="password" placeholder="Password" required />
                        <div class="remember-me">
                            <label>
                                <label class="switch">
                                    <input type="checkbox" id="dark-mode-toggle">
                                    <span class="slider round"></span>
                                </label>         
                                Remember Me
                            </label>
                            <a href="#">Forgot password?</a>
                        </div>
                        <button type="submit">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
