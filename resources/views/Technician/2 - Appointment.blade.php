@include('components.technician-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/Technician/technician-sidebar.css')}}">

    <link rel="stylesheet" href="{{asset('css/Technician/2 - Appointment.css')}}">
</head>
<body>
    <div class="dashboard">

        @yield('sidebar')

        <main class="main-content">
            <header>
                <h1>Appointment</h1>
            </header>

            <div class="appointment-navigation">
                <ul class="tabs">
                    <li class="tab-link active" data-tab="upcoming">Confirmed <i class="fa-solid fa-check"></i></li>
                    <li class="tab-link" data-tab="request">Requested <i class="fa-solid fa-spinner"></i></li>
                    <!-- <li class="tab-link" data-tab="request">Requested<span class="badge">3</span></li> -->
                    <li class="tab-link" data-tab="completed">Completed <i class="fa-solid fa-check-double"></i></li>
                    <li class="tab-link" data-tab="completed">Rejected <i class="fa-solid fa-xmark"></i></li>
                </ul>
            </div>

            <div class="tab-content">
                <div id="upcoming" class="tab-content-item card active">
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
                                    <td>{{$confirmed['appointment_date']}}</td>
                                    <td>{{$confirmed['appointment_time']}}</td>
                                    <td><button>View</button></td>
                                    <td>
                                        <a class="edit" href=""><i class="fas fa-edit"></i></a>
                                        <a class="delete" href=""><i class="fas fa-trash"></i></a>
                                        <a class="more" href=""><i class="fa-solid fa-ellipsis"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="request" class="tab-content-item card">
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
                            @foreach($requestedAppointments as $request)
                            <tr>
                                <td>{{$request['fullname']}}</td>
                                <td>{{$request['email']}}</td>
                                <td>{{$request['contact']}}</td>
                                <td>{{$request['appointment_date']}}</td>
                                <td>{{$request['appointment_time']}}</td>
                                <td><button>View</button></td>
                                <td>
                                    <a class="edit" href=""><i class="fas fa-edit"></i></a>
                                    <a class="delete" href=""><i class="fas fa-trash"></i></a>
                                    <a class="more" href=""><i class="fa-solid fa-ellipsis"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="completed" class="tab-content-item card">
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
                            @foreach($completedAppointments as $completed)
                                <tr>
                                    <td>{{$completed['fullname']}}</td>
                                    <td>{{$completed['email']}}</td>
                                    <td>{{$completed['contact']}}</td>
                                    <td>{{$completed['appointment_date']}}</td>
                                    <td>{{$completed['appointment_time']}}</td>
                                    <td><button>View</button></td>
                                    <td>
                                        <a class="edit" href=""><i class="fas fa-edit"></i></a>
                                        <a class="delete" href=""><i class="fas fa-trash"></i></a>
                                        <a class="more" href=""><i class="fa-solid fa-ellipsis"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div id="rejected" class="tab-content-item card">
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
                            @foreach($completedAppointments as $completed)
                                <tr>
                                    <td>{{$completed['fullname']}}</td>
                                    <td>{{$completed['email']}}</td>
                                    <td>{{$completed['contact']}}</td>
                                    <td>{{$completed['appointment_date']}}</td>
                                    <td>{{$completed['appointment_time']}}</td>
                                    <td><button>View</button></td>
                                    <td>
                                        <a class="edit" href=""><i class="fas fa-edit"></i></a>
                                        <a class="delete" href=""><i class="fas fa-trash"></i></a>
                                        <a class="more" href=""><i class="fa-solid fa-ellipsis"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </main>
    </div>
    
    <script src="{{asset('js/Technician/2 - Appointment.js')}}"></script>
    <script src="{{asset('js/Technician/technician-sidebar.js')}}"></script>
    
</body>
</html>
