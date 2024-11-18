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
        
        <link rel="stylesheet" href="{{ asset('css/Customer/3 - ViewShop.css') }}">
    </head>
    <body>

        @if(session()->has('error'))
            <div class="push-notification danger">
                <i class="fa-solid fa-bell danger"></i>
                <div class="notification-message">
                    <h4>{{session('error')}}</h4>
                    <p>{{session('error_message')}}</p>
                </div>
                <i class="fa-solid fa-xmark" id="close-notification"></i>
            </div>
        @elseif(session()->has('success'))
            <div class="push-notification success">
                <i class="fa-solid fa-bell success"></i>
                <div class="notification-message">
                    <h4>{{session('success')}}</h4>
                    <p>{{session('success_message')}}</p>
                </div>
                <i class="fa-solid fa-xmark" id="close-notification"></i>
            </div>
        @endif

        <div class="modal" id="modal">
        </div>

        <div class="loading-screen">
            <div class="loader"></div>
        </div>

        @yield('header')
        
        <div class="container-shop">
            <nav class="breadcrumbs">
                <a href="/">Home</a> / <a href="#">{{$repairshop->repairshopMastery->main_mastery}}</a> / <a href="#">{{$repairshop->repairshopCredentials->shop_name}}</a>
            </nav>
            <div class="service-details">
                <div class="left">
                    <div class="image-gallery">
                        <span class="preview-image" data-image-url="{{ asset($repairshopImages->image_profile) }}" style="background-image: url('{{ asset($repairshopImages->image_profile) }}');"></span>
                        <div class="thumbnails">
                            <span class="preview-image" data-image-url="{{ asset($repairshopImages->image_2) }}" style="background-image: url('{{ asset($repairshopImages->image_2) }}');"></span>
                            <span class="preview-image" data-image-url="{{ asset($repairshopImages->image_3) }}" style="background-image: url('{{ asset($repairshopImages->image_3) }}');"></span>
                            <span class="preview-image" data-image-url="{{ asset($repairshopImages->image_4) }}" style="background-image: url('{{ asset($repairshopImages->image_4) }}');"></span>
                            <span class="preview-image" data-image-url="{{ asset($repairshopImages->image_5) }}" style="background-image: url('{{ asset($repairshopImages->image_5) }}');"></span>
                        </div>
                    </div>
                    <div class="social-icons">
                        <p>Share</p>
                        @foreach(['youtube', 'linkedin', 'twitter', 'facebook', 'telegram'] as $social)
                            @if($repairshopSocials && $repairshopSocials->$social)
                                <a href="{{$repairshopSocials->$social}}"><i class="fa-brands fa-{{$social}}"></i></a>
                            @endif
                        @endforeach
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
                            <i class="fa-solid fa-screwdriver-wrench"></i>
                            <p>{{$shopCredentials->repairCount}} <span>Repaired</span></p>
                        </div>
                        |
                        <div class="views">
                            <i class="fa-solid fa-eye"></i>
                            <p>{{$shopCredentials->shopviews}} <span>Viewed</span></p>
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
                        @if(Auth::check())
                            @php 
                                $favorite = App\Models\Customer_Favorite::where('customer_id', Auth::user()->id)
                                    ->where('technician_id', $repairshop->id)
                                    ->first();
                            @endphp
                            <button class="favorite {{$favorite ? 'active' : ''}}" data-technician-id="{{$repairshop->id}}"><i class="fa-regular fa-heart"></i></button>
                        @else 
                            <button class="favorite" onclick="window.location.href='/customer/login'"><i class="fa-regular fa-heart"></i></button>
                        @endif
                        <button class="chat load" onclick="window.location.href='{{route('customer.messageRepairshop', ['repairshopID' => $repairshop->id])}}'">CHAT</button>
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
                                
                                <i class="fas fa-star"></i>
                            @elseif ($i == ceil($reviewData['averageRating']) && fmod($reviewData['averageRating'], 1) != 0)
                                
                                <i class="fa-solid fa-star-half-stroke"></i>
                            @else
                               
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
                    <div class="tab active" data-tab="about">About</div>
                    <div class="tab" data-tab="reviews">Reviews ({{$reviewData['totalReviews']}})</div>
                </div>

                <div id="about" class="tab-content active">
                    <h2>{{$repairshop->repairshopProfile->header}}</h2>   
                    <p>{{$repairshop->repairshopProfile->description}}</p>
                </div>

                <div id="reviews" class="tab-content">
                    <h2>Reviews</h2>      
                    @foreach($repairshop->repairshopReviews as $review)  
                        <div class="review" style="{{!$loop->last ? 'border-bottom:2px solid #d9d9d9;' : ''}}">
                            <div class="review-header">
                                <span class="review-date">{{$review->created_at->format('M d, Y')}}</span>
                                <div class="stars">
                                    @for ($i = 1; $i <= $review->rating; $i++ )
                                        <span class="star"><i class="fa-solid fa-star"></i></span>
                                    @endfor
                                </div>
                            </div>
            
                            <div class="review-body">
                                <div class="reviewer-info">
                                    @php
                                        $customer = App\Models\Customer::find($review->customer_id);
                                    @endphp
                                    @if($customer->image_profile)
                                        <span class="reviewer-avatar" style="background-image: url('{{ asset($customer->image_profile) }}');">
                                            
                                        </span>
                                    @else
                                        <span class="reviewer-avatar">
                                            <i class="fa-solid fa-user"></i>
                                        </span>
                                    @endif
                                    <div class="reviewer-details">
                                        <span class="reviewer-name">{{$review->customer_fullname}}</span>
                                    </div>
                                </div>
                                <p class="review-text">
                                    {{$review->review_comment}}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

        @yield('footer')

        <script>
            document.addEventListener('DOMContentLoaded', function(){
                // Function to open modal with the image view
                function viewImage(imageUrl) {
                    const modal = document.getElementById('modal');

                    // Set the modal content to display the image with a close button
                    modal.innerHTML = `
                        <div class="image-preview-container" style="background-image: url('${imageUrl}');">
                            <i class="fa-solid fa-xmark close icon-close"></i>
                        </div>
                    `;

                    // Show the modal
                    modal.classList.add("active");

                    // Close modal when 'X' is clicked
                    document.querySelectorAll('.close').forEach(button => {
                        button.onclick = function () {
                            modal.classList.remove("active");
                        };
                    });
                }

                // Attach event listeners to the "eye" icons
                document.querySelectorAll('.preview-image').forEach(icon => {
                    icon.addEventListener('click', function() {
                        const imageUrl = this.getAttribute('data-image-url');
                        if(imageUrl != "http://127.0.0.1:8000/"){
                            viewImage(imageUrl);
                        }
                    });
                });
            });
        </script>
        <script src="{{asset('js/Customer/3 - ViewShop.js')}}" defer></script>
        <script src="{{asset('js/Customer/customer-notification.js')}}" defer></script>
        <script src="{{asset('js/Customer/customer-loadingscreen.js')}}" defer></script>
        <script src="{{asset('js/Customer/customer-favorites.js')}}" defer></script>
        <script src="{{asset('js/Customer/header-footer.js')}}" defer></script>
    </body>
</html>
