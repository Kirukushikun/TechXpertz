<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TechXpertz</title>
        <link rel="stylesheet" href="{{asset('css/Customer/0 - Login.css')}}" />
    </head>
    <body>
        <div class="container">
            <div class="left">
                <img src="background-image.jpg" alt="Background Image" />
            </div>

            <div class="right">
                <div class="form-container">
                    <h1>Tech<span>X</span>pertz</h1>
                    <form action="" method="post">
                        @csrf
                        <input type="email" name="email" id="email" placeholder="email" required />
                        <input type="password" name="password" id="password" placeholder="Password" required />
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
                        <button type="submit" id="submit">Sign in</button>
                    </form>
                    <div class="social-login">
                        <button class="google-login">
                            <img src="google-logo.png" alt="Image" />
                            Or sign in with Google
                        </button>
                    </div>
                    <div class="signup-link">
                        <p>Don't have an account? <a href="#">Sign up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script src="{{ asset('js/Customer/0 - Login.js') }}" type="module"></script>

</html>
