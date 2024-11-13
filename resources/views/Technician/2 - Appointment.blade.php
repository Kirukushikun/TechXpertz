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

    <link rel="stylesheet" href="{{asset('css/Technician/2 - Appointment.css')}}">
    <link rel="stylesheet" href="{{asset('css/Technician/technician-modal.css')}}">
    <link rel="stylesheet" href="{{asset('css/Technician/technician-notification.css')}}">

    <style>

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
                                <td class="name-column">{{$request['fullname']}}</td>
                                <td>{{$request['email']}}</td>
                                <td>{{$request['contact']}}</td>
                                <td class="month-column" data-month="{{$request['js_month']}}" data-day="{{$request['js_day']}}">{{$request['formatted_date']}}</td>
                                <td class="time-column" data-time="{{$request['js_time']}}">{{$request['formatted_time']}}</td>
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
                                        <td class="name-column">{{$confirmed['fullname']}}</td>
                                        <td>{{$confirmed['email']}}</td>
                                        <td>{{$confirmed['contact']}}</td>
                                        <td class="month-column" data-month="{{$confirmed['js_month']}}" data-day="{{$confirmed['js_day']}}">{{$confirmed['formatted_date']}}</td>
                                        <td class="time-column" data-time="{{$confirmed['js_time']}}">{{$confirmed['formatted_time']}}</td>
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
                                    <td class="name-column">{{$rejected['fullname']}}</td>
                                    <td>{{$rejected['email']}}</td>
                                    <td>{{$rejected['contact']}}</td>
                                    <td class="month-column" data-month="{{$rejected['js_month']}}" data-day="{{$rejected['js_day']}}">{{$rejected['formatted_date']}}</td>
                                    <td class="time-column" data-time="{{$rejected['js_time']}}">{{$rejected['formatted_time']}}</td>
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
        </main>
    </div> 
    <script src="{{asset('js/Technician/2 - Appointment.js')}}" defer></script>
    <script src="{{asset('js/Technician/technician-sidebar.js')}}" defer></script>
    <script src="{{asset('js/Technician/technician-notification.js')}}" defer></script>

    
</body>
</html>
