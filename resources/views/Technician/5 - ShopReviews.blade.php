@include('components.technician-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Reviews</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/Technician/technician-sidebar.css')}}">

    <link rel="stylesheet" href="{{asset('css/Technician/5 - ShopReviews.css')}}">
</head>
<body>
    <div class="dashboard">

        @yield('sidebar')

        
        <main class="main-content">
            <header>
                <h1>Shop Reviews</h1>
            </header>

            <div class="reviews-summary">
                <h3>Review Summary</h3>
                <div class="review-details">
                    <div class="overall-rating">
                        <span class="rating-number">{{ number_format($reviewData['averageRating'], 1) }}</span>
                        
                        <div class="stars">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= floor($reviewData['averageRating']))
                                    <!-- Solid star for whole numbers -->
                                    <i class="star fas fa-star"></i>
                                @elseif ($i == ceil($reviewData['averageRating']) && fmod($reviewData['averageRating'], 1) != 0)
                                    <!-- Half star for decimals -->
                                    <i class="star fa-solid fa-star-half-stroke"></i>
                                @else
                                    <!-- Empty star -->
                                    <i class="star fa-regular fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="total-reviews">({{ $reviewData['totalReviews'] }} Reviews)</span>
                    </div>
    
                    <div class="rating-breakdown">
                        @for ($i = 5; $i >= 1; $i--)
                            <div class="rating-bar">
                                <span>{{ $i }} {{ $i == 1 ? 'star' : 'stars' }}</span>
                                <div class="bar">
                                    <div class="filled" style="width: {{ $reviewData['ratingPercentages'][$i] }}%;"></div>
                                </div>
                                <span>{{ $reviewData['ratingCounts'][$i] }}</span>
                            </div>
                        @endfor
                    </div>                
                </div>
            </div>

            <div class="individual-reviews">

                @foreach($reviewMessages as $reviewMessage)
                    <div class="review">
                        <div class="review-header">
                            <span class="review-date">{{$reviewMessage->created_at}}</span>
                            <div class="stars">
                                @for ($i = 1; $i <= $reviewMessage->rating; $i++ )
                                    <span class="star"><i class="fa-solid fa-star"></i></span>
                                @endfor
                            </div>
                        </div>
        
                        <div class="review-body">
                            <div class="reviewer-info">
                                <span class="reviewer-avatar">AK</span>
                                <div class="reviewer-details">
                                    <span class="reviewer-name">Customers Name</span>
                                </div>
                            </div>
                            <p class="review-text">
                                {{$reviewMessage->review_comment}}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>


            <!-- <div class="pagination">
                <a href="#" class="active">1</a>
                <a href="#">2</a>
                <a href="#">3</i></a>
                <a href="#">...</a>
            </div> -->

        </main>

    </div>
    
    <script src="{{asset('js/Technician/5 - ShopReviews.js')}}"></script>
    <script src="{{asset('js/Technician/technician-sidebar.js')}}"></script>
</body>
</html>
