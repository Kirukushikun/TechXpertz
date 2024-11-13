@section('header')
<div class="navbar-collapse" id="navbar-collapse">
    <div class="collapse-header">
        <div class="logo load" onclick="window.location.href='{{route('welcome')}}'">Tech<span>X</span>pertz</div>
        <i class="fa-solid fa-bars" id="uncollapse-btn"></i>
    </div>
    
    <form class="search-bar" action="{{ route('search') }}" method="GET">
        @csrf
        <input type="text" name="query" class="query" id="query" placeholder="Search here..." />
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>

    <div class="collapse-categories">
        <a href="{{ route('viewcategory', ['category'=>'All']) }}" class="load">All Categories</a>
        <a href="{{ route('viewcategory', ['category'=>'Smartphone']) }}" class="load">Smartphones</a>
        <a href="{{ route('viewcategory', ['category'=>'Tablet']) }}" class="load">Tablets</a>
        <a href="{{ route('viewcategory', ['category'=>'Desktop']) }}" class="load">Desktops</a>
        <a href="{{ route('viewcategory', ['category'=>'Laptop']) }}" class="load">Laptops</a>
        <a href="{{ route('viewcategory', ['category'=>'Smartwatch']) }}" class="load">Smartwatches</a>
        <a href="{{ route('viewcategory', ['category'=>'Camera']) }}" class="load">Cameras</a>
        <a href="{{ route('viewcategory', ['category'=>'Printer']) }}" class="load">Printers</a>
        <a href="{{ route('viewcategory', ['category'=>'Speaker']) }}" class="load">Speakers</a>
        <a href="{{ route('viewcategory', ['category'=>'Drone']) }}" class="load">Drones</a>
        <a href="{{ route('viewcategory', ['category'=>'All-In-One']) }}" class="load">All-In-One</a>
    </div>

    <div class="collapse-footer">
        @auth
            <button class="account-button load" onclick="window.location.href='/customer/myaccount'"><i class="fa fa-user"></i>My Account</button>
        @else
            <button class="account-button load" onclick="window.location.href='/customer/login'"><i class="fa fa-user"></i>Login</button>
        @endauth
    </div>
</div>

<nav class="navbar">
    <div class="logo load" onclick="window.location.href='{{route('welcome')}}'">Tech<span>X</span>pertz</div>
    <form class="search-bar" action="{{ route('search') }}" method="GET">
        @csrf
        <input type="text" name="query" class="query" id="query" placeholder="Search here..." />
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>
    <div class="icons">
        <i class="fa-solid fa-screwdriver-wrench load" onclick="window.location.href='/repairlist'"></i>
        <i class="fa-solid fa-message" onclick="window.location.href='/messages'"></i>
        <i class="fa-solid fa-heart" onclick="window.location.href='/customer/favorites'"></i>
    </div>

    @auth
        <button class="account-button load" onclick="window.location.href='/customer/myaccount'"><i class="fa fa-user"></i>My Account</button>
    @else
        <button class="account-button load" onclick="window.location.href='/customer/login'"><i class="fa fa-user"></i>Login</button>
    @endauth
</nav>

<div class="categories">
    <a href="{{ route('viewcategory', ['category'=>'All']) }}" class="load">All Categories</a>
    <a href="{{ route('viewcategory', ['category'=>'Smartphone']) }}" class="load">Smartphones</a>
    <a href="{{ route('viewcategory', ['category'=>'Tablet']) }}" class="load">Tablets</a>
    <a href="{{ route('viewcategory', ['category'=>'Desktop']) }}" class="load">Desktops</a>
    <a href="{{ route('viewcategory', ['category'=>'Laptop']) }}" class="load">Laptops</a>
    <a href="{{ route('viewcategory', ['category'=>'Smartwatch']) }}" class="load">Smartwatches</a>
    <a href="{{ route('viewcategory', ['category'=>'Camera']) }}" class="load">Cameras</a>
    <a href="{{ route('viewcategory', ['category'=>'Printer']) }}" class="load">Printers</a>
    <a href="{{ route('viewcategory', ['category'=>'Speaker']) }}" class="load">Speakers</a>
    <a href="{{ route('viewcategory', ['category'=>'Drone']) }}" class="load">Drones</a>
    <a href="{{ route('viewcategory', ['category'=>'All-In-One']) }}" class="load">All-In-One</a>
</div>

<div class="navbar collapse">
    <div class="icons">
        <i class="fa-solid fa-screwdriver-wrench load" onclick="window.location.href='/repairlist'"></i>
        <i class="fa-solid fa-message" onclick="window.location.href='/messages'"></i>
    </div>
    <div class="logo load" onclick="window.location.href='{{route('welcome')}}'">Tech<span>X</span>pertz</div>
    <div class="icons">
        <i class="fa-solid fa-heart" onclick="window.location.href='/customer/favorites'"></i>
        <i class="fa-regular fa-user" onclick="window.location.href='/customer/myaccount'"></i>  
        <i class="fa-solid fa-bars" id="collapse-btn"></i>
    </div>
</div>

@endsection

@section('footer')
<footer class="footer">
    <div class="footer-container">
        
        <div class="footer-logo">
            <div class="logo" onclick="window.location.href='{{route('welcome')}}'">Tech<span>X</span>pertz</div>
            <p class="description">TechXpertz connects you with trusted tech repair experts, offering quick, reliable service for all your device needs.</p>
            <div class="contact-info">
                <i class="fa-solid fa-headset"></i>
                <div>
                    <p>Have any question?</p>
                    <p><a href="tel:+631234567890">+63 123 456 7890</a></p>
                </div>
                <button class="live-chat">EMAIL US</button>
            </div>
        </div>

        <div class="links quick-links">
            <h3>QUICK LINKS</h3>
            <ul>
                <li><a href="/about">About us</a></li>
                <li><a href="/contact-us">Contact us</a></li>
                <li><a href="/report">Report</a></li>
                <li><a href="/customer/login">Login</a></li>
                <li><a href="/customer/signup">Sign Up</a></li>
            </ul>
        </div>

        <div class="links customer-area">
            <h3>CUSTOMER AREA</h3>
            <ul>
                <li><a href="/customer/myaccount">My Account</a></li>
                <li><a href="/repairlist">Repair List</a></li>
                <li><a href="/messages">Messages</a></li>
                <li><a href="/terms-of-service">Terms</a></li>
                <li><a href="/privacy-policy">Privacy Policy</a></li>
            </ul>
        </div>

        <div class="links follow-us">
            <h3>FOLLOW US</h3>
            <div class="social-icons">
                <a href="#"><i class="fa-brands fa-youtube"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-square-facebook"></i></a>
                <a href="#"><i class="fa-brands fa-github"></i></a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>TECHXPERTZ - © 2024 All Rights Reserved</p>
    </div>
</footer>
@endsection