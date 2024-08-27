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
                <h1>{{$category}} Category</h1>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Provident, soluta!</p>
            </div>

            <div class="header">
                <nav>
                    <a href="#" class="active">{{$category}} Repair Shops</a>
                    <p>Showing 9 out o 120 results</p>
                </nav>
    
                <div class="header-actions">
                    <a><i class="fa-solid fa-arrow-down-wide-short"></i></a>
                    <a><i class="fa-solid fa-arrow-down-short-wide"></i></a>
                    <a class="filter">Popularity<i class="fa-solid fa-caret-down"></i></a>
                </div>
            </div>

            <div class="shops">
                @if(count($repairshops) === 0)
                    <p>No Shops Available</p>
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

            <!-- <div class="shops">
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
            </div> -->

            <div class="pagination">
                <a href="#" class="active">1</a>
                <a href="#">2</a>
                <a href="#">3</i></a>
                <a href="#">...</a>
            </div>
        </div>

        @yield('footer')

    </body>
</html>
