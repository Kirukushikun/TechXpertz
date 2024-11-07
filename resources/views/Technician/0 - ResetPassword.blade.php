<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TechXpertz</title>
    <link rel="stylesheet" href="{{ asset('css/Customer/0 - Forgot.css') }}" />
</head>
<body>



<div class="form-container">
    <h1>Reset <span>Password</span></h1>
    <p>Enter a new password below to change your password</p>
    <form action="{{route('technician.reset.update')}}" method="POST">
        @if(session()->has('error'))
            <p class="error-message">{{session('error')}}</p>
        @endif
        @csrf

        <!-- Add a hidden input for the token -->
        <input type="hidden" name="token" value="{{ request()->route('token') }}">

        <input type="email" name="email" placeholder="Re-enter your email" required />
        <input type="password" name="password" placeholder="New Password" required />
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required />
        <button type="submit" id="submit">Reset Password</button>
    </form>
</div>

</body>

<!-- <script src="{{ asset('js/Customer/0 - Registration.js') }}" type="module"></script> -->

</html>
