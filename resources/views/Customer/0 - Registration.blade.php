<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TechXpertz</title>
        <link rel="stylesheet" href="{{asset('css/Customer/0 - Registration.css')}}" />
    </head>
    <body>

        <div class="form-container">
            <h1>Sign <span>Up</span></h1>
            <form action="" method="post">
                @csrf
                <div class="input-group">
                    <input type="text" name="name" id="name" placeholder="First Name" required>
                    <input type="text" name="lastname" id="lastname" placeholder="Last Name" required>
                </div>
                <input type="email" name="email" id="email" placeholder="Email Address" required />
                <input type="password" name="password" id="password" placeholder="Password" required />
                <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Password" required />
                <button type="submit" id="submit">Sign Up</button>
            </form>
            <div class="signup-link">
                <p>Already have an account? <a href="#">Sign In</a></p>
            </div>
        </div>

    </body>

    <script src="{{ asset('js/Customer/0 - Registration.js') }}" type="module"></script>

</html>
