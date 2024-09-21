@include('components.technician-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/Technician/technician-sidebar.css')}}">

    <link rel="stylesheet" href="{{asset('css/Technician/1 - Dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('css/Technician/technician-modal.css')}}">
</head>
<body>
    <div class="dashboard">

        <div class="modal" id="modal">
        </div>

        @yield('sidebar')

        <main class="main-content">
            <header>
                <h1>Dashboard</h1>
            </header>

            <section class="stats">
                <div class="stat revenue-card">
                    <div class="info">
                        <p>Revenue</p>
                        <h2>P{{$revenue}}</h2>
                    </div>
                    <div class="progress revenue">
                        <h4 class="percentage">+22%</h4>
                        <i class="fa-solid fa-arrow-trend-up"></i>
                    </div>
                </div>
                <div class="stat repairs-card">
                    <div class="info">
                        <p>Total Repairs</p>
                        <h2>{{count($totalRepairs)}}</h2>
                    </div>
                    <div class="progress repairs">
                        <h4 class="percentage">-25%</h4>
                        <i class="fa-solid fa-arrow-trend-down"></i>
                    </div>
                </div>
                <div class="stat visitors-card">
                    <div class="info">
                        <p>Visitors</p>
                        <h2>1.5K</h2>
                    </div>
                    <div class="progress visitors">
                        <h4 class="percentage">+49%</h4>
                        <i class="fa-solid fa-arrow-trend-up"></i>
                    </div>
                </div>
                <div class="stat reviews-card">
                    <div class="info">
                        <p>Reviews</p>
                        <h2>{{count($reviews)}}</h2>
                    </div>
                    <div class="progress reviews">
                        <h4 class="percentage">+1.9%</h4>
                        <i class="fa-solid fa-arrow-trend-up"></i>
                    </div>
                </div>
            </section>
            
            <section class="appointments">
                <div class="appointments-requests card">
                    <div class="actions">
                        <h2>Appointment Requests</h2>
                        <a href="/technician/appointment">More <i class="fa-solid fa-arrow-right"></i></a>
                    </div>

                    @if(count($requestedAppointments) === 0 )
                        <div class="empty-message">
                            <i class="fa-solid fa-user-xmark"></i>
                            <p>No appointment requests at the moment.</p>                            
                        </div>
                    @else
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Device Type</th>
                                    <th>Requested Date</th>
                                    <th>Requested Time</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach($requestedAppointments as $request)
                                    <tr>
                                        <td class="profile-cell">{{$request->fullname}}</td>
                                        <td>{{$request->device_type}}</td>
                                        <td>{{$request->formatted_date}}</td>
                                        <td>{{$request->formatted_time}}</td>
                                    </tr>                            
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                </div>
                <div class="appointment-summary card">
                    <div class="actions">
                        <h2>Activity Summary</h2>
                    </div>
                    <div class="summary-cards">
                        <div class="summary-card">
                            <div class="info">
                                <p>Upcoming</p>
                                <h2>{{count($upcomingAppointments)}}</h2>                                
                            </div>
                            <i class="fa-solid fa-calendar-day upcoming"></i>
                        </div>
                        <div class="summary-card">
                            <div class="info">
                                <p>Requests</p>
                                <h2>{{count($requestedAppointments)}}</h2>                                
                            </div>
                            <i class="fa-solid fa-calendar-plus request"></i>
                        </div>
                        <div class="summary-card">
                            <div class="info">
                                <p>Pending Repairs</p>
                                <h2>{{count($pendingStatus)}}</h2>                                
                            </div>
                            <i class="fa-solid fa-screwdriver-wrench pending"></i>
                        </div>
                        <div class="summary-card">
                            <div class="info">
                                <p>Completed Repairs</p>
                                <h2>{{count($completedStatus)}}</h2>                                
                            </div>
                            <i class="fa-solid fa-check-double completed"></i>
                        </div>
                    </div>
                </div>
            </section>

            <section class="upcoming-appointments card">

                <div class="actions">
                    <h2>Upcoming Appointments</h2>
                    <a href="/technician/appointment">More <i class="fa-solid fa-arrow-right"></i></a>
                </div>

                @if(count($upcomingAppointments) === 0)
                    <div class="empty-message">
                        <i class="fa-solid fa-user-xmark"></i>
                        <p>No appointments scheduled yet.</p>                            
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
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($upcomingAppointments as $upcoming)
                                <tr>
                                    <td>{{$upcoming->fullname}}</td>
                                    <td>{{$upcoming->email}}</td>
                                    <td>{{$upcoming->contact_no}}</td>
                                    <td>{{$upcoming->formatted_date}}</td>
                                    <td>{{$upcoming->formatted_time}}</td>
                                    <td><button class="view-details" data-appointment-id="{{$upcoming->id}}">View</button></td>
                                    <td>
                                    <a class="appointment-btn" data-appointment-id="{{$upcoming->id}}" data-appointment-status="cancel" style="color:red;"><i class="fa-regular fa-calendar-xmark"></i></a>
                                    <!-- <a class="more" href=""><i class="fa-solid fa-ellipsis"></i></a> -->
                                    </td>
                                </tr>                            
                            @endforeach

                        </tbody>
                    </table>
                @endif
            </section>
        </main>
    </div>
    
    <script src="{{asset('js/Technician/technician-sidebar.js')}}"></script>
    <script src="{{asset('js/Technician/technician-modal.js')}}"></script>
</body>
</html>
