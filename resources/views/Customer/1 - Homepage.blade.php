@include('components.header-footer')
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TechXpertz</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('css/Customer/header-footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/1 - Homepage.css') }}">
    </head>
    <body>

        @yield('header')
        
        <div class="container-1">
            <div class="text-content">
                <h1>Discover the perfect tech solutions for your needs</h1>
                <p>Explore a wide range of services tailored to meet your unique requirements, ensuring you find the perfect fit for your tech needs</p>
                <button class="learn-more-btn">LEARN MORE</button>
            </div>
            <div class="slider-indicators">
                <span class="active"></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <div class="container-2">
            <div class="text-content-2">
                <h2>Featured Categories</h2>
                <a href="#" class="view-more">View More <i class="fa-solid fa-arrow-right"></i></a>            
            </div>

            <div class="categories-2">
                <div class="category">
                    <div class="icon">
                        <i class="fa fa-desktop"></i>
                    </div>
                    <div class="text">
                        <h3>Smartphones</h3>
                        <p>24 Repair Shops</p>
                    </div>
                </div>
                <div class="category">
                    <div class="icon">
                        <i class="fa fa-desktop"></i>
                    </div>
                    <div class="text">
                        <h3>Tablets</h3>
                        <p>24 Repair Shops</p>
                    </div>
                </div>
                <div class="category">
                    <div class="icon">
                        <i class="fa fa-desktop"></i>
                    </div>
                    <div class="text">
                        <h3>Desktops</h3>
                        <p>24 Repair Shops</p>
                    </div>
                </div>
                <div class="category">
                    <div class="icon">
                        <i class="fa fa-desktop"></i>
                    </div>
                    <div class="text"  onclick="btnClick()">
                        <h3>Laptops</h3>
                        <p>24 Repair Shops</p>
                    </div>
                </div>
                <div class="category">
                    <div class="icon">
                        <i class="fa fa-desktop"></i>
                    </div>
                    <div class="text">
                        <h3>Smartwatches</h3>
                        <p>24 Repair Shops</p>
                    </div>
                </div>
                <div class="category">
                    <div class="icon">
                        <i class="fa fa-desktop"></i>
                    </div>
                    <div class="text">
                        <h3>Cameras</h3>
                        <p>24 Repair Shops</p>
                    </div>
                </div>
                <div class="category">
                    <div class="icon">
                        <i class="fa fa-desktop"></i>
                    </div>
                    <div class="text">
                        <h3>Printers</h3>
                        <p>24 Repair Shops</p>
                    </div>
                </div>
                <div class="category">
                    <div class="icon">
                        <i class="fa fa-desktop"></i>
                    </div>
                    <div class="text">
                        <h3>Speakers</h3>
                        <p>24 Repair Shops</p>
                    </div>
                </div>
                <div class="category">
                    <div class="icon">
                        <i class="fa fa-desktop"></i>
                    </div>
                    <div class="text">
                        <h3>Drones</h3>
                        <p>24 Repair Shops</p>
                    </div>
                </div>
                <div class="category">
                    <div class="icon">
                        <i class="fa fa-desktop"></i>
                    </div>
                    <div class="text">
                        <h3>All-in-one</h3>
                        <p>24 Repair Shops</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-3">
            <div class="header">
                <nav>
                    <a href="#" class="active">Best Shops</a>
                    <a href="#">For You</a>
                    <a href="#">Editors Pick</a>
                </nav>
    
                <div class="header-actions">
                    <button><i class="fa-solid fa-arrow-left"></i></button>
                    <button><i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </div>

            <div class="shops">
                <div class="shop">
                    <div class="shop-image" style="background-image: url('batz-logo.png');"></div>

                    <div class="shop-details">
                        <div class="shop-name">
                            <h3>BATZ</h3>
                            <i class="fa fa-desktop"></i>
                        </div>
                        
                        <div class="shop-location">
                            <p>123 Tech Street, Barangay Techville, Metro Manila</p>
                        </div>
                        
                        <div class="shop-schedule">
                            <p>+63 123 456 7890</p>
                            <h4>Mon - Fri</h4>              
                        </div>
    
                        <ul>
                            <li><i class="fa-solid fa-check"></i> Expert Tech Solutions</li>
                            <li><i class="fa-solid fa-check"></i> Fast Repairs Guaranteed</li>
                            <li><i class="fa-solid fa-check"></i> Reliable Service Network</li>
                            <li><i class="fa-solid fa-check"></i> Quality Workmanship Assured</li>
                        </ul>
                    </div>
                    
                    <div class="shop-footer">
                        <div class="rating">
                            <span>★★★★☆</span>
                            <p>210 Reviews</p>
                        </div>
                        <div class="actions">
                            <button class="favorite"><i class="fa-regular fa-heart"></i></button>
                            <button class="view"><i class="fa-solid fa-arrow-right-to-bracket"></i></button>
                        </div>
                    </div>
                </div>
                <div class="shop">
                    <div class="shop-image" style="background-image: url('batz-logo.png');"></div>
                    <div class="shop-details">
                        <div class="shop-name">
                            <h3>CAMFIX</h3>
                            <i class="fa fa-desktop"></i>
                        </div>
                        
                        <div class="shop-location">
                            <p>456 Tech Street, Barangay Techland, Cebu City, Cebu</p>
                        </div>
                        
                        <div class="shop-schedule">
                            <p>+63 123 456 7890</p>
                            <h4>Mon - Fri</h4>              
                        </div>
    
                        <ul>
                            <li><i class="fa-solid fa-check"></i> Expert Tech Solutions</li>
                            <li><i class="fa-solid fa-check"></i> Fast Repairs Guaranteed</li>
                            <li><i class="fa-solid fa-check"></i> Reliable Service Network</li>
                            <li><i class="fa-solid fa-check"></i> Quality Workmanship Assured</li>
                        </ul>
                    </div>
                    <div class="shop-footer">
                        <div class="rating">
                            <span>★★★★☆</span>
                            <p>210 Reviews</p>
                        </div>
                        <div class="actions">
                            <button class="favorite"><i class="fa-regular fa-heart"></i></button>
                            <button class="view"><i class="fa-solid fa-arrow-right-to-bracket"></i></button>
                        </div>
                    </div>
                </div>
                <div class="shop">
                    <div class="shop-image" style="background-image: url('batz-logo.png');"></div>
                    <div class="shop-details">
                        <div class="shop-name">
                            <h3>JBL SERVICE CENTER</h3>
                            <i class="fa fa-desktop"></i>
                        </div>
                        
                        <div class="shop-location">
                            <p>123 Tech Street, Barangay Techville, Metro Manila</p>
                        </div>
                        
                        <div class="shop-schedule">
                            <p>+63 123 456 7890</p>
                            <h4>Mon - Fri</h4>              
                        </div>
    
                        <ul>
                            <li><i class="fa-solid fa-check"></i> Expert Tech Solutions</li>
                            <li><i class="fa-solid fa-check"></i> Fast Repairs Guaranteed</li>
                            <li><i class="fa-solid fa-check"></i> Reliable Service Network</li>
                            <li><i class="fa-solid fa-check"></i> Quality Workmanship Assured</li>
                        </ul>
                    </div>
                    <div class="shop-footer">
                        <div class="rating">
                            <span>★★★★☆</span>
                            <p>210 Reviews</p>
                        </div>
                        <div class="actions">
                            <button class="favorite"><i class="fa-regular fa-heart"></i></button>
                            <button class="view"><i class="fa-solid fa-arrow-right-to-bracket"></i></button>
                        </div>
                    </div>
                </div>
                <div class="shop">
                    <div class="shop-image" style="background-image: url('batz-logo.png');"></div>
                    <div class="shop-details">
                        <div class="shop-name">
                            <h3>3JPS</h3>
                            <i class="fa fa-desktop"></i>
                        </div>
                        
                        <div class="shop-location">
                            <p>123 Tech Street, Barangay Techville, Metro Manila</p>
                        </div>
                        
                        <div class="shop-schedule">
                            <p>+63 123 456 7890</p>
                            <h4>Mon - Fri</h4>              
                        </div>
    
                        <ul>
                            <li><i class="fa-solid fa-check"></i> Expert Tech Solutions</li>
                            <li><i class="fa-solid fa-check"></i> Fast Repairs Guaranteed</li>
                            <li><i class="fa-solid fa-check"></i> Reliable Service Network</li>
                            <li><i class="fa-solid fa-check"></i> Quality Workmanship Assured</li>
                        </ul>
                    </div>
                    <div class="shop-footer">
                        <div class="rating">
                            <span>★★★★☆</span>
                            <p>210 Reviews</p>
                        </div>
                        <div class="actions">
                            <button class="favorite"><i class="fa-regular fa-heart"></i></button>
                            <button class="view"><i class="fa-solid fa-arrow-right-to-bracket"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @yield('footer')

        <script>
            // function btnClick(){
            //     window.location.href = ("3 - ViewCategory.html");
            // }
            // function btnClick2(){
            //     window.location.href = ("6 - RepairStatus.html");
            // }
        </script>
    </body>
</html>
