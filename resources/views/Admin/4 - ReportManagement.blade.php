@include('components.admin-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Manager</title>
    <link rel="stylesheet" href="{{ asset('css/Admin/4 - ReportManagement.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Admin/admin-sidebar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="dashboard">

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
                    <h1>Report Management</h1>
                    
                    <div class="tab-filters">
                        <li><button><i class="fa-solid fa-filter"></i>Filter</button></li>
                        <li><i class="fa-solid fa-magnifying-glass" id="search"></i> <input type="text" placeholder="search"></li>
                        <a class="add-repair"><i class="fa-solid fa-plus" id="add-appointment"></i></a>
                    </div>
                </div>
                <!-- <div class="sub-header">
                    <div class="report-card">
                        Total Reports
                    </div>
                    <div class="report-card">
                        Resolved Reports
                    </div>
                    <div class="report-card">
                        Pending Reports
                    </div>
                    <div class="report-card">
                        Escalated Reports
                    </div>
                </div> -->
                <div class="body">
                    <ul class="tabs">
                        <div class="tab-navigation">
                            <li class="tab-link" data-tab="all-users">All Users</li>
                            <li class="tab-link active" data-tab="user-customer">Customers</li>
                            <li class="tab-link" data-tab="user-technician">Technicians</li>
                        </div>

                        <div class="tab-summary">
                            <p>Total Reports: 82</p>
                            <p>Resolved Reports: 190</p>
                            <p>Pending Reports: 200</p>
                            <p>Escalated Reports: 320</p>
                        </div>
                    </ul>

                    <div class="tab-content">
                        <!-- All Users -->
                        <div id="all-users" class="tab-content-item card">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Report ID</th>
                                        <th>Name</th>
                                        <th>User Type</th>
                                        <th>Issue</th>
                                        <th>Status</th>
                                        <th>Date Submitted</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#12345</td>
                                        <td>Ishi Robles</td>
                                        <td>Customer</td>
                                        <td>
                                            Issue with service
                                        </td>
                                        <td>
                                            <input type="text" value="Resolved">
                                        </td>
                                        <td>
                                            Oct 31, 2003, 10:00 AM
                                        </td>
                                        <td>
                                            View
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Customers -->
                        <div id="user-customer" class="tab-content-item card active">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Report ID</th>
                                        <th>Name</th>
                                        <th>Issue</th>
                                        <th>Status</th>
                                        <th>Date Submitted</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#12345</td>
                                        <td>Ishi Robles</td>
                                        <td>
                                            Issue with service
                                        </td>
                                        <td>
                                            <input type="text" value="Resolved">
                                        </td>
                                        <td>
                                            Oct 31, 2003, 10:00 AM
                                        </td>
                                        <td>
                                            View
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="pagination">
                                <a href="#"><i class="fa-solid fa-caret-left"></i></a>
                                <a href="#" class="active">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#">...</a>
                                <a href="#"><i class="fa-solid fa-caret-right"></i></a>
                            </div>                            
                        </div>

                        <!-- Technician -->
                        <div id="user-technician" class="tab-content-item card">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Report ID</th>
                                        <th>Name</th>
                                        <th>Issue</th>
                                        <th>Status</th>
                                        <th>Date Submitted</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#12345</td>
                                        <td>Ishi Robles</td>
                                        <td>
                                            Issue with service
                                        </td>
                                        <td>
                                            <input type="text" value="Resolved">
                                        </td>
                                        <td>
                                            Oct 31, 2003, 10:00 AM
                                        </td>
                                        <td>
                                            View
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

    <script src="{{ asset('js/Admin/2 - UserManagement.js') }}"></script>
    <script src="{{ asset('js/Admin/admin-navbars.js') }}"></script>
</body>
</html>
