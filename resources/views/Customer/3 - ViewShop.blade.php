@include('components.header-footer')
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TechXpertz</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('css/Customer/header-footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/3 - ViewShop.css') }}">
    </head>
    <body>

        @yield('header')
        
        <div class="container-shop">
            <nav class="breadcrumbs">
                <a href="#">Home</a> / <a href="#">Speakers</a> / <a href="#">JBL Service Center</a>
            </nav>
            <div class="service-details">
                <div class="left">
                    <div class="image-gallery">
                        <img src="main-image.jpg" alt="JBL Service Center">
                        <div class="thumbnails">
                            <i class="fa-solid fa-angle-up"></i>
                            <img src="thumbnail1.jpg" alt="Thumbnail 1" class="active">
                            <img src="thumbnail2.jpg" alt="Thumbnail 2">
                            <img src="thumbnail3.jpg" alt="Thumbnail 3">
                            <img src="thumbnail4.jpg" alt="Thumbnail 4">
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                    </div>
                    <div class="social-icons">
                        <p>Share</p>
                        <a href="#"><i class="fa-brands fa-youtube"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-square-facebook"></i></a>
                        <a href="#"><i class="fa-brands fa-github"></i></a>
                    </div>
                </div>

                <div class="details">
                    <p>789 Tech Street, Barangay Cristo Rey, Capas, Tarlac</p>
                    <h2>JBL SERVICE CENTER</h2>
                    <div class="header">
                        <div class="rating">
                            <div class="average">4.0</div>
                            <div class="stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </div>
                            <div class="reviews" style="color: #bebebe;">(223)</div>
                        </div>
                        |
                        <div class="repaired">
                            <i class="fa-solid fa-check"></i>
                            <p>320 Repaired</p>
                        </div>
                        |
                        <div class="views">
                            <i class="fa-solid fa-eye"></i>
                            <p>1.4k Viewed</p>
                        </div>
                    </div>
                    <div class="mastery">
                        <i class="fa-solid fa-desktop"></i>
                        <i class="fa-solid fa-desktop"></i>
                        <i class="fa-solid fa-desktop"></i>
                        <i class="fa-solid fa-desktop"></i>
                    </div>

                    <div class="details-info">
                        <p>Contact</p>
                        <ul class="contact">
                            <li>+63 987 654 3210</li>
                            <li>jblservicecenter.audiofix@gmail.com</li>
                        </ul>

                        <p>Services</p>
                        <ul>
                            <li>Speaker Repair (Speaker cone replacement, Amplifier repair)</li>
                            <li>Subwoofer Repair (Voice coil replacement, Port cleaning)</li>
                            <li>Speaker Enclosure Repair (Cabinet refinishing, Grill replacement)</li>
                        </ul>
                        
                        <p>Opening Hours</p>
                        <ul>
                            <li>Monday to Friday: 9:00 AM - 6:00 PM</li>
                            <li>Saturday: 10:00 AM - 4:00 PM</li>
                            <li>Closed on Sundays</li>
                        </ul>
                    </div>

                    <div class="buttons">
                        <button class="favorite"><i class="fa-regular fa-heart"></i></button>
                        <button class="chat">CHAT</button>
                        <button class="appointment highlight" onclick="btnClick()">MAKE AN APPOINTMENT</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-description">
            <div class="review-summary">
                
                <div class="rating">
                    <div class="rating-score">4.0<p>/5</p></div>
                    <div class="rating-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <div class="rating-reviews">223 Reviews</div>
                </div>

                <div class="rating-breakdown">
            
                    <div class="rating-bar">
                        <div class="upper">
                            <div class="star-scale">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="rating-count">186</div>
                        </div>

                        <div class="bar">
                            <div class="filled" style="width: 83%;"></div>
                        </div>
                    </div>

                    <div class="rating-bar">
                        <div class="upper">
                            <div class="star-scale">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="rating-count">18</div>
                        </div>

                        <div class="bar">
                            <div class="filled" style="width: 70%;"></div>
                        </div>
                    </div>

                    <div class="rating-bar">
                        <div class="upper">
                            <div class="star-scale">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="rating-count">12</div>
                        </div>

                        <div class="bar">
                            <div class="filled" style="width: 20%;"></div>
                        </div>
                    </div>

                    <div class="rating-bar">
                        <div class="upper">
                            <div class="star-scale">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="rating-count">12</div>
                        </div>

                        <div class="bar">
                            <div class="filled" style="width: 20%;"></div>
                        </div>
                    </div>

                    <div class="rating-bar">
                        <div class="upper">
                            <div class="star-scale">
                                <i class="fas fa-star"></i>

                            </div>
                            <div class="rating-count">12</div>
                        </div>

                        <div class="bar">
                            <div class="filled" style="width: 20%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="description">
                <div class="tabs">
                    <div class="tab active">Description</div>
                    <div class="tab">Specialization</div>
                    <div class="tab">Certificates</div>
                    <div class="tab">Reviews (223)</div>
                </div>
                <div class="content">
                    <h2>See the best picture no matter where you sit</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam ipsum ea accusantium consequatur! Numquam cum odio, rerum in nihil consequatur, tenetur voluptas nulla dignissimos minima, esse a vel temporibus? Asperiores.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur nesciunt recusandae eum odio itaque, et ea consectetur eos tempora sapiente non, voluptates sit unde? Quae quia accusantium suscipit ipsa accusamus maxime, neque nam illo est eveniet sint. Similique nemo voluptatem nostrum rerum? Tempore temporibus nesciunt suscipit qui repellendus quaerat inventore.</p>
                    <!-- <img src="main-image.jpg" alt="Image"> -->
                </div>                
            </div>
        </div>

        @yield('footer')

        <script>
            // function btnClick(){
            //     window.location.href = ("5 - BookAppointment.html");
            // }
        </script>
    </body>
</html>
