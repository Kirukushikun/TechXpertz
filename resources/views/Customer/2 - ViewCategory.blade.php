@include('components.header-footer')
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TechXpertz</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('css/Customer/header-footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/2 - ViewCategory.css') }}">
    </head>
    <body>

        @yield('header')
        
        <div class="container-3">

            <div class="banner">
                <h1>Laptop Category</h1>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Provident, soluta!</p>
            </div>

            <div class="header">
                <nav>
                    <a href="#" class="active">Laptop Repair Shops</a>
                    <p>Showing 9 out o 120 results</p>
                </nav>
    
                <div class="header-actions">
                    <a><i class="fa-solid fa-arrow-down-wide-short"></i></a>
                    <a><i class="fa-solid fa-arrow-down-short-wide"></i></a>
                    <a class="filter">Popularity<i class="fa-solid fa-caret-down"></i></a>
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
                            <button class="view" onclick="btnClick()"><i class="fa-solid fa-arrow-right-to-bracket"></i></button>
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

            <div class="pagination">
                <a href="#" class="active">1</a>
                <a href="#">2</a>
                <a href="#">3</i></a>
                <a href="#">...</a>
            </div>
        </div>

        @yield('footer')

        <script>
            // function btnClick(){
            //     window.location.href = ("4 - ViewShop.html");
            // }
        </script>
    </body>
</html>
