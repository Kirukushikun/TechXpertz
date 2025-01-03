@include('components.admin-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" href="{{ asset('images/TechXpertz-Icon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/Admin/1 - Dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Admin/admin-sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Admin/admin-modal.css') }}">

    <link rel="stylesheet" href="{{ asset('css/Admin/admin-charts.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="dashboard">

        <div class="modal">

        </div>

        @yield('sidebar')

        <main class="main-content">
            <div class="head">
                <div class="logo">
                    <h2>Tech<span>X</span>pertz</h2>
                </div>

                @yield('navbar')

            </div>
            <div class="body">
                <div class="header">
                    <h1>Dashboard</h1>
                </div>

                <div class="content">
                    <div class="container c1 metric">
                        <h3>{{$totalUsers}}</h3>
                        <h4>Total Users</h4>
                        <p>{{ abs($totalUsersPercentageChange) }}% {{ $totalUsersPercentageChange >= 0 ? 'Increase' : 'Decrease' }} from Last Week</p>
                    </div>
                    <div class="container c2 metric">
                        <h3>{{$totalNewSignUps}}</h3>
                        <h4>New Signups</h4>
                        <p>{{ abs($newSignUpsPercentageChange) }}% {{ $newSignUpsPercentageChange >= 0 ? 'Increase' : 'Decrease' }} from Last Week</p>
                    </div>
                    <div class="container c3 metric">
                        <h3>{{$technicianVerified}}</h3>
                        <h4>Verified Repairshops</h4>
                        <p>{{ abs($verifiedChange) }}% {{ $verifiedChange >= 0 ? 'Increase' : 'Decrease' }} from Last Week</p>
                    </div>
                    <div class="container c4 metric">
                        <h3>{{$totalReports}}</h3>
                        <h4>Reported Issues</h4>
                        <p>{{ abs($reportPercentageChange) }}% {{ $reportPercentageChange >= 0 ? 'Increase' : 'Decrease' }} from Last Week</p>
                    </div>
                    <div class="container c5 metric">
                        <h3>{{$totalCurrentPending}}</h3>
                        <h4>Pending Approvals</h4>
                        <p>{{ abs($pendingApprovalsPercentageChange) }}% {{ $pendingApprovalsPercentageChange >= 0 ? 'Increase' : 'Decrease' }} from Last Week</p>
                    </div>

                    <div class="container c6">
                        <div class="user-card">
                            <!-- First User Card -->
                            <i class="fa-solid fa-user"></i>
                            <h3>Customer</h3>
                            <div class="user-status">
                                <span class="status inactive">
                                    <p>Verified</p>
                                    <h4>{{$customerVerified}}</h4>
                                </span>|
                                <span class="status active">
                                    <p>Restricted</p>
                                    <h4>{{$customerRestricted}}</h4>
                                </span>
                            </div>                            
                        </div>

                        <div class="user-card">
                            <!-- Second User Card -->
                            <i class="fa-solid fa-user-nurse"></i>
                            <h3>Technician</h3>
                            <div class="user-status">
                                <span class="status pending">
                                    <p>Verified</p>
                                    <h4>{{$technicianVerified}}</h4>
                                </span>|
                                <span class="status restricted">
                                    <p>Restricted</p>
                                    <h4>{{$technicianRestricted}}</h4>
                                </span>
                            </div>                            
                        </div>
                    </div>

                    <div class="container c7">
                        <!-- Reports -->
                        <div class="card">
                            <!-- <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div> -->

                            <div class="card-body">
                                <h5 class="card-title">Reports</h5>

                                <!-- Line Chart -->
                                <div id="reportsChart"></div>

                                <script>

                                    
                                    const chartData = {!! json_encode($chartData) !!};

                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                            series: [
                                                    {
                                                        name: "Appointments",
                                                        // data: [31, 40, 28, 51, 42, 82, 56],
                                                        data: chartData.appointments,
                                                    },
                                                    {
                                                        name: "Repairs",
                                                        // data: [11, 32, 45, 32, 34, 52, 41],
                                                        data: chartData.repairs,
                                                    },
                                                    {
                                                        name: "Customers",
                                                        // data: [15, 11, 32, 18, 9, 24, 11],
                                                        data: chartData.customers,
                                                    },
                                            ],
                                            chart: {
                                                    height: 350,
                                                    type: "area",
                                                    toolbar: {
                                                        show: false,
                                                    },
                                            },
                                            markers: {
                                                    size: 4,
                                            },
                                            colors: ["#4154f1", "#2eca6a", "#ff771d"],
                                            fill: {
                                                    type: "gradient",
                                                    gradient: {
                                                        shadeIntensity: 1,
                                                        opacityFrom: 0.3,
                                                        opacityTo: 0.4,
                                                        stops: [0, 90, 100],
                                                    },
                                            },
                                            dataLabels: {
                                                    enabled: false,
                                            },
                                            stroke: {
                                                    curve: "smooth",
                                                    width: 2,
                                            },
                                            xaxis: {
                                                    type: "datetime",
                                                    categories: chartData.categories,
                                                    // categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"],
                                            },
                                            tooltip: {
                                                    x: {
                                                        format: "dd/MM/yy HH:mm",
                                                    },
                                            },
                                        }).render();
                                    });
                                </script>
                                <!-- End Line Chart -->
                            </div>
                        </div>
                        <!-- End Reports -->
                    </div>


                    <div class="container c8">
                        <div class="container-header">
                            <h3>Recent Notification</h3>
                            <a href=""><i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                        
                        <div class="notification-item">
                            <div class="notification-header">
                                <div class="left">
                                    <div class="title">
                                        {{$latestNotification->title}}
                                    </div>
                                    <div class="sub-title">
                                        Sent to: 
                                        <span>{{$latestNotification->target_type}}</span> |
                                        <span>{{$latestNotification->target_user}}</span> |
                                        <span>{{$latestNotification->created_at->format('D m, Y, h:i A')}}</span>
                                    </div>                                
                                </div>

                                <div class="right">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="{{ asset('js/Admin/1 - Dashboard.js') }}"></script>
    <script src="{{ asset('js/Admin/admin-navbars.js') }}"></script>

    <script src="{{ asset('js/Admin/chart.umd.js') }}"></script>
    <script src="{{ asset('js/Admin/echarts.min.js') }}"></script>
    <script src="{{ asset('js/Admin/apexcharts.min.js') }}"></script>

</body>
</html>
