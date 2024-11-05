@include('components.technician-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Crucial Part on every forms -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Crucial Part on every forms/ -->
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/Technician/technician-sidebar.css')}}">

    <link rel="stylesheet" href="{{asset('css/Technician/3 - RepairStatus.css')}}">
    <link rel="stylesheet" href="{{asset('css/Technician/technician-modal.css')}}">
    <link rel="stylesheet" href="{{asset('css/Technician/technician-notification.css')}}">

</head>
<body>
    <div class="dashboard">

        <!-- PUSH NOTIFICATION -->
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

        <!-- MODAL POPUP -->
        <div class="modal" id="modal">

        </div>

        @yield('sidebar')

        <main class="main-content">
            <header>
                <h1>Repair Status Management</h1>
                <div class="technician-name">
                    @php
                        $technician = Auth::guard('technician')->user();
                    @endphp
                    <h3>Hi, <span>{{$technician->firstname}}.</span></h3>
                </div>
            </header>

            <div class="repair-navigation">
                <ul class="tabs">
                    <div class="tab-navigation">
                        <li class="tab-link active" data-tab="pending" data-table="pending-table">In Progress<img src="{{asset('images/desktop-cog.png')}}"></li>
                        <li class="tab-link" data-tab="completed" data-table="completed-table">Completed<img src="{{asset('images/desktop-check.png')}}"></li>
                        <li class="tab-link" data-tab="terminated" data-table="terminated-table">Terminated<img src="{{asset('images/desktop-x.png')}}"></li>
                    </div>
                    
                    <div class="tab-filters">
                        <li><button><i class="fa-solid fa-filter"></i> Filter</button></li>
                        <li><i class="fa-solid fa-magnifying-glass" id="search"></i> <input type="text" id="search-input" placeholder="search"></li>

                        <a class="add-repair"><i class="fa-solid fa-plus" id="add-appointment"></i></a>
                    </div>
                </ul>
            </div>

            <div class="tab-content">
                <div id="pending" id="pending-repair" class="tab-content-item card active">
                    @if(count($repairStatusPendingData) === 0)
                        <div class="empty-message">
                            <i class="fa-solid fa-screwdriver-wrench"></i>
                            <p>No pending repairs at the moment.</p>                            
                        </div>
                    @else    
                        <table id="pending-table">
                            <thead>
                                <tr>
                                    <th>Repair ID</th>
                                    <th>Customer Name</th>
                                    <th>Revenue</th>
                                    <th>Expenses</th>
                                    <th>Paid Status</th>
                                    <th>Repair Status</th>
                                    <th>Details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                                <tbody>
                                    <!-- Pending Repair Records will be populated here -->
                                    @foreach($repairStatusPendingData as $pending)
                                    <tr>
                                        <td>#{{$pending['repairID']}}</td>
                                        <td>{{$pending['customer_name']}}</td>
                                        <td>P {{$pending['revenue']}}</td>
                                        <td>
                                            P {{$pending['expenses']}} 
                                        </td>
                                        <td>{{$pending['paid_status']}}</td>
                                        <td>
                                            <input type="text" value="{{$pending['repairstatus']}}" disabled>                                 
                                        </td>
                                        <td>
                                            <button class="view-details btn-primary" data-appointment-id="{{$pending['appointment_id']}}">
                                                View
                                            </button>
                                        </td>
                                        <td>
                                            
                                            <a class="terminate-btn icon-danger" data-repair-id="{{$pending['repairID']}}" data-customer-id="{{$pending['customerID']}}"><i class="fa-solid fa-trash"></i></a>
                                            <a class="update-btn icon-success" data-repair-id="{{$pending['repairID']}}"><i class="fa-solid fa-screwdriver-wrench"></i></a>
                                            @if($pending['customerID'])
                                                <a href="{{ route('messageCustomer', ['customerID' => $pending['customerID']]) }}"><i class="fa-solid fa-comment icon-info"></i></a>
                                            @else
                                                <a><i class="fa-solid fa-comment-slash icon-disabled"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    @endif

                    @if(count($repairStatusPendingData) > 8)
                        <div class="pagination">
                        </div>
                    @else
                        <div class="pagination" style="display:none;">
                        </div>
                    @endif
                </div>
                <div id="completed" id="completed-repair" class="tab-content-item card">
                    @if(count($repairStatusCompletedData) === 0)
                        <div class="empty-message">
                            <i class="fa-solid fa-screwdriver-wrench"></i>
                            <p>No completed repairs at the moment</p>                            
                        </div>
                    @else
                        <table id="completed-table">
                            <thead>
                                <tr>
                                    <th>Repair ID</th>
                                    <th>Customer Name</th>
                                    <th>Revenue</th>
                                    <th>Expenses</th>
                                    <th>Date Completed</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <-- Completed Repair Records will be populated here
                                @foreach($repairStatusCompletedData as $completed)
                                    <tr>
                                        <td>#{{$completed['repairID']}}</td>
                                        <td>{{$completed['customer_name']}}</td>
                                        <td>P {{$completed['revenue']}}</td>
                                        <td>P {{$completed['expenses']}}</td>
                                        <td>
                                            {{$completed['date']}}, {{$completed['time']}}
                                        </td>
                                        <td><button class="view-details" data-appointment-id="{{$completed['appointment_id']}}">View</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    @if(count($repairStatusCompletedData) > 8)
                        <div class="pagination">
                        </div>
                    @else
                        <div class="pagination" style="display:none;">
                        </div>
                    @endif
                </div>
                <div id="terminated" id="terminated-repair" class="tab-content-item card">
                    @if(count($repairStatusTerminatedData) === 0)
                        <div class="empty-message">
                            <i class="fa-solid fa-screwdriver-wrench"></i>
                            <p>No terminated repairs at the moment</p>                            
                        </div>
                    @else
                        <table id="terminated-table">
                            <thead>
                                <tr>
                                    <th>Repair ID</th>
                                    <th>Customer Name</th>
                                    <th>Revenue</th>
                                    <th>Expenses</th>
                                    <th>Date Terminated</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($repairStatusTerminatedData as $terminated)
                                    <tr>
                                        <td>#{{$terminated['repairID']}}</td>
                                        <td>{{$terminated['customer_name']}}</td>
                                        <td>P {{$terminated['revenue']}}</td>
                                        <td>P {{$terminated['expenses']}}</td>
                                        <td>
                                            {{$terminated['date']}}, {{$terminated['time']}}
                                        </td>
                                        <td><button class="view-details" data-appointment-id="{{$terminated['appointment_id']}}">View</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    @if(count($repairStatusTerminatedData) > 8)
                        <div class="pagination">
                        </div>
                    @else
                        <div class="pagination" style="display:none;">
                        </div>
                    @endif
                </div>
            </div>

            
        </main>
    </div>
    
    <script>
        const tabs = document.querySelectorAll(".tab-link");
        const tabContentItems = document.querySelectorAll(".tab-content-item");
        const searchInput = document.getElementById("search-input");
        const itemsPerPage = 8; // Define how many items per page
        let currentPage = 1; // Initial page number
        let activeTab = "pending"; // Default active tab

        // Function to display items for a specific tab and page
        function displayTabContent(tab, page = 1, search = "") {
            const table = document.getElementById(`${tab}-table`);
            if (!table) return; // Add this line to prevent errors if the table is missing

            const rows = Array.from(table.querySelector("tbody").rows);
            const filteredRows = search
                ? rows.filter(row => row.textContent.toLowerCase().includes(search.toLowerCase()))
                : rows;

            const totalItems = filteredRows.length;
            const start = (page - 1) * itemsPerPage;
            const end = page * itemsPerPage;
            
            // Hide all rows and show only the filtered rows for the current page
            rows.forEach(row => row.style.display = "none");
            filteredRows.slice(start, end).forEach(row => row.style.display = "");

            // Update pagination controls
            renderPagination(tab, page, Math.ceil(totalItems / itemsPerPage));
        }


        // Function to switch active tab
        function switchTab(tab) {
            // Update active tab
            activeTab = tab;
            currentPage = 1; // Reset page to the first page

            // Toggle active class for tabs and tab content
            tabs.forEach(t => t.classList.toggle("active", t.dataset.tab === tab));
            tabContentItems.forEach(content => content.classList.toggle("active", content.id === tab));

            // Display content for the current tab
            displayTabContent(tab, currentPage, searchInput.value.trim());
        }

        // Function to render pagination
        function renderPagination(tab, currentPage, totalPages) {
            const paginationContainer = document.querySelector(`#${tab} .pagination`);
            paginationContainer.innerHTML = "";

            // Calculate the range of page numbers to display
            const maxPagesToShow = 5;
            let startPage = Math.max(1, currentPage - Math.floor(maxPagesToShow / 2));
            let endPage = startPage + maxPagesToShow - 1;

            // Adjust if we're near the beginning or end of the page range
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

            // Create page number buttons within the calculated range
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
            currentPage = 1; // Reset to the first page when searching
            displayTabContent(activeTab, currentPage, searchInput.value.trim());
        });

        // Initialize display for the default tab
        switchTab(activeTab);

    </script>
    <script src="{{asset('js/Technician/3 - RepairStatus.js')}}" defer></script>
    <script src="{{asset('js/Technician/technician-sidebar.js')}}" defer></script>
    <script src="{{asset('js/Technician/technician-notification.js')}}" defer></script>
    
</body>
</html>
