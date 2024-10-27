@section('header')
<div class="navbar-collapse" id="navbar-collapse">
    <div class="collapse-header">
        <div class="logo load" onclick="window.location.href='{{route('welcome')}}'">Tech<span>X</span>pertz</div>
        <i class="fa-solid fa-bars" id="uncollapse-btn"></i>
    </div>
    
    <div class="search-bar">
        <input type="text" placeholder="Search here..." />
        <button><i class="fa fa-search"></i></button>
    </div>

    <div class="collapse-categories">
        <a href="#">All Categories</a>
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
    <div class="search-bar">
        <input type="text" placeholder="Search here..." />
        <button><i class="fa fa-search"></i></button>
    </div>
    <div class="icons">
        <i class="fa-solid fa-screwdriver-wrench load" onclick="window.location.href='/repairlist'"></i>
        <i class="fa-solid fa-message" onclick="window.location.href='/messages'"></i>
    </div>

    @auth
        <button class="account-button load" onclick="window.location.href='/customer/myaccount'"><i class="fa fa-user"></i>My Account</button>
    @else
        <button class="account-button load" onclick="window.location.href='/customer/login'"><i class="fa fa-user"></i>Login</button>
    @endauth
</nav>

<div class="categories">
    <a href="#">All Categories</a>
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
      <i class="fa-regular fa-user" onclick="window.location.href='/customer/myaccount'"></i>  
    </div>
    <div class="logo load" onclick="window.location.href='{{route('welcome')}}'">Tech<span>X</span>pertz</div>
    <div class="icons">
        <i class="fa-solid fa-screwdriver-wrench load" onclick="window.location.href='/repairlist'"></i>
        <i class="fa-solid fa-message" onclick="window.location.href='/messages'"></i>
        <i class="fa-solid fa-bars" id="collapse-btn"></i>
    </div>
</div>

@endsection

@section('footer')
<footer class="footer">
    <div class="footer-container">
        
        <div class="footer-logo">
            <div class="logo" onclick="window.location.href='{{route('welcome')}}'">Tech<span>X</span>pertz</div>
            <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</p>
            <div class="contact-info">
                <i class="fa-solid fa-headset"></i>
                <div>
                    <p>Have any question?</p>
                    <p><a href="tel:+631234567890">+63 123 456 7890</a></p>
                </div>
                <button class="live-chat">LIVE CHAT</button>
            </div>
        </div>

        <div class="links quick-links">
            <h3>QUICK LINKS</h3>
            <ul>
                <li><a href="#">About us</a></li>
                <li><a href="#">Contact us</a></li>
                <li><a href="#">Products</a></li>
                <li><a href="#">Login</a></li>
                <li><a href="#">Sign Up</a></li>
            </ul>
        </div>

        <div class="links customer-area">
            <h3>CUSTOMER AREA</h3>
            <ul>
                <li><a href="#">My Account</a></li>
                <li><a href="#">Orders</a></li>
                <li><a href="#">Tracking List</a></li>
                <li><a href="#">Terms</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Repair Status</a></li>
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