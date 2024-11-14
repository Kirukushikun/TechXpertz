@include('components.technician-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Crucial Part on every forms -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Crucial Part on every forms/ -->
    <title>TechXpertz</title>
    <link rel="icon" href="{{ asset('images/TechXpertz-Icon.ico') }}">
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
                        <div class="filter-container">
                            <button class="filter-btn" id="filter-btn">
                                <i class="fa-solid fa-filter"></i> Filter
                            </button>
                            <div class="filter-panel" id="filter-panel"> 
                                <p>Filter by name</p>  
                                <div class="name-filter">
                                    <select id="alphabetical-order">
                                        <option value="">Select Order</option>
                                        <option value="ascending">Ascending</option>
                                        <option value="descending">Descending</option>
                                    </select>
                                </div>
                                <p>Filter by month</p>                               
                                <select id="month-filter">
                                    <option value="">Select Month</option>
                                    <option value="01">January</option>
                                    <option value="02">Febuary</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                    <!-- Other months here -->
                                </select>
                                <p>Filter by day</p>  
                                <select id="day-of-week-filter">
                                    <option value="">Select Day of the Week</option>
                                    <option value="0">Sunday</option>
                                    <option value="1">Monday</option>
                                    <option value="2">Tuesday</option>
                                    <option value="3">Wednesday</option>
                                    <option value="4">Thursday</option>
                                    <option value="5">Friday</option>
                                    <option value="6">Saturday</option>
                                    <!-- Other days here -->
                                </select>
                                <p>Filter by time</p>  
                                <div class="time-filter">
                                    <label for="filter-time-from">Time From:</label>
                                    <input type="time" id="filter-time-from" name="dateFrom">
                                    
                                    <label for="filter-time-to">Time To:</label>
                                    <input type="time" id="filter-time-to" name="dateTo">                                    
                                </div>
                                
                                <button class="apply-filter-btn" onclick="applyFilters()">Apply Filters</button>
                            </div>
                        </div>

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
                                    <th>Time Completed</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($repairStatusCompletedData as $completed)
                                    <tr>
                                        <td>#{{$completed['repairID']}}</td>
                                        <td class="name-column">{{$completed['customer_name']}}</td>
                                        <td>P {{$completed['revenue']}}</td>
                                        <td>P {{$completed['expenses']}}</td>
                                        <td class="month-column" data-month="{{$completed['js_month']}}" data-day="{{$completed['js_day']}}">
                                            {{$completed['date']}} 
                                        </td>
                                        <td class="time-column" data-time="{{$completed['js_time']}}">
                                            {{$completed['time']}}
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
                                    <th>Time Terminated</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($repairStatusTerminatedData as $terminated)
                                    <tr>
                                        <td>#{{$terminated['repairID']}}</td>
                                        <td class="name-column">{{$terminated['customer_name']}}</td>
                                        <td>P {{$terminated['revenue']}}</td>
                                        <td>P {{$terminated['expenses']}}</td>
                                        <td class="month-column" data-month="{{$terminated['js_month']}}" data-day="{{$terminated['js_day']}}">
                                            {{$terminated['date']}}
                                        </td>
                                        <td class="time-column" data-time="{{$terminated['js_time']}}">
                                            {{$terminated['time']}}
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

        const filterPanel = document.getElementById('filter-panel');
        const filterBtn = document.getElementById('filter-btn');
        const rows = document.querySelectorAll('.appointment-row'); // Select rows by class for flexibility

        // Toggle filter panel visibility
        filterBtn.addEventListener('click', function () {
            filterPanel.style.display = filterPanel.style.display === 'block' ? 'none' : 'block';
        });

        // Function to display items for a specific tab and page with filters applied
        function displayTabContent(tab, page = 1, search = "", filters = {}) {
            const table = document.getElementById(`${tab}-table`);
            if (!table) return;

            const rows = Array.from(table.querySelector("tbody").rows);

            // Apply search filter
            let filteredRows = search
                ? rows.filter(row => row.textContent.toLowerCase().includes(search.toLowerCase()))
                : rows;

            // Apply sorting filter if applicable, only to rows with .name-column
            if (filters.order) {
                filteredRows = filteredRows.filter(row => row.querySelector(".name-column")); // Keep rows with .name-column
                filteredRows.sort((a, b) => {
                    const nameA = a.querySelector(".name-column").textContent.trim().toLowerCase();
                    const nameB = b.querySelector(".name-column").textContent.trim().toLowerCase();
                    return filters.order === "ascending" ? nameA.localeCompare(nameB) : nameB.localeCompare(nameA);
                });
            }

            // Filter by month if a month filter is provided
            if (filters.month) {
                filteredRows = filteredRows.filter(row => {
                    const rowMonth = row.querySelector(".month-column")?.dataset.month.split("-")[1]; // Extract month part
                    return rowMonth === filters.month;
                });
            }

            // Filter by day if a day filter is provided
            if (filters.day !== undefined && filters.day !== "") {
                filteredRows = filteredRows.filter(row => {
                    const day = new Date(row.querySelector(".month-column")?.dataset.day).getDay();
                    return day.toString() === filters.day;
                });
            }

            // Filter by time range if both timeFrom and timeTo filters are provided
            if (filters.timeFrom && filters.timeTo) {
                filteredRows = filteredRows.filter(row => {
                    const time = row.querySelector(".time-column")?.dataset.time;
                    return time >= filters.timeFrom && time <= filters.timeTo;
                });
            }

            // Pagination logic
            const totalItems = filteredRows.length;
            const start = (page - 1) * itemsPerPage;
            const end = page * itemsPerPage;

            // Hide all rows initially, then show only rows in the current page's range
            rows.forEach(row => row.style.display = "none");
            filteredRows.slice(start, end).forEach(row => row.style.display = "");

            // Update pagination controls with the current page and total pages
            renderPagination(tab, page, Math.ceil(totalItems / itemsPerPage));
        }

        // Function to switch active tab
        function switchTab(tab) {
            activeTab = tab;
            currentPage = 1; // Reset page to the first page

            // Toggle active class for tabs and tab content
            tabs.forEach(t => t.classList.toggle("active", t.dataset.tab === tab));
            tabContentItems.forEach(content => content.classList.toggle("active", content.id === tab));

            // Display content for the current tab
            displayTabContent(tab, currentPage, searchInput.value.trim(), getFilterValues());
        }

        // Function to render pagination
        function renderPagination(tab, currentPage, totalPages) {
            const paginationContainer = document.querySelector(`#${tab} .pagination`);
            paginationContainer.innerHTML = "";

            const maxPagesToShow = 5;
            let startPage = Math.max(1, currentPage - Math.floor(maxPagesToShow / 2));
            let endPage = startPage + maxPagesToShow - 1;

            if (endPage > totalPages) {
                endPage = totalPages;
                startPage = Math.max(1, endPage - maxPagesToShow + 1);
            }

            if (currentPage > 1) {
                const prevButton = document.createElement("button");
                prevButton.innerHTML = '<i class="fa-solid fa-caret-left"></i>';
                prevButton.addEventListener("click", () => {
                    currentPage -= 1;
                    displayTabContent(tab, currentPage, searchInput.value.trim(), getFilterValues());
                });
                paginationContainer.appendChild(prevButton);
            }

            for (let i = startPage; i <= endPage; i++) {
                const pageButton = document.createElement("button");
                pageButton.textContent = i;
                pageButton.classList.toggle("active", i === currentPage);
                pageButton.addEventListener("click", () => {
                    currentPage = i;
                    displayTabContent(tab, currentPage, searchInput.value.trim(), getFilterValues());
                });
                paginationContainer.appendChild(pageButton);
            }

            if (currentPage < totalPages) {
                const nextButton = document.createElement("button");
                nextButton.innerHTML = '<i class="fa-solid fa-caret-right"></i>';
                nextButton.addEventListener("click", () => {
                    currentPage += 1;
                    displayTabContent(tab, currentPage, searchInput.value.trim(), getFilterValues());
                });
                paginationContainer.appendChild(nextButton);
            }
        }

        // Function to get values from filters
        function getFilterValues() {
            return {
                order: document.getElementById("alphabetical-order").value,
                month: document.getElementById("month-filter").value,
                day: document.getElementById("day-of-week-filter").value,
                timeFrom: document.getElementById("filter-time-from").value,
                timeTo: document.getElementById("filter-time-to").value,
            };
        }

        // Apply filter button event
        function applyFilters() {
            currentPage = 1;
            displayTabContent(activeTab, currentPage, searchInput.value.trim(), getFilterValues());
        }

        // Tab click event listener
        tabs.forEach(tab => {
            tab.addEventListener("click", () => switchTab(tab.dataset.tab));
        });

        // Search input event listener
        searchInput.addEventListener("input", () => {
            currentPage = 1;
            displayTabContent(activeTab, currentPage, searchInput.value.trim(), getFilterValues());
        });

        // Initialize display for the default tab
        switchTab(activeTab);
    </script>
    <script src="{{asset('js/Technician/3 - RepairStatus.js')}}" defer></script>
    <script src="{{asset('js/Technician/technician-sidebar.js')}}" defer></script>
    <script src="{{asset('js/Technician/technician-notification.js')}}" defer></script>
    
</body>
</html>
