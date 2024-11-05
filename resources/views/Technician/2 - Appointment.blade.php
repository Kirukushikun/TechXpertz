@include('components.technician-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Crucial Part on every forms -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Crucial Part on every forms/ -->
    <title>Appointment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/Technician/technician-sidebar.css')}}">

    <link rel="stylesheet" href="{{asset('css/Technician/2 - Appointment.css')}}">
    <link rel="stylesheet" href="{{asset('css/Technician/technician-modal.css')}}">
    <link rel="stylesheet" href="{{asset('css/Technician/technician-notification.css')}}">

    <style>
        /* Container for Filter Button and Panel */
        .filter-container {
            position: relative;
            display: inline-block;
        }

        /* Filter Button */
        .filter-btn {
            padding: 5px 15px;
            background-color: transparent;
            border: none;
            cursor: pointer;

            border-radius: 7px;
            border: solid #D9D9D9 2px;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .filter-btn i {
            margin-right: 8px;
        }

        /* Filter Panel (hidden by default) */
        .filter-panel {
        display: none; /* Hidden initially */
        position: absolute;
        top: 100%;
        left: 0;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 200px;
        padding: 10px;
        z-index: 1000;
        }

        .filter-panel h3 {
        margin: 0;
        font-size: 18px;
        color: #333;
        padding-bottom: 8px;
        border-bottom: 1px solid #ddd;
        }

        .filter-option {
        margin: 8px 0;
        }

        .apply-filter-btn {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
        margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="dashboard">

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

        @yield('sidebar')

        <main class="main-content">
            <header>
                <h1>Appointment Management</h1>
                <div class="technician-name">
                    @php
                        $technician = Auth::guard('technician')->user();
                    @endphp
                    <h3>Hi, <span>{{$technician->firstname}}.</span></h3>
                </div>
            </header>

            <div class="appointment-navigation">
                <ul class="tabs">
                    <div class="tab-navigation">
                        <li class="tab-link active" data-tab="request" data-table="request-table">Requests <img src="{{asset('images/calendar-dot.png')}}"></li>
                        <li class="tab-link" data-tab="upcoming" data-table="upcoming-table">Confirmed <img src="{{asset('images/calendar-check.png')}}"></li>
                        <!-- <li class="tab-link" data-tab="completed">Completed <i class="fa-solid fa-check-double"></i></li> -->
                        <li class="tab-link" data-tab="rejected" data-table="rejected-table">Cancelled/Rejected <img src="{{asset('images/calendar-x.png')}}"></li>                        
                    </div>

                    <div class="tab-filters">
                        <!-- <li><button><i class="fa-solid fa-filter"></i> Filter</button></li> -->
                        <div class="filter-container">
                            <!-- Filter Button -->
                            <button class="filter-btn" id="filter-btn">
                                <i class="fa-solid fa-filter"></i> Filter
                            </button>
                            
                            <!-- Filter Panel (hidden by default) -->
                            <div class="filter-panel" id="filter-panel">                                
                                <h3>Filter by Date</h3>
                                <label>From: <input type="date" id="filter-date-from"></label>
                                <label>To: <input type="date" id="filter-date-to"></label>
                                
                                <h3>Filter by Time</h3>
                                <label>From: <input type="time" id="filter-time-from"></label>
                                <label>To: <input type="time" id="filter-time-to"></label>

                                <button class="apply-filter-btn">Apply Filters</button>
                            </div>
                        </div>

                        <li><i class="fa-solid fa-magnifying-glass" id="search"></i> <input type="text" id="search-input" placeholder="search"></li>

                        <a class="add-appointment"><i class="fa-solid fa-plus" id="add-appointment"></i></a>
                    </div>
                </ul>
            </div>

            <div class="tab-content">
                <div id="request" class="tab-content-item card active">
                    @if(count($requestedAppointments) === 0)
                    <div class="empty-message">
                        <img src="{{asset('images/no-appointments.png')}}">
                        <p>No appointment requests at the moment.</p>                            
                    </div>
                    @else
                    <table id="request-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Request Date</th>
                                <th>Request Time</th>
                                <th>Details</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requestedAppointments as $request)
                            <tr>    
                                <td>{{$request['fullname']}}</td>
                                <td>{{$request['email']}}</td>
                                <td>{{$request['contact']}}</td>
                                <td>{{$request['formatted_date']}}</td>
                                <td>{{$request['formatted_time']}}</td>
                                <td><button class="view-details" data-appointment-id="{{$request['ID']}}" data-appointment-status="request">View</button></td>
                                <td style="user-select: none;">
                                    <a class="appointment-btn" data-appointment-id="{{$request['ID']}}" data-appointment-status="reject"><i class="fa-regular fa-calendar-xmark icon-danger"></i></a>
                                    <a class="appointment-btn" data-appointment-id="{{$request['ID']}}" data-appointment-status="confirm"><i class="fa-regular fa-calendar-check icon-success"></i></a>
                                    @if($request['customer_id'])
                                        <a href="{{ route('messageCustomer', ['customerID' => $request['customer_id']]) }}"><i class="fa-solid fa-comment icon-info"></i></a>
                                    @else
                                        <a><i class="fa-solid fa-comment-slash icon-disabled"></i></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif

                    @if(count($requestedAppointments) > 8 )
                        <div class="pagination">
                        </div>
                    @else
                        <div class="pagination" style="display:none;">
                        </div>
                    @endif
                </div>                
                <div id="upcoming" class="tab-content-item card">
                    @if(count($confirmedAppointments) === 0)
                        <div class="empty-message">
                            <img src="{{asset('images/no-appointments.png')}}">
                            <p>No scheduled appointments yet.</p>                            
                        </div>
                    @else
                        <table id="upcoming-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($confirmedAppointments as $confirmed)
                                    <tr>
                                        <td>{{$confirmed['fullname']}}</td>
                                        <td>{{$confirmed['email']}}</td>
                                        <td>{{$confirmed['contact']}}</td>
                                        <td>{{$confirmed['formatted_date']}}</td>
                                        <td>{{$confirmed['formatted_time']}}</td>
                                        <td><button class="view-details" data-appointment-id="{{$confirmed['ID']}}">View</button></td>
                                        <td style="user-select: none;">
                                            <a class="appointment-btn" data-appointment-id="{{$confirmed['ID']}}" data-appointment-status="cancel"><i class="fa-regular fa-calendar-xmark icon-danger"></i></a>
                                            <a class="appointment-btn" data-appointment-id="{{$confirmed['ID']}}" data-customer-id="{{$confirmed['customer_id']}}" data-appointment-status="repair"><i class="fa-solid fa-screwdriver-wrench icon-primary"></i></a>
                                            @if($confirmed['customer_id'])
                                                <a href="{{ route('messageCustomer', ['customerID' => $confirmed['customer_id']]) }}"><i class="fa-solid fa-comment icon-info"></i></a>
                                            @else
                                                <a><i class="fa-solid fa-comment-slash icon-disabled"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                    @if(count($confirmedAppointments) > 8 )
                        <div class="pagination">
                        </div>
                    @else
                        <div class="pagination" style="display:none;">
                        </div>
                    @endif
                </div>

                <div id="rejected" class="tab-content-item card">
                    @if(count($rejectedAppointments) === 0)
                    <div class="empty-message">
                        <img src="{{asset('images/no-appointments.png')}}">
                        <p>No cancelled/rejected appointments at the moment.</p>                            
                    </div>
                    @else
                    <table id="rejected-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Details</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rejectedAppointments as $rejected)
                                <tr>
                                    <td>{{$rejected['fullname']}}</td>
                                    <td>{{$rejected['email']}}</td>
                                    <td>{{$rejected['contact']}}</td>
                                    <td>{{$rejected['formatted_date']}}</td>
                                    <td>{{$rejected['formatted_time']}}</td>
                                    <td><button class="view-details" data-appointment-id="{{$rejected['ID']}}">View</button></td>
                                    <td class="table-action" style="user-select: none;">
                                    @if($rejected['customer_id'])
                                        <a href="{{ route('messageCustomer', ['customerID' => $rejected['customer_id']]) }}"><i class="fa-solid fa-comment icon-info"></i></a>
                                    @else
                                        <a><i class="fa-solid fa-comment-slash icon-disabled"></i></a>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif

                    @if(count($rejectedAppointments) > 8 )
                        <div class="pagination">
                        </div>
                    @else
                        <div class="pagination" style="display:none;">
                        </div>
                    @endif
                </div>
            </div>

            <!-- <div class="tab-content">
                <div id="upcoming" class="tab-content-item card active">
                    
                    <table id="upcoming-table">
                        <thead>
                            <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Details</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 0; $i < 100; $i++)
                            <tr>
                                <td>{{$i}}</td>
                                <td>johndoe@example.com</td>
                                <td>+123-456-7890</td>
                                <td>2023-11-01</td>
                                <td>10:00 AM</td>
                                <td><button class="view-details" data-appointment-id="123">View</button></td>
                                <td>
                                    <a class="appointment-btn" data-appointment-id="123" data-appointment-status="cancel"><i class="fa-regular fa-calendar-xmark icon-danger"></i></a>
                                    <a class="appointment-btn" data-appointment-id="123" data-customer-id="456" data-appointment-status="repair"><i class="fa-solid fa-screwdriver-wrench icon-primary"></i></a>
                                    <a href="{{ route('messageCustomer', ['customerID' => 456]) }}"><i class="fa-solid fa-comment icon-info"></i></a>
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>

                    <div class="pagination">
                    </div>
                </div>
                <div id="request" class="tab-content-item card">
                    <table id="request-table">
                        <thead>
                            <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Details</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 0; $i < 81; $i++)
                                <tr>
                                    <td>{{$i}}</td>
                                    @if($i == 67)
                                        <td>ishirobles@example.com</td>
                                    @elseif($i == 80) 
                                        <td>iversoncraigg@example.com</td>
                                    @else
                                    <td>johndoe@example.com</td>
                                    @endif
                                    <td>+123-456-7890</td>
                                    <td>2023-11-01</td>
                                    <td>10:00 AM</td>
                                    <td><button class="view-details" data-appointment-id="123">View</button></td>
                                    <td>
                                        <a class="appointment-btn" data-appointment-id="123" data-appointment-status="cancel"><i class="fa-regular fa-calendar-xmark icon-danger"></i></a>
                                        <a class="appointment-btn" data-appointment-id="123" data-customer-id="456" data-appointment-status="repair"><i class="fa-solid fa-screwdriver-wrench icon-primary"></i></a>
                                        <a href="{{ route('messageCustomer', ['customerID' => 456]) }}"><i class="fa-solid fa-comment icon-info"></i></a>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                
                    <div class="pagination">
                    </div>
                </div>
                <div id="rejected" class="tab-content-item card">
                    <table id="rejected-table">
                        <thead>
                            <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Details</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 0; $i < 7; $i++)
                            <tr>
                                <td>{{$i}}</td>
                                <td>johndoe@example.com</td>
                                <td>+123-456-7890</td>
                                <td>2023-11-01</td>
                                <td>10:00 AM</td>
                                <td><button class="view-details" data-appointment-id="123">View</button></td>
                                <td>
                                    <a class="appointment-btn" data-appointment-id="123" data-appointment-status="cancel"><i class="fa-regular fa-calendar-xmark icon-danger"></i></a>
                                    <a class="appointment-btn" data-appointment-id="123" data-customer-id="456" data-appointment-status="repair"><i class="fa-solid fa-screwdriver-wrench icon-primary"></i></a>
                                    <a href="{{ route('messageCustomer', ['customerID' => 456]) }}"><i class="fa-solid fa-comment icon-info"></i></a>
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                    <div class="pagination">
                    </div>
                </div>
            </div> -->
        </main>
    </div> 
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterPanel = document.getElementById('filter-panel');
        const filterBtn = document.getElementById('filter-btn');
        const rows = document.querySelectorAll('.appointment-row'); // Select rows by class for flexibility

        // Toggle filter panel visibility
        filterBtn.addEventListener('click', function () {
            filterPanel.style.display = filterPanel.style.display === 'block' ? 'none' : 'block';
        });

        // Apply filters when there's a change in filter options
        filterPanel.addEventListener('change', applyFilters);

        function applyFilters() {
            const dateFrom = document.getElementById('filter-date-from').value;
            const dateTo = document.getElementById('filter-date-to').value;
            const timeFrom = document.getElementById('filter-time-from').value;
            const timeTo = document.getElementById('filter-time-to').value;

            rows.forEach(row => {
                const rowDate = row.getAttribute('data-appointment-date');
                const rowTime = row.getAttribute('data-appointment-time');

                // Date filter check
                const dateMatch = (!dateFrom || rowDate >= dateFrom) && (!dateTo || rowDate <= dateTo);

                // Time filter check
                const timeMatch = (!timeFrom || rowTime >= timeFrom) && (!timeTo || rowTime <= timeTo);

                // Show or hide row based on date and time conditions
                if (dateMatch && timeMatch) {
                    row.style.display = ''; // Show row
                } else {
                    row.style.display = 'none'; // Hide row
                }
            });
        }
    });
    </script>
    <script src="{{asset('js/Technician/2 - Appointment.js')}}" defer></script>
    <script src="{{asset('js/Technician/technician-sidebar.js')}}" defer></script>
    <script src="{{asset('js/Technician/technician-notification.js')}}" defer></script>

    
</body>
</html>
