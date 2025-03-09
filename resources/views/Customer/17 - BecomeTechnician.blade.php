@include('components.header-footer')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechXpertz</title>
    <link rel="icon" href="{{ asset('images/TechXpertz-Icon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/Customer/17 - BecomeTechnician.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
</head>
<body>
    <nav>
        <div class="logo">
            Tech<span>X</span>pertz
        </div>

        <div class="links">
            <ul>
                <li onclick="window.location.href='#container-1'">Home</li>
                <li onclick="window.location.href='#container-2'">Overview</li>
                <li onclick="window.location.href='#container-3'">Benefits</li>
                <li onclick="window.location.href='#container-4'">Steps to Join</li>
            </ul>
        </div>

        <div class="action">
            <Button onclick="window.location.href='/technician/signup'">Sign Up</Button>
        </div>
    </nav>

    <div class="container container-1" id="container-1" style="background-image:url({{asset('images/About1-bg.png')}});" >
        <!-- style="background-image:url({{asset('images/About1-bg.png')}});" -->
        <div class="details">
            <h1>Unlock Your Potential: Become a Tech<span>X</span>pertz Technician!</h1>
            <p>Join our growing community of skilled technicians and showcase your expertise to a wide range of customers. Be part of a trusted platform that connects you with people who need your services the most.</p>
            <button onclick="location.href='/technician/signup'">JOIN US</button>
        </div> 

    </div>

    <div class="container container-2" id="container-2">
        <div class="details">
            <h1>Your Journey <span>Starts Here!</span></h1>
            <p>Becoming a technician is easy, and the opportunities are endless. Take the first step today and join a platform designed to support and elevate your career.</p>
            <button onclick="location.href='/technician/login'">Get Started</button>
        </div>

        <div class="image">
            <div class="url">
                <p>Https://techxpertz.tech</p>
            </div>
            <img src="{{ asset('images/TabDashboard.png') }}" alt="Image Unavailable">
        </div>
    </div>

    <div class="container container-3" id="container-3">
        <div class="details">
            <h1>Benefits of Becoming a <span>Technician</span></h1>
            <p>Discover the advantages of joining TechXpertz as a technician. From gaining access to a larger customer base to enhancing your professional reputation.</p>
            <ul>
                <li><i class="fa-solid fa-circle"></i>Gain Visibility: Your profile will be featured, helping you attract more customers.</li>
                <li><i class="fa-solid fa-circle"></i>Build Trust: Receive reviews from satisfied customers and establish credibility.</li>
                <li><i class="fa-solid fa-circle"></i>Expand Your Business: Access a broader audience without the need for physical marketing.</li>
                <li><i class="fa-solid fa-circle"></i>Exclusive Perks: Get listed on our homepage as one of the best-rated technicians.</li>
            </ul>
        </div>

        <div class="image" style="background-image:url({{asset('images/WomanLaptop.jpg')}});">
            
        </div>
    </div>

    <div class="container container-4" id="container-4">
        <div class="image" style="background-image:url({{asset('images/ManLaptop.jpg')}});">
        
        </div>
        <div class="details">
            <h1>How to <span>Get Started?</span></h1>
            <p>Start by signing up and creating your technician profile. Share details about your expertise, services offered, and experience to help customers find you.</p>
            <ul>
                <li>Sign Up: Create an account<i class="fa-solid fa-circle"></i></li>
                <li>Complete Your Profile: Add your skills, certifications, and contact details <i class="fa-solid fa-circle"></i></li>
                <li>Verification: Submit the required documents to verify your identity <i class="fa-solid fa-circle"></i></li>
                <li>Start Earning: Begin receiving bookings and grow your reputation <i class="fa-solid fa-circle"></i></li>
            </ul>
        </div>
    </div>

    @yield('footer')
</body>
</html>