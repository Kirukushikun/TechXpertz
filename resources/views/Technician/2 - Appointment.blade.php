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
</head>
<body>
    <div class="dashboard">

        <div class="modal" id="modal">

        </div>

        @yield('sidebar')

        <main class="main-content">
            <header>
                <h1>Appointment</h1>
            </header>

            <div class="appointment-navigation">
                <ul class="tabs">
                    <div class="tab-navigation">
                        <li class="tab-link active" data-tab="upcoming">Confirmed <i class="fa-solid fa-check"></i></li>
                        <li class="tab-link" data-tab="request">Requests <i class="fa-solid fa-spinner"></i></li>
                        <!-- <li class="tab-link" data-tab="completed">Completed <i class="fa-solid fa-check-double"></i></li> -->
                        <li class="tab-link" data-tab="rejected">Cancelled/Rejected <i class="fa-solid fa-xmark"></i></li>                        
                    </div>

                    <div class="tab-filters">
                        <li><button><i class="fa-solid fa-filter"></i> Filter</button></li>
                        <li><i class="fa-solid fa-magnifying-glass" id="search"></i> <input type="text" placeholder="search"></li>

                        <a href=""><i class="fa-solid fa-plus" id="add-appointment"></i></a>
                    </div>
                </ul>
            </div>

            <div class="tab-content">

                <div id="upcoming" class="tab-content-item card active">
                    @if(count($confirmedAppointments) === 0)
                        <div class="empty-message">
                            <i class="fa-solid fa-user-xmark"></i>
                            <p>No scheduled appointments yet.</p>                            
                        </div>
                    @else
                        <table>
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
                                        <td>
                                            <a class="appointment-btn" data-appointment-id="{{$confirmed['ID']}}" data-appointment-status="cancel" style="color:red;"><i class="fa-regular fa-calendar-xmark"></i></a>
                                            <a class="appointment-btn" data-appointment-id="{{$confirmed['ID']}}" data-customer-id="{{$confirmed['customer_id']}}" data-appointment-status="repair" style="color:blue;"><i class="fa-solid fa-screwdriver-wrench"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <div id="request" class="tab-content-item card">
                    @if(count($requestedAppointments) === 0)
                    <div class="empty-message">
                        <i class="fa-solid fa-user-xmark"></i>
                        <p>No appointment requests at the moment.</p>                            
                    </div>
                    @else
                    <table>
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
                                <td><button class="view-upcoming" data-upcoming-id="{{$request['ID']}}">View</button></td>
                                <td>
                                    <a class="appointment-btn" data-appointment-id="{{$request['ID']}}" data-appointment-status="reject" style="color:red;"><i class="fa-regular fa-calendar-xmark"></i></a>
                                    <a class="appointment-btn" data-appointment-id="{{$request['ID']}}" data-appointment-status="confirm" style="color:green;"><i class="fa-regular fa-calendar-check"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                <div id="rejected" class="tab-content-item card">
                    @if(count($rejectedAppointments) === 0)
                    <div class="empty-message">
                        <i class="fa-solid fa-user-xmark"></i>
                        <p>No cancelled/rejected appointments at the moment.</p>                            
                    </div>
                    @else
                    <table>
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
                                    <td><button class="view-upcoming" data-upcoming-id="{{$rejected['ID']}}">View</button></td>
                                    <td>
                                        <a class="delete-appointment" data-deleteUpcoming-id="{{$rejected['ID']}}"><i class="fa-regular fa-calendar-xmark"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>

            </div>
        </main>
    </div>
    
    <script src="{{asset('js/Technician/2 - Appointment.js')}}"></script>
    <script src="{{asset('js/Technician/technician-sidebar.js')}}"></script>
    <script src="{{asset('js/Technician/technician-modal.js')}}"></script>

    
</body>
</html>
