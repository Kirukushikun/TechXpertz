@section('header')
<nav class="navbar">
    <div class="logo">Tech<span>X</span>pertz</div>
    <div class="search-bar">
        <input type="text" placeholder="Search here..." />
        <button><i class="fa fa-search"></i></button>
    </div>
    <div class="icons">
        <i class="fa fa-desktop" onclick="btnClick2()"></i>
        <i class="fa fa-cog"></i>
    </div>

    @if(Auth::check())
    <button class="account-button"><i class="fa fa-user"></i>My Account</button>
    @else
    <button class="account-button"><i class="fa fa-user"></i>Login</button>
    @endif

 
</nav>

<div class="categories">
    <a href="#">All Categories</a>
    <a href="#">Smartphones</a>
    <a href="#">Tablets</a>
    <a href="#">Desktops</a>
    <a href="#">Laptops</a>
    <a href="#">Smartwatches</a>
    <a href="#">Cameras</a>
    <a href="#">Printers</a>
    <a href="#">Speakers</a>
    <a href="#">Drones</a>
</div>
@endsection

@section('footer')
<footer class="footer">
    <div class="footer-container">
        
        <div class="footer-logo">
            <div class="logo">Tech<span>X</span>pertz</div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</p>
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