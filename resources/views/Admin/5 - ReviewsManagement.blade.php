@include('components.admin-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <!-- Crucial Part on every forms -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Crucial Part on every forms/ -->
    <link rel="stylesheet" href="{{ asset('css/Admin/5 - ReviewsManagement.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Admin/admin-sidebar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="dashboard">

        @yield('sidebar')

        <main class="main-content">
            <div class="head">
                <div class="logo">
                    <h2>Tech<span>X</span>pertz</h2>
                </div>

                @yield('navbar')

            </div>
            <div class="body">
                <div class="header">
                    <h1>Reviews Management</h1>
                    
                    <div class="tab-filters">
                        <li><button><i class="fa-solid fa-filter"></i>Filter</button></li>
                        <li><i class="fa-solid fa-magnifying-glass" id="search"></i> <input id="search-input" type="text" placeholder="search"></li>

                        <a class="add-repair"><i class="fa-solid fa-plus" id="add-appointment"></i></a>
                    </div>
                </div>

                <div class="content">
                    <ul class="tabs">
                        <div class="tab-navigation">
                            <li class="tab-link active" data-tab="pending-reviews" data-container="pending-reviews-container">Pending</li>
                            <li class="tab-link" data-tab="approved-reviews" data-container="approved-reviews-container">Approved</li>
                            <li class="tab-link" data-tab="rejected-reviews" data-container="pending-reviews-container">Rejected</li>
                        </div>

                        <div class="tab-summary">
                            <p>Total Reviews: {{$reviewData->count()}}</p>
                            <p>Pending: {{$pendingReviews->count()}}</p>
                            <p>Approved: {{$approvedReviews->count()}}</p>
                            <p>Rejected: {{$rejectedReviews->count()}}</p>
                        </div>
                    </ul>

                    <div id="pending-reviews" class="tab-content-item active">
                        <div class="pagination"></div>
                        
                        @foreach($pendingReviews as $pending)
                            <div class="review-item active" id="{{$pending->id}}">
                                <div class="left">
                                    <div class="review-header">
                                        <div class="title">
                                            Customer: <a href="">{{$pending->customer->firstname}} {{$pending->customer->lastname}}</a>
                                        </div>
                                        <div class="sub-title">
                                            Repairshop: 
                                            <span><a href="">{{$pending->technician->repairshopCredentials->shop_name}}</a></span> |
                                            Technician:
                                            <span><a href="">{{$pending->technician->firstname}} {{$pending->technician->middlename ?? ''}} {{$pending->technician->lastname}}</a></span> |
                                            {{$pending->created_at->format('M d, Y, h:i A')}}
                                        </div> 
                                    </div>
                                    <div class="review-content">
                                        <div class="header">
                                            <div class="ratings">Rating: 
                                                <span>
                                                    @for ($i = 1; $i <= $pending->rating; $i++ )
                                                    <span class="star"><i class="fa-solid fa-star"></i></span>
                                                    @endfor

                                                    <!-- Display empty stars for the remaining -->
                                                    @for ($i = $pending->rating + 1; $i <= 5; $i++)
                                                        <span class="star"><i class="fa-regular fa-star"></i></span>
                                                    @endfor
                                                </span>
                                            </div>
                                                                            
                                        </div>
                                        "{{$pending->review_comment}}"
                                    </div>                            
                                </div>

                                <div class="right">
                                    <button class="reviewbtn check" data-review-status="Approved" data-review-id="{{$pending->id}}"><i class="fa-solid fa-check"></i></button>
                                    <button class="reviewbtn exclamation" data-review-status="Rejected" data-review-id="{{$pending->id}}"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                            </div>
                        @endforeach  
                        

                    </div>

                    <div id="approved-reviews" class="tab-content-item">
                        <div class="pagination"></div>
                        
                        @foreach($approvedReviews as $approved)
                            <div class="review-item active" id="{{$approved->id}}">
                                <div class="left">
                                    <div class="review-header">
                                        <div class="title">
                                            Customer: <a href="">{{$approved->customer->firstname}} {{$approved->customer->lastname}}</a>
                                        </div>
                                        <div class="sub-title">
                                            Repairshop: 
                                            <span><a href="">{{$approved->technician->repairshopCredentials->shop_name}}</a></span> |
                                            Technician:
                                            <span><a href="">{{$approved->technician->firstname}} {{$approved->technician->middlename ?? ''}} {{$approved->technician->lastname}}</a></span> |
                                            {{$approved->created_at->format('M d, Y, h:i A')}}
                                        </div> 
                                    </div>
                                    <div class="review-content">
                                        <div class="header">
                                            <div class="ratings">Rating: 
                                                <span>
                                                    @for ($i = 1; $i <= $approved->rating; $i++ )
                                                    <span class="star"><i class="fa-solid fa-star"></i></span>
                                                    @endfor

                                                    <!-- Display empty stars for the remaining -->
                                                    @for ($i = $approved->rating + 1; $i <= 5; $i++)
                                                        <span class="star"><i class="fa-regular fa-star"></i></span>
                                                    @endfor
                                                </span>
                                            </div>
                                                                            
                                        </div>
                                        "{{$approved->review_comment}}"
                                    </div>                            
                                </div>

                                <div class="right">
                                    <button class="reviewbtn check" data-review-status="Approved" data-review-id="{{$approved->id}}"><i class="fa-solid fa-check"></i></button>
                                    <button class="reviewbtn exclamation" data-review-status="Rejected" data-review-id="{{$approved->id}}"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                            </div>
                        @endforeach 


                    </div>

                    <div id="rejected-reviews" class="tab-content-item">
                        <div class="pagination"></div>
                        
                        @foreach($rejectedReviews as $rejected)
                            <div class="review-item active" id="{{$rejected->id}}">
                                <div class="left">
                                    <div class="review-header">
                                        <div class="title">
                                            Customer: <a href="">{{$rejected->customer->firstname}} {{$rejected->customer->lastname}}</a>
                                        </div>
                                        <div class="sub-title">
                                            Repairshop: 
                                            <span><a href="">{{$rejected->technician->repairshopCredentials->shop_name}}</a></span> |
                                            Technician:
                                            <span><a href="">{{$rejected->technician->firstname}} {{$rejected->technician->middlename ?? ''}} {{$rejected->technician->lastname}}</a></span> |
                                            {{$rejected->created_at->format('M d, Y, h:i A')}}
                                        </div> 
                                    </div>
                                    <div class="review-content">
                                        <div class="header">
                                            <div class="ratings">Rating: 
                                                <span>
                                                    @for ($i = 1; $i <= $rejected->rating; $i++ )
                                                    <span class="star"><i class="fa-solid fa-star"></i></span>
                                                    @endfor

                                                    <!-- Display empty stars for the remaining -->
                                                    @for ($i = $rejected->rating + 1; $i <= 5; $i++)
                                                        <span class="star"><i class="fa-regular fa-star"></i></span>
                                                    @endfor
                                                </span>
                                            </div>
                                                                            
                                        </div>
                                        "{{$rejected->review_comment}}"
                                    </div>                            
                                </div>

                                <div class="right">
                                    <button class="reviewbtn check" data-review-status="Approved" data-review-id="{{$rejected->id}}"><i class="fa-solid fa-check"></i></button>
                                    <button class="reviewbtn exclamation" data-review-status="Rejected" data-review-id="{{$rejected->id}}"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                            </div>
                        @endforeach 


                    </div>

                    <!-- <div class="review-item">
                        <div class="left">
                            <div class="review-header">
                                <div class="title">
                                    Customer: <a href="">Iverson Craig Guno</a>
                                </div>
                                <div class="sub-title">
                                    Repairshop: 
                                    <span><a href="">TechXpertz</a></span> |
                                    Technician:
                                    <span><a href="">Iverson Guno</a></span> |
                                    Wed, 04 Oct 2024, 09:30 AM
                                </div> 
                            </div>
                            <div class="review-content">
                                <div class="header">
                                    <div class="ratings">Rating: 
                                        <span>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </span>
                                    </div>
                                                                    
                                </div>
                                "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam eaque non dicta fugiat sapiente perferendis aliquam expedita excepturi delectus unde. Quod tenetur sapiente recusandae nostrum non quibusdam provident rerum praesentium."
                            </div>                            
                        </div>

                        <div class="right">
                            <button class="check"><i class="fa-solid fa-check"></i></button>
                            <button class="exclamation"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                    </div> -->
                </div>
            </div>
        </main>
    </div>

    <script src="{{ asset('js/Admin/admin-navbars.js') }}"></script>
    <script>
        let reviewButtons = document.querySelectorAll('button.reviewbtn');
        reviewButtons.forEach(button => {
            button.addEventListener('click', function(){
                let reviewID = button.getAttribute('data-review-id');
                let reviewStatus = button.getAttribute('data-review-status');
                updatereview(reviewID, reviewStatus);
            });
        });

        function updatereview(reviewID, reviewStatus){

            fetch(`/admin/reviewsmanagement/${reviewID}`, {
                method: 'PATCH', // You can use 'PUT' or 'PATCH' depending on your API design
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ status: reviewStatus }) // Send necessary data in the body
            })
            .then(response => {
                if (response.ok) {
                    console.log('Review updated successfully');
                } else {
                    console.log('Review update failed');
                }
            })
            .catch(error => {
                console.log('There was an error with the request:', error);
            });

            let reviewItem = document.getElementById(reviewID);
            reviewItem.classList.remove('active');                
        }
    </script>

    <script>
        // Configuration Variables
        const tabs = document.querySelectorAll(".tab-link"); // Tab buttons
        const tabContentItems = document.querySelectorAll(".tab-content-item"); // Content areas for each tab
        const searchInput = document.getElementById("search-input"); // Search input box
        const itemsPerPage = 5; // Items per page

        let currentPage = 1; // Initial page number
        let activeTab = "pending-reviews"; // Default active tab

        // Function to display items for a specific tab and page
        function displayTabContent(tab, page = 1, search = "") {
            const container = document.getElementById(`${tab}`);
            if (!container) return; // Prevent errors if the container is missing

            const items = Array.from(container.getElementsByClassName("review-item"));
            const filteredItems = search
                ? items.filter(item => {
                    // Filter items based on search query and specific attributes
                    return ["data-review-title", "data-review-ratings", "data-date"].some(attr => {
                        const attrValue = item.getAttribute(attr);
                        return attrValue && attrValue.toLowerCase().includes(search.toLowerCase());
                    });
                })
                : items;

            const totalItems = filteredItems.length;
            const start = (page - 1) * itemsPerPage;
            const end = page * itemsPerPage;

            // Hide all items and show only filtered items for the current page
            items.forEach(item => (item.style.display = "none"));
            filteredItems.slice(start, end).forEach(item => (item.style.display = ""));

            // Update pagination controls
            renderPagination(tab, page, Math.ceil(totalItems / itemsPerPage));
        }

        // Function to switch active tab
        function switchTab(tab) {
            activeTab = tab; // Set active tab
            currentPage = 1; // Reset page to the first

            // Toggle active class for tabs and tab content
            tabs.forEach(t => t.classList.toggle("active", t.dataset.tab === tab));
            tabContentItems.forEach(content => content.classList.toggle("active", content.id === tab));

            // Display content for the current tab
            displayTabContent(tab, currentPage, searchInput.value.trim());
        }

        // Function to render pagination
        function renderPagination(tab, currentPage, totalPages) {
            const paginationContainer = document.querySelector(`#${tab} .pagination`);
            if (!paginationContainer) return;

            paginationContainer.innerHTML = "";

            const maxPagesToShow = 5;
            let startPage = Math.max(1, currentPage - Math.floor(maxPagesToShow / 2));
            let endPage = startPage + maxPagesToShow - 1;

            if (endPage > totalPages) {
                endPage = totalPages;
                startPage = Math.max(1, endPage - maxPagesToShow + 1);
            }

            // Create "Previous" button
            if (currentPage > 1) {
                const prevButton = document.createElement("button");
                prevButton.innerHTML = '<i class="fa-solid fa-caret-left"></i>';
                prevButton.addEventListener("click", () => {
                    currentPage -= 1;
                    displayTabContent(tab, currentPage, searchInput.value.trim());
                });
                paginationContainer.appendChild(prevButton);
            }

            // Create page number buttons
            for (let i = startPage; i <= endPage; i++) {
                const pageButton = document.createElement("button");
                pageButton.textContent = i;
                pageButton.classList.toggle("active", i === currentPage);
                pageButton.addEventListener("click", () => {
                    currentPage = i;
                    displayTabContent(tab, currentPage, searchInput.value.trim());
                });
                paginationContainer.appendChild(pageButton);
            }

            // Create "Next" button
            if (currentPage < totalPages) {
                const nextButton = document.createElement("button");
                nextButton.innerHTML = '<i class="fa-solid fa-caret-right"></i>';
                nextButton.addEventListener("click", () => {
                    currentPage += 1;
                    displayTabContent(tab, currentPage, searchInput.value.trim());
                });
                paginationContainer.appendChild(nextButton);
            }
        }

        // Tab click event listener
        tabs.forEach(tab => {
            tab.addEventListener("click", () => switchTab(tab.dataset.tab));
        });

        // Search input event listener
        searchInput.addEventListener("input", () => {
            currentPage = 1; // Reset to first page on search
            displayTabContent(activeTab, currentPage, searchInput.value.trim());
        });

        // Initialize display for the default tab
        switchTab(activeTab);

    </script>
</body>
</html>
