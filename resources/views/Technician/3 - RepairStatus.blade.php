@include('components.technician-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/Technician/technician-sidebar.css')}}">

    <link rel="stylesheet" href="{{asset('css/Technician/3 - RepairStatus.css')}}">
</head>
<body>
    <div class="dashboard">

        @yield('sidebar')

        <main class="main-content">
            <header>
                <h1>Repair Status</h1>
            </header>

            <div class="repair-navigation">
                <ul class="tabs">
                    <li class="tab-link active" data-tab="pending-repair">Pending Repair</li>
                    <li class="tab-link" data-tab="completed-repair">Completed Repair</li>
                </ul>
            </div>

            <div class="tab-content">
                <div id="pending-repair" class="tab-content-item card active">
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
                            <tr>
                                <td>#32000200</td>
                                <td>Chris P. Bacon</td>
                                <td>P 1.5K</td>
                                <td>P 500 <i class="fa-regular fa-pen-to-square"></i></td>
                                <td>
                                    <select class="paid-status">
                                        <option value="fully-paid" selected>Fully Paid</option>
                                        <option value="initially-paid">Initially Paid</option>
                                        <option value="unpaid">Unpaid</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="repair-status">
                                        <option value="device-dropped" selected>Device Dropped Off</option>
                                        <option value="diagnosis">Diagnosis in Progress</option>
                                        <option value="repair">Repair in Progress</option>
                                        <option value="waiting-parts">Waiting for Parts</option>
                                        <option value="repair-complete">Repair Completed</option>
                                        <option value="ready-pickup">Ready for Pickup</option>
                                        <option value="collected">Device Collected</option>
                                    </select>
                                </td>
                                <td><button>View</button></td>
                                <td><a href="" class="terminate-btn">Terminate</a></td>
                                <td><i class="fas fa-check"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="completed-repair" class="tab-content-item card">
                    <table>
                        <thead>
                            <tr>
                                <th>Repair ID</th>
                                <th>Customer Name</th>
                                <th>Revenue</th>
                                <th>Expenses</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Completed Repair Records will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    
    <script src="{{asset('js/Technician/3 - RepairStatus.js')}}"></script>
    <script src="{{asset('js/Technician/technician-sidebar.js')}}"></script>

</body>
</html>
