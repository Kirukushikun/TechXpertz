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

</head>
<body>
    <div class="dashboard">
        <div class="modal" id="modal">

        </div>

        @yield('sidebar')

        <main class="main-content">
            <header>
                <h1>Repair Status</h1>
            </header>

            <div class="repair-navigation">
                <ul class="tabs">
                    <div class="tab-navigation">
                        <li class="tab-link active" data-tab="pending-repair">In Progress<i class="fa-solid fa-spinner"></i></li>
                        <li class="tab-link" data-tab="completed-repair">Completed<i class="fa-solid fa-check-double"></i></li>
                        <li class="tab-link" data-tab="terminated-repair">Terminated<i class="fa-solid fa-trash"></i></li>
                    </div>
                    
                    <div class="tab-filters">
                        <li><button><i class="fa-solid fa-filter"></i> Filter</button></li>
                        <li><i class="fa-solid fa-magnifying-glass" id="search"></i> <input type="text" placeholder="search"></li>

                        <a class="add-repair"><i class="fa-solid fa-plus" id="add-appointment"></i></a>
                    </div>
                </ul>
            </div>

            <div class="tab-content">
                <div id="pending-repair" class="tab-content-item card active">
                    @if(count($repairStatusPendingData) === 0)
                        <div class="empty-message">
                            <i class="fa-solid fa-user-xmark"></i>
                            <p>No pending repairs at the moment.</p>                            
                        </div>
                    @else    
                        <table>
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
                                        <td >
                                            <button class="view-details" data-appointment-id="{{$pending['appointment_id']}}">
                                                View
                                            </button>
                                        </td>
                                        <td>
                                            <a class="terminate-btn" data-repair-id="{{$pending['repairID']}}" data-customer-id="{{$pending['customerID']}}">Terminate</a>
                                            <a class="update-btn" data-repair-id="{{$pending['repairID']}}" data-customer-id="{{$pending['customerID']}}">Update</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            
                        </table>
                    @endif
                </div>
                <div id="completed-repair" class="tab-content-item card">
                    @if(count($repairStatusCompletedData) === 0)
                        <div class="empty-message">
                            <i class="fa-solid fa-user-xmark"></i>
                            <p>No completed repairs at the moment</p>                            
                        </div>
                    @else
                        <table>
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
                                <!-- Completed Repair Records will be populated here -->
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
                </div>
                <div id="terminated-repair" class="tab-content-item card">
                    @if(count($repairStatusTerminatedData) === 0)
                        <div class="empty-message">
                            <i class="fa-solid fa-user-xmark"></i>
                            <p>No terminated repairs at the moment</p>                            
                        </div>
                    @else
                        <table>
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
                                <!-- Completed Repair Records will be populated here -->
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
                </div>
            </div>

            
        </main>
    </div>
    
    <script src="{{asset('js/Technician/3 - RepairStatus.js')}}"></script>
    <script src="{{asset('js/Technician/technician-sidebar.js')}}"></script>
    <script src="{{asset('js/Technician/technician-modal.js')}}"></script>

</body>
</html>
