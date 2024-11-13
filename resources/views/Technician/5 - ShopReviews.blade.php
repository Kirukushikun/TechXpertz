@include('components.technician-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechXpertz</title>
    <link rel="icon" href="{{ asset('images/TechXpertz-Icon.ico') }}">
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
                <div class="technician-name">
                    @php
                        $technician = Auth::guard('technician')->user();
                    @endphp
                    <h3>Hi, <span>{{$technician->firstname}}.</span></h3>
                </div>
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

            @if(count($reviewMessages) === 0)
                <div class="empty-message">
                    <i class="fa-solid fa-user-xmark"></i>
                    <p>No reviews at the moment.</p>                            
                </div>
            @else

                @php
                    $itemsPerPage = 10; // Define items per page
                @endphp
                <div class="individual-reviews">
                    @foreach($reviewMessages as $index => $reviewMessage)
                        @php
                            // Calculate the page number based on the index and items per page
                            $pageNumber = floor($index / $itemsPerPage) + 1;
                        @endphp
                        <div class="review" data-page="{{ $pageNumber }}">
                            <div class="review-header">
                                <span class="review-date">{{$reviewMessage->formatted_date}}</span>
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
                                        <span class="reviewer-name">{{$reviewMessage->customer_fullname}}</span>
                                    </div>
                                </div>
                                <p class="review-text">
                                    {{$reviewMessage->review_comment}}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="pagination">
            </div>
    
        </main>

    </div>
    <script>
        const paginationContainer = document.querySelector(".pagination");
        const reviewItems = document.querySelectorAll(".review");

        let currentPage = 1;
        const maxVisiblePages = 5; 

        // Calculate total number of pages based on items
        const totalPages = Math.max(...Array.from(reviewItems, item => parseInt(item.getAttribute("data-page"))));

        // Function to display items for the selected page
        function displayPage(page) {
            reviewItems.forEach(item => {
                item.style.display = parseInt(item.getAttribute("data-page")) === page ? "block" : "none";
            });
            updatePaginationLinks(page);
        }

        // Function to create pagination links with max 5 visible pages and handle "Previous" and "Next" sections
        function updatePaginationLinks(page) {
            paginationContainer.innerHTML = "";

            const startPage = Math.max(1, Math.min(page - Math.floor(maxVisiblePages / 2), totalPages - maxVisiblePages + 1));
            const endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

            // Previous button
            if (startPage > 1) {
                const prevLink = document.createElement("a");
                prevLink.href = "#";
                prevLink.innerHTML = '<i class="fa-solid fa-caret-left"></i>';
                prevLink.addEventListener("click", (event) => {
                    event.preventDefault();
                    currentPage = startPage - 1;
                    displayPage(currentPage);
                });
                paginationContainer.appendChild(prevLink);
            }

            // Page links
            for (let i = startPage; i <= endPage; i++) {
                const link = document.createElement("a");
                link.href = "#";
                link.textContent = i;
                link.classList.toggle("active", i === page);

                link.addEventListener("click", (event) => {
                    event.preventDefault();
                    currentPage = i;
                    displayPage(currentPage);
                });

                paginationContainer.appendChild(link);
            }

            // Next button
            if (endPage < totalPages) {
                const nextLink = document.createElement("a");
                nextLink.href = "#";
                nextLink.innerHTML = '<i class="fa-solid fa-caret-right"></i>';
                nextLink.addEventListener("click", (event) => {
                    event.preventDefault();
                    currentPage = endPage + 1;
                    displayPage(currentPage);
                });
                paginationContainer.appendChild(nextLink);
            }
        }

        // Initial load for the first page
        displayPage(currentPage);
    </script>
    <script src="{{asset('js/Technician/5 - ShopReviews.js')}}"></script>
    <script src="{{asset('js/Technician/technician-sidebar.js')}}"></script>
</body>
</html>
