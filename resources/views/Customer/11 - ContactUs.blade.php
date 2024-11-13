@include('components.header-footer')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechXpertz</title>
    <link rel="icon" href="{{ asset('images/TechXpertz-Icon.ico') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/Customer/customer-headerfooter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Customer/customer-loadingscreen.css') }}">

    <link rel="stylesheet" href="{{ asset('css/Customer/11 - ContactUs.css') }}">
</head>
<body>
    @yield('header')
    <div class="contact-us-content">
        <div class="left-content">
            <h1>Contact <span>Us</span></h1>
            <p>We're here to assist with any questions or support you need. Whether it's about tracking your repair status, appointment scheduling, or service inquiries. Don’t hesitate to reach out, we look forward to ensuring a seamless experience for you!</p>
        </div>

        <form class="right-content">
            <div class="form-section">
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" name="firstname" value="{{Auth::user()->firstname ?? ''}}" required> 
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname" name="lastname" value="{{Auth::user()->lastname ?? ''}}" required>
                </div>                
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{Auth::user()->email ?? ''}}" required>
            </div>
            <div class="form-group">
                <label for="message">What can we help you with?</label>
                <textarea name="message" class="message" id="message" cols="25" rows="7" ></textarea>  
            </div>
            <input type="submit" class="submit" value="SUBMIT">
        </form>
    </div>
    @yield('footer')
    <script src="{{asset('js/Customer/header-footer.js')}}" defer></script>
    <script src="{{asset('js/Customer/customer-loadingscreen.js')}}" defer></script>
</body>
</html>