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
            </div>

            <div class="categories-2">
                <div class="category" onclick="window.location.href='{{ route('viewcategory', ['category'=>'Smartphone']) }}'">
                    <div class="icon">
                        <i class="fa fa-desktop"></i>
                    </div>
                    <div class="text">
                        <h3>Smartphone</h3>
                        <p>Repair Shops</p>
                    </div>
                </div>
                <div class="category" onclick="window.location.href='{{ route('viewcategory', ['category'=>'Tablet']) }}'">
                    <div class="icon">
                        <i class="fa fa-desktop"></i>
                    </div>
                    <div class="text">
                        <h3>Tablet</h3>
                        <p>Repair Shops</p>
                    </div>
                </div>
                <div class="category" onclick="window.location.href='{{ route('viewcategory', ['category'=>'Desktop']) }}'">
                    <div class="icon">
                        <i class="fa fa-desktop"></i>
                    </div>
                    <div class="text">
                        <h3>Desktop</h3>
                        <p>Repair Shops</p>
                    </div>
                </div>
                <div class="category" onclick="window.location.href='{{ route('viewcategory', ['category'=>'Laptop']) }}'">
                    <div class="icon">
                        <i class="fa fa-desktop"></i>
                    </div>
                    <div class="text">
                        <h3>Laptop</h3>
                        <p>Repair Shops</p>
                    </div>
                </div>
                <div class="category" onclick="window.location.href='{{ route('viewcategory', ['category'=>'Smartwatch']) }}'">
                    <div class="icon">
                        <i class="fa fa-desktop"></i>
                    </div>
                    <div class="text">
                        <h3>Smartwatche</h3>
                        <p>Repair Shops</p>
                    </div>
                </div>
                <div class="category" onclick="window.location.href='{{ route('viewcategory', ['category'=>'Camera']) }}'">
                    <div class="icon">
                        <i class="fa fa-desktop"></i>
                    </div>
                    <div class="text">
                        <h3>Camera</h3>
                        <p>Repair Shops</p>
                    </div>
                </div>
                <div class="category">
                    <div class="icon" onclick="window.location.href='{{ route('viewcategory', ['category'=>'Printer']) }}'">
                        <i class="fa fa-desktop"></i>
                    </div>
                    <div class="text">
                        <h3>Printer</h3>
                        <p>Repair Shops</p>
                    </div>
                </div>
                <div class="category" onclick="window.location.href='{{ route('viewcategory', ['category'=>'Speaker']) }}'">
                    <div class="icon">
                        <i class="fa fa-desktop"></i>
                    </div>
                    <div class="text">
                        <h3>Speaker</h3>
                        <p>Repair Shops</p>
                    </div>
                </div>
                <div class="category" onclick="window.location.href='{{ route('viewcategory', ['category'=>'Drone']) }}'">
                    <div class="icon">
                        <i class="fa fa-desktop"></i>
                    </div>
                    <div class="text">
                        <h3>Drone</h3>
                        <p>Repair Shops</p>
                    </div>
                </div>
                <div class="category" onclick="window.location.href='{{ route('viewcategory', ['category'=>'All-In-One']) }}'">
                    <div class="icon">
                        <i class="fa fa-desktop"></i>
                    </div>
                    <div class="text">
                        <h3>All-in-one</h3>
                        <p>Repair Shops</p>
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
                @if(count($repairshops) === 0)
                    <p class="no-shop">No Shops Available</p>
                @else
                    @foreach($repairshops as $repairshop)
                        <div class="shop">
                            <div class="shop-image" style="background-image: url('batz-logo.png');"></div>

                            <div class="shop-details">
                                <div class="shop-name">
                                    <h3>{{$repairshop['repairshopName']}}</h3>
                                    <i class="fa fa-desktop"></i>
                                </div>
                                
                                <div class="shop-location">
                                    <p>{{$repairshop['repairshopAddress']}}, Barangay {{$repairshop['repairshopBarangay']}}, {{$repairshop['repairshopCity']}} {{$repairshop['repairshopProvince']}}</p>
                                </div>
                                
                                <div class="shop-schedule">
                                    <p>+63 {{$repairshop['repairshopContact']}}</p>
                                    <h4>{{ $repairshop['formattedDays'] }}</h4>              
                                </div>
            
                                <ul>
                                    <li><i class="fa-solid fa-check"></i>{{ $repairshop['repairshopBadge1'] }}</li>
                                    <li><i class="fa-solid fa-check"></i>{{ $repairshop['repairshopBadge2'] }}</li>
                                    <li><i class="fa-solid fa-check"></i>{{ $repairshop['repairshopBadge3'] }}</li>
                                    <li><i class="fa-solid fa-check"></i>{{ $repairshop['repairshopBadge4'] }}</li>
                                </ul>
                            </div>
                            
                            <div class="shop-footer">
                                <div class="rating">
                                    <div class="stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= floor($repairshop['averageRating']))
                                                <!-- Solid star for whole numbers -->
                                                <i class="fas fa-star"></i>
                                            @elseif ($i == ceil($repairshop['averageRating']) && fmod($repairshop['averageRating'], 1) != 0)
                                                <!-- Half star for decimals -->
                                                <i class="fa-solid fa-star-half-stroke"></i>
                                            @else
                                                <!-- Empty star -->
                                                <i class="fa-regular fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <p>{{ $repairshop['totalReviews']}} Reviews</p>
                                </div>
                                <div class="actions">
                                    <button class="favorite"><i class="fa-regular fa-heart"></i></button>
                                    <button class="view" onclick="window.location.href='{{ route('viewshop', ['id'=>$repairshop['repairshopID']]) }}'"><i class="fa-solid fa-arrow-right-to-bracket"></i></button>
                                </div>
                            </div>
                        </div>                    
                    @endforeach                
                @endif
            </div>
        </div>

        @yield('footer')

    </body>
</html>
