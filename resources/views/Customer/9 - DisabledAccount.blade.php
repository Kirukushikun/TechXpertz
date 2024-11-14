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
    <!-- {{$status}} -->
    <div class="disabled-container">
        <div class="logo">
            <h2>Tech<span>X</span>pertz</h2>
        </div>

        @if($status == 'deleted')
            <div class="website-message deleted">
                <h2>This account has been deleted.</h2>
                <h3>You have requested to delete your account data. Deletion process will start in 30 days.</h3>
            </div>
        @else 
            <div class="website-message restricted">
                <h2>This account has been restricted.</h2>
                <h3>
                    It looks like this account violated the TechXpertz Use Policy <a href="/terms-of-service">TechXpertz/Terms</a> and has been restricted.
                    If you think this was a mistake. Try contacting us to request for a review.
                </h3>
            </div>
        @endif

        <div class="website-action">
            <button onclick="window.location.href='/'">Back to Homepage</button>
        </div>
    </div>
</body>
</html>