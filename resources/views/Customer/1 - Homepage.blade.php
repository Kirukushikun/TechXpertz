@include('components.header-footer')
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TechXpertz</title>
        <link rel="icon" href="{{ asset('images/TechXpertz-Icon.ico') }}">
        <!-- Crucial Part on every forms -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Crucial Part on every forms/ -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-headerfooter.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-loadingscreen.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-modal.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-notification.css') }}">

        <link rel="stylesheet" href="{{ asset('css/Customer/1 - Homepage.css') }}">
    </head>
    <body>
        
        <div class="loading-screen">
            <div class="loader"></div>
        </div> 

        @yield('header')
        
        <div class="container-1" style="background-image:url({{asset('images/container1-background.png')}});">
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
                <div class="category load" onclick="window.location.href='{{ route('viewcategory', ['category'=>'Smartphone']) }}'">
                    <div class="icon">
                        <img src="{{asset('images/Smartphone.png')}}">
                    </div>
                    <div class="text">
                        <h3>Smartphone</h3>
                        <p>Repair Shops</p>
                    </div>
                </div>
                <div class="category load" onclick="window.location.href='{{ route('viewcategory', ['category'=>'Tablet']) }}'">
                    <div class="icon">
                        <img src="{{asset('images/Tablet.png')}}">
                    </div>
                    <div class="text">
                        <h3>Tablet</h3>
                        <p>Repair Shops</p>
                    </div>
                </div>
                <div class="category load" onclick="window.location.href='{{ route('viewcategory', ['category'=>'Desktop']) }}'">
                    <div class="icon">
                        <img src="{{asset('images/Desktop.png')}}">
                    </div>
                    <div class="text">
                        <h3>Desktop</h3>
                        <p>Repair Shops</p>
                    </div>
                </div>
                <div class="category load" onclick="window.location.href='{{ route('viewcategory', ['category'=>'Laptop']) }}'">
                    <div class="icon">
                        <img src="{{asset('images/Laptop.png')}}">
                    </div>
                    <div class="text">
                        <h3>Laptop</h3>
                        <p>Repair Shops</p>
                    </div>
                </div>
                <div class="category load" onclick="window.location.href='{{ route('viewcategory', ['category'=>'Smartwatch']) }}'">
                    <div class="icon">
                        <img src="{{asset('images/Smartwatch.png')}}">
                    </div>
                    <div class="text">
                        <h3>Smartwatch</h3>
                        <p>Repair Shops</p>
                    </div>
                </div>
                <div class="category load" onclick="window.location.href='{{ route('viewcategory', ['category'=>'Camera']) }}'">
                    <div class="icon">
                        <img src="{{asset('images/Camera.png')}}">
                    </div>
                    <div class="text">
                        <h3>Camera</h3>
                        <p>Repair Shops</p>
                    </div>
                </div>
                <div class="category load" onclick="window.location.href='{{ route('viewcategory', ['category'=>'Printer']) }}'">
                    <div class="icon">
                        <img src="{{asset('images/Printer.png')}}">
                    </div>
                    <div class="text">
                        <h3>Printer</h3>
                        <p>Repair Shops</p>
                    </div>
                </div>
                <div class="category load" onclick="window.location.href='{{ route('viewcategory', ['category'=>'Speaker']) }}'">
                    <div class="icon">
                        <img src="{{asset('images/Speaker.png')}}">
                    </div>
                    <div class="text">
                        <h3>Speaker</h3>
                        <p>Repair Shops</p>
                    </div>
                </div>
                <div class="category load" onclick="window.location.href='{{ route('viewcategory', ['category'=>'Drone']) }}'">
                    <div class="icon">
                        <img src="{{asset('images/Drone.png')}}">
                    </div>
                    <div class="text">
                        <h3>Drone</h3>
                        <p>Repair Shops</p>
                    </div>
                </div>
                <div class="category load" onclick="window.location.href='{{ route('viewcategory', ['category'=>'All-In-One']) }}'">
                    <div class="icon">
                        <img src="{{asset('images/All-In-One.png')}}">
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
                    <a href="#">Recommended</a>
                    <a href="#">Top-rated</a>
                </nav>
    
                <div class="header-actions">
                    <button><i class="fa-solid fa-arrow-left"></i></button>
                    <button><i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </div>

            <div class="shop-category active">
                @if(count($repairshops) === 0)
                    <p class="no-shop">
                        <i class="fa-solid fa-shop-slash"></i>
                        <span>No Shops Available</span>
                    </p>
                @endif

                <div class="best-shops shop-container">
                
                    @foreach($repairshops as $index => $repairshop)
                        <div class="shop">
                            <div class="shop-image" style="background-image: url('{{ asset($repairshop['repairshopImage']) }}');"></div>

                            <div class="shop-details">
                                <div class="shop-name">
                                    <h3>{{$repairshop['repairshopName']}}</h3>
                                    <img src="{{ asset('images/' . $repairshop['repairshopMastery'] . '.png') }}">
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
                                                
                                                <i class="fas fa-star"></i>
                                            @elseif ($i == ceil($repairshop['averageRating']) && fmod($repairshop['averageRating'], 1) != 0)
                                                
                                                <i class="fa-solid fa-star-half-stroke"></i>
                                            @else
                                                
                                                <i class="fa-regular fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <p>{{ $repairshop['totalReviews']}} Reviews</p>
                                </div>
                                <div class="actions">
                                    @if(Auth::check())
                                        @php 
                                            $favorite = App\Models\Customer_Favorite::where('customer_id', Auth::user()->id)
                                                ->where('technician_id', $repairshop['repairshopID'])
                                                ->first();
                                        @endphp
                                        <button class="favorite {{$favorite ? 'active' : ''}}" data-technician-id="{{$repairshop['repairshopID']}}"><i class="fa-regular fa-heart"></i></button>
                                    @else 
                                        <button class="favorite" onclick="window.location.href='/customer/login'"><i class="fa-regular fa-heart"></i></button>
                                    @endif
                                    <button class="view load" onclick="window.location.href='{{ route('viewshop', ['id'=>$repairshop['repairshopID']]) }}'"><i class="fa-solid fa-arrow-right-to-bracket"></i></button>
                                </div>
                            </div>
                        </div>                    
                    @endforeach
                    
                </div>

                @if(count($repairshops) > 4)
                    <div class="pagination"></div>
                @endif
            </div>


            <div class="shop-category">
                @if(count($repairshops) === 0)
                    <p class="no-shop">
                        <i class="fa-solid fa-shop-slash"></i>
                        <span>No Shops Available</span>
                    </p>
                @endif

                <div class="recommended shop-container">

                </div>  

                @if(count($repairshops) > 4)
                    <div class="pagination"></div>
                @endif           
            </div>


            <div class="shop-category">
                @if(count($repairshops) === 0)
                    <p class="no-shop">
                        <i class="fa-solid fa-shop-slash"></i>
                        <span>No Shops Available</span>
                    </p>
                @endif

                <div class="topRated shop-container">
                    
                </div>
                
                @if(count($repairshops) > 4)
                    <div class="pagination"></div>
                @endif                
            </div>
        </div>

        @yield('footer')

        <script src="{{asset('js/Customer/1 - Homepage.js')}}" defer></script>
        <script src="{{asset('js/Customer/customer-loadingscreen.js')}}" defer></script>
        <script src="{{asset('js/Customer/customer-favorites.js')}}" defer></script>
        <script src="{{asset('js/Customer/header-footer.js')}}" defer></script>
    </body>
</html>
