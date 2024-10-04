@include('components.admin-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/Admin/1 - Dashboard.css') }}">
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
                        <li class="active">Dashboard</li>
                        <li>User Management</li>
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
                    <h1>Dashboard</h1>
                </div>
                <div class="content">
                    <div class="metrics-container">
                        <div class="metric-card website-visits">
                          <h3>213.2k</h3>
                          <p>Website Visits</p>
                          <p>10% Increase from Last Week</p>
                        </div>
                        <div class="metric-card demos-scheduled">
                          <h3>27.2k</h3>
                          <p>Total Users</p>
                          <p>12% Increase from Last Week</p>
                        </div>
                        <div class="metric-card orders-submitted">
                          <h3>941</h3>
                          <p>Total Repairshops</p>
                          <p>16% Decrease from Last Week</p>
                        </div>                        
                        <div class="metric-card new-signups">
                          <h3>5.1k</h3>
                          <p>New Signups</p>
                          <p>3% Decrease from Last Week</p>
                        </div>
                        <div class="metric-card profit-taken">
                          <h3>$54.2k</h3>
                          <p>Active Users</p>
                          <p>12% Decrease from Last Week</p>
                        </div>                        
                    </div>

                    <div class="container">
                        <div class="user-management card">
                            <p>Waiting for verifications</p>
                            <p>Restricted</p>
                        </div>

                        <div class="notification-management card">
                            <p>Notification History</p>
                        </div>                        
                    </div>

                    <div class="container">
                        <div class="messages-center card">
                            <p>Total Messages</p>
                            <p>Unread Messages</p>
                            <p>Reports from Customers and Technicians</p>
                        </div>

                        <div class="reports-analytics card">
                            <p>User statistics</p>
                            <p>Appointment statistics</p>
                            <p>Shop performance</p>
                            <p>Platform Usage</p>
                        </div>                        
                    </div>

                      
                </div>
            </div>
        </main>
    </div>

</body>
</html>
