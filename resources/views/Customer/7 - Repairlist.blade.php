@include('components.header-footer')
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TechXpertz</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-headerfooter.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-loadingscreen.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-modal.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-notification.css') }}">
        
        <link rel="stylesheet" href="{{ asset('css/Customer/7 - Repairlist.css') }}">
    </head>

    <div class="loading-screen">
        <div class="loader"></div>
    </div>

    <body>

        @yield('header')
        
        <div class="upper">
            <div class="header">
                <h1>Track Your Repair Status</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
            </div>
            <form class="search-box">
                <div class="search-input">
                    <input type="number" id="repairId" name="repairId" placeholder="Please enter your repair ID here" required>
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <button type="submit" id="repairBtn">Track Repair Status</button>
            </form>
        </div>

        <div class="repair-list-container">
            @php
                $itemsPerPage = 4; // Define items per page
            @endphp

            @foreach($repairDetails as $index => $repair)
                @php
                    // Calculate the page number based on the index and items per page
                    $pageNumber = floor($index / $itemsPerPage) + 1;
                @endphp
                <div class="repair-card" data-page="{{ $pageNumber }}">
                    <div class="img"></div>
                    @php
                        $deviceInfo = App\Models\RepairShop_Appointments::find($repair->appointment_id);
                    @endphp

                    <div class="repair-info">
                        <div class="left-details">
                            <div class="device-details">
                                <p class="repair-id">#{{$repair->id}}</p>
                                <h2 class="repair-name">{{$deviceInfo->device_model}}</h2>
                                <p class="repair-status">{{$repair->repairstatus}}</p>                        
                            </div>

                            <div class="repairshop-details">
                                <p>Repair Shop:</p>
                                <h3>{{$repair->technician->repairshopCredentials->shop_name}}</h3> <!-- Access repair shop name -->
                                <ul class="repair-features" style="list-style-type: none;">
                                    <li><i class="fa-solid fa-check"></i>{{$repair->technician->repairshopBadges->badge_1}}</li>
                                    <li><i class="fa-solid fa-check"></i>{{$repair->technician->repairshopBadges->badge_2}}</li>
                                    <li><i class="fa-solid fa-check"></i>{{$repair->technician->repairshopBadges->badge_3}}</li>
                                    <li><i class="fa-solid fa-check"></i>{{$repair->technician->repairshopBadges->badge_4}}</li>
                                </ul>                        
                            </div>
                        </div>

                        <div class="right-details">
                            <div class="repair-payment-status">
                                <p>Paid Status:</p>
                                <h4>{{$repair->paid_status}}</h4>
                            </div>

                            <div class="repair-payment-cost">
                                <p>Repair Cost:</p>
                                <h1 class="repair-cost">P {{$repair->revenue}}</h1>
                            </div>
                            
                            <div class="repair-buttons">
                                <button class="repair-view-details load" onclick="window.location.href='{{ route('viewrepairstatus', ['id' => $repair->id]) }}'">View Details</button>
                                <button class="repair-chat load">
                                    <i class="fa-solid fa-message" onclick="window.location.href='{{route('customer.messageRepairshop', ['repairshopID' => $repair->technician->id])}}'"></i>
                                </button>
                            </div>                    
                        </div>
                    </div>
                    
                </div>
            @endforeach

            <div class="pagination">
                
            </div>
        </div>

        @yield('footer')
        
        <script>
            const paginationContainer = document.querySelector(".pagination");
            const repairItems = document.querySelectorAll(".repair-card");

            let currentPage = 1;
            const maxVisiblePages = 5; 

            // Calculate total number of pages based on items
            const totalPages = Math.max(...Array.from(repairItems, item => parseInt(item.getAttribute("data-page"))));

            // Function to display items for the selected page
            function displayPage(page) {
                repairItems.forEach(item => {
                    item.style.display = parseInt(item.getAttribute("data-page")) === page ? "flex" : "none";
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
        <script src="{{asset('js/Customer/customer-loadingscreen.js')}}" defer></script>
        <script src="{{asset('js/Customer/header-footer.js')}}" defer></script>
    </body>
    
</html>
