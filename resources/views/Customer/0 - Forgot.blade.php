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



    <div class="form-container">
        <h1>Enter Your <span>Email</span></h1>
        <p>We'll send a password reset link to the email address you provide below.</p>
        <form class="sendResetEmailForm" action="{{route('customer.sendResetLinkEmail')}}" method="POST">
            @if(session()->has('error'))
                <p class="error-message">{{session('error')}}</p>
            @endif
            @csrf
            <input type="email" name="email" id="email" placeholder="Email Address" required />
            <button type="submit" id="submit">Send Link</button>
        </form>
        @if(session()->has('status'))
            <div class="signup-link">
                <p class="success-message">{{ session('status') }} Resend in <span id="countdown">(30)</span></p>
            </div>
        @endif
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Selecting form and button
            const sendResetEmailForm = document.querySelector('.sendResetEmailForm');
            const submitBtn = document.getElementById('submit');
            const countdownElement = document.getElementById('countdown');
            let countdown = 30; // Initial countdown time in seconds
            

            // Handle the form's submit event
            sendResetEmailForm.addEventListener('submit', function() {
                const emailInput = document.getElementById('email').value;
                if (emailInput) { // Check if email input is filled
                    submitBtn.classList.add('disabled');
                    submitBtn.innerText = "Email Sent";  // Update button text
                    submitBtn.disabled = true;
                }
            });

            const successContainer = document.querySelector('.signup-link');
            if(successContainer){
                submitBtn.classList.add('disabled');
                submitBtn.innerText = "Email Sent";  // Update button text
                submitBtn.disabled = true;

                // Start the countdown
                const countdownInterval = setInterval(() => {
                    countdown--;
                    countdownElement.textContent = `(${countdown})`;

                    // When countdown reaches 0, stop the timer and show "Resend" link
                    if (countdown <= 0) {
                        clearInterval(countdownInterval);
                        successContainer.innerHTML = `<p class="success-message">Didn’t receive the link? <span>Please re-enter your email and request another link.</span></p>`;
                        submitBtn.disabled = false; // Re-enable the submit button
                        submitBtn.innerText = "Send Link";
                        submitBtn.classList.remove('disabled');
                    }
                }, 1000); // Update every second
            }
        });
    </script>
</body>


</html>
