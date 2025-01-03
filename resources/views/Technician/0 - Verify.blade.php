<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TechXpertz</title>
    <link rel="icon" href="{{ asset('images/TechXpertz-Icon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/Customer/0 - Forgot.css') }}" />
</head>
<body>

        @php 
            $technician = App\Models\Technician::whereNotNull('email_verified_at')->firstOrFail();
        @endphp

        @if($technician->email_verified_at != null)
            <div class="form-container">
                <h1>Email <span>Verified</span></h1>
                <p>Your email address was successfully verified. Please go to the login page to access your account.</p>

                <form class="sendVerifyEmailForm" action="/technician/login" method="GET">
                    <button type="submit" id="submit">Login</button>
                </form>
            </div>
        @else
            <div class="form-container">
                <h1>Verify Your <span>Email</span></h1>
                <p>Please click on the link sent to your email to verify your account and complete the registration process.</p>

                <form class="sendVerifyEmailForm" action="{{ route('technician.verify', ['email' => $email]) }}" method="GET">
                    <button type="submit" id="submit" disabled aria-disabled="true">Resend in <span id="countdown">(30)</span></button>
                </form>
            </div>
        @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const countdownElement = document.getElementById('countdown');
            const submitButton = document.getElementById('submit');
            let countdown = 30; // initial countdown time in seconds

            // Function to update the countdown
            const updateCountdown = () => {
                countdown--;
                countdownElement.textContent = `(${countdown})`;

                if (countdown <= 0) {
                    clearInterval(interval); // stop the countdown
                    submitButton.disabled = false; // enable the button
                    countdownElement.textContent = ''; // clear countdown display
                    submitButton.textContent = 'Resend'; // update button text
                }
            };

            // Start the countdown
            const interval = setInterval(updateCountdown, 1000);
        });
    </script>

</body>


</html>
