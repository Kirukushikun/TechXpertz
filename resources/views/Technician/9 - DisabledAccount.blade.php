<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechXpertz</title>
    <link rel="icon" href="{{ asset('images/TechXpertz-Icon.ico') }}">
    <link rel="stylesheet" href="{{asset('css/Customer/9 - DisabledAccount.css')}}">
</head>
<body>
    <div class="disabled-container">
        <div class="logo">
            <h2>Tech<span>X</span>pertz</h2>
        </div>
            
        @if($status == 'deleted')
            <div class="website-message deleted">
                <h2>Account Deleted</h2>
                @if(session()->has('message'))
                    <h3>{{session('message')}}</h3>
                @else
                    <h3>Were sorry, but this account has been permanently deleted and can no longer be accessed. If you believe this is an error or have further questions, please contact our <a href="/contact-us">support team</a> for assistance.</h3>
                @endif
            </div>
        @elseif ($status == 'restricted')
            <div class="website-message restricted">
                <h2>Account Restricted</h2>
                <h3>
                    Your account has been temporarily restricted due to a potential policy violation and is currently under review by our administration team. Please remain patient as we conduct a thorough investigation to ensure the safety and compliance of all users with our <a href="/terms-of-service">Policies</a>. 
                </h3>
            </div>
        @endif

        <div class="website-action">
            <button onclick="window.location.href='/'">Back to Homepage</button>
        </div>
    </div>
</body>
</html>