@include('components.header-footer')
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TechXpertz</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('css/Customer/header-footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-loadingscreen.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/3 - ViewShop.css') }}">
    </head>
    <body>

        <div class="loading-screen">
            <div class="loader"></div>
        </div>

        @yield('header')
        
        <div class="container-shop">
            <nav class="breadcrumbs">
                <a href="#">Home</a> / <a href="#">{{$repairshop->repairshopMastery->main_mastery}}</a> / <a href="#">{{$repairshop->repairshopCredentials->shop_name}}</a>
            </nav>
            <div class="service-details">
                <div class="left">
                    <div class="image-gallery">
                        <span style="background-image: url('{{ asset($repairshopImages->image_profile) }}');"></span>
                        <div class="thumbnails">
                            <i class="fa-solid fa-angle-up"></i>
                            <span style="background-image: url('{{ asset($repairshopImages->image_2) }}');"></span>
                            <span style="background-image: url('{{ asset($repairshopImages->image_3) }}');"></span>
                            <span style="background-image: url('{{ asset($repairshopImages->image_4) }}');"></span>
                            <span style="background-image: url('{{ asset($repairshopImages->image_5) }}');"></span>
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
                    <p>{{$repairshop->repairshopCredentials->shop_address}}, Barangay {{$repairshop->repairshopCredentials->shop_barangay}}, {{$repairshop->repairshopCredentials->shop_city}}, {{$repairshop->repairshopCredentials->shop_city}}</p>
                    <h2>{{$repairshop->repairshopCredentials->shop_name}}</h2>
                    <div class="header">
                        <div class="rating">
                            <div class="average">{{ number_format($reviewData['averageRating'], 1) }}</div>
                            <div class="stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= floor($reviewData['averageRating']))
                                        <!-- Solid star for whole numbers -->
                                        <i class="fas fa-star"></i>
                                    @elseif ($i == ceil($reviewData['averageRating']) && fmod($reviewData['averageRating'], 1) != 0)
                                        <!-- Half star for decimals -->
                                        <i class="fa-solid fa-star-half-stroke"></i>
                                    @else
                                        <!-- Empty star -->
                                        <i class="fa-regular fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <div class="reviews" style="color: #bebebe;">({{$reviewData['totalReviews']}})</div>
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
                        @foreach(['Smartphone', 'Tablet', 'Desktop', 'Laptop', 'Smartwatch', 'Camera', 'Printer', 'Speaker', 'Drone', 'All-In-One'] as $item)
                            @if($repairshopMastery->$item)
                                <img src="{{asset('images/' . $item . '.png' )}}" alt="">
                            @endif
                        @endforeach
                    </div>

                    <div class="details-info">
                        <p>Contact</p>
                        <ul class="contact">
                            <li>+63 {{$repairshop->repairshopCredentials->shop_contact}}</li>
                            <li>{{$repairshop->repairshopCredentials->shop_email}}</li>
                        </ul>

                        <p>Services</p>
                        <ul>
                            @foreach($services as $service)
                                <li>{{$service->service}}</li>
                            @endforeach
                        </ul>
                        
                        <p>Opening Hours</p>
                        <ul>
                            <li>{!! $detailedSchedule !!}</li>
                        </ul>
                    </div>

                    <div class="buttons">
                        <button class="favorite"><i class="fa-regular fa-heart"></i></button>
                        <button class="chat" onclick="window.location.href='{{route('customer.messageRepairshop', ['repairshopID' => $repairshop->id])}}'">CHAT</button>
                        <button class="appointment highlight load" id="button" onclick="window.location.href='{{route('viewappointment', ['id' => $repairshop->id])}}'">MAKE AN APPOINTMENT</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-description">

            <div class="review-summary">
                
                <div class="rating">
                    <div class="rating-score">{{ number_format($reviewData['averageRating'], 1) }}<p>/5</p></div>
                    <div class="rating-stars">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= floor($reviewData['averageRating']))
                                <!-- Solid star for whole numbers -->
                                <i class="fas fa-star"></i>
                            @elseif ($i == ceil($reviewData['averageRating']) && fmod($reviewData['averageRating'], 1) != 0)
                                <!-- Half star for decimals -->
                                <i class="fa-solid fa-star-half-stroke"></i>
                            @else
                                <!-- Empty star -->
                                <i class="fa-regular fa-star"></i>
                            @endif
                        @endfor
                    </div>
                    <div class="rating-reviews">{{ $reviewData['totalReviews'] }} Reviews</div>
                </div>

                <div class="rating-breakdown">
                    @for ($i = 5; $i >= 1; $i--)
                        <div class="rating-bar">
                            <div class="upper">
                                <div class="star-scale">
                                    @for ($j = 1; $j <= $i; $j++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                </div>
                                <div class="rating-count">{{ $reviewData['ratingCounts'][$i] }}</div>
                            </div>

                            <div class="bar">
                                <div class="filled" style="width: {{ $reviewData['ratingPercentages'][$i] }}%;"></div>
                            </div>
                        </div>
                    @endfor


                </div>
            </div>

            <div class="description">
                <div class="tabs">
                    <div class="tab active">About</div>
                    <div class="tab">Specialization</div>
                    <div class="tab">Certificates</div>
                    <div class="tab">Reviews ({{$reviewData['totalReviews']}})</div>
                </div>

                <div class="content">
                    <h2>{{$repairshop->repairshopProfile->header}}</h2>   
                    <p>{{$repairshop->repairshopProfile->description}}</p>
                </div>                
            </div>
        </div>

        @yield('footer')

        <script src="{{asset('js/Customer/customer-loadingscreen.js')}}"></script>
    </body>
</html>
