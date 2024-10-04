@include('components.admin-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="{{ asset('css/Admin/2 - UserManagement.css') }}">
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

                <nav>
                    <ul>
                        <li>Dashboard</li>
                        <li class="active">User Management</li>
                        <li>Notification Center</li>
                        <li>Messages Center</li>
                        <li>Reviews Management</li>
                        <li>System Settings</li>
                        <li>Reports & Analytics</li>
                    </ul>                    
                </nav>

            </div>
            <div class="body">
                <div class="header">
                    <h1>User Management</h1>
                    
                    <div class="tab-filters">
                        <li><button><i class="fa-solid fa-filter"></i>Filter</button></li>
                        <li><i class="fa-solid fa-magnifying-glass" id="search"></i> <input type="text" placeholder="search"></li>

                        <a class="add-repair"><i class="fa-solid fa-plus" id="add-appointment"></i></a>
                    </div>
                </div>
                <div class="body">
                    <ul class="tabs">
                        <div class="tab-navigation">
                            <li class="tab-link active" data-tab="user-customer">Customers</li>
                            <li class="tab-link" data-tab="user-technician">Technicians</li>
                        </div>
                    </ul>

                    <div class="tab-content">
                        <div id="user-customer" class="tab-content-item card active">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Account Status</th>
                                        <th>Status</th>
                                        <th>Details</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Iverson Guno</td>
                                        <td>Iversoncraigg@gmail.com</td>
                                        <td>
                                            Verified
                                        </td>
                                        <td>
                                            <input type="text" value="Active">
                                        </td>
                                        <td>
                                            <button>View</button>
                                        </td>
                                        <td>

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

                        <div id="user-technician" class="tab-content-item card">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Account Status</th>
                                        <th>Status</th>
                                        <th>Details</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Ishi Robles</td>
                                        <td>Ishirobless@gmail.com</td>
                                        <td>
                                            Verified
                                        </td>
                                        <td>
                                            <input type="text" value="Active">
                                        </td>
                                        <td>
                                            <button>View</button>
                                        </td>
                                        <td>

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
</body>
</html>
