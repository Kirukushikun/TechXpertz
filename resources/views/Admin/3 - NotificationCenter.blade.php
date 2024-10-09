@include('components.admin-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="{{ asset('css/Admin/3 - NotificationCenter.css') }}">
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
                    <h1>Notification Center</h1>
                </div>

                <div class="content">
                    
                    <form class="form-notification card">
                        <div class="form-group">
                            <label for="target-type">Target Type</label>
                            <select id="target-type">
                                <option value="Public">Public</option>
                                <option value="Technicians">Technicians</option>
                                <option value="Customers">Customers</option>
                            </select>
                        </div>

                        <div class="form-section">
                            <div class="form-group">
                                <label for="target-user">Target User</label>
                                <select id="target-user">
                                    <option value="All">All</option>
                                    <option value="Technicians">Technician</option>
                                    <option value="Customers">Customer</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="target-id">Target ID</label>
                                <input type="text" id="target-id" placeholder="">
                            </div>                            
                        </div>

                
                        <div class="form-group">
                            <label for="title">Notification Title</label>
                            <input type="text" id="title" placeholder="Enter notification title">
                        </div>

                        <div class="form-group">
                            <label for="message">Notification Message</label>
                            <textarea id="message" rows="5" placeholder="Enter your message"></textarea>
                        </div>
                
                        <!-- Send Notification Button -->
                        <button type="submit" class="notification-btn">Send Notification</button>
                    </form>

                    <div class="user-reference card">

                        <div class="tab-filters">
                            <li><button><i class="fa-solid fa-filter"></i> Filter</button></li>
                            <li><i class="fa-solid fa-magnifying-glass" id="search"></i> <input type="text" placeholder="search"></li>
                        </div>

                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#1234</td>
                                    <td>Iverson Craig Guno</td>
                                    <td>
                                        Iversoncraigg@gmail.com
                                    </td>
                                    <td>
                                        Technician
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="notification-history card">
                    <h2>Notification History</h2>
                    <div class="notification-item">
                        <div class="notification-header">
                            <div class="left">
                                <div class="title">
                                    System Maintenance
                                </div>
                                <div class="sub-title">
                                    Sent to: 
                                    <span>Technician</span> |
                                    <span>Target ID: #123</span> |
                                    <span>Wed, 04 Oct 2024, 09:30 AM</span>
                                </div>                                
                            </div>

                            <div class="right">
                                <a href=""><i class="fa-regular fa-pen-to-square"></i></a>
                                <a href=""><i class="fa-regular fa-trash-can"></i></a>
                            </div>
                        </div>
                        <div class="notification-content">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam eaque non dicta fugiat sapiente perferendis aliquam expedita excepturi delectus unde. Quod tenetur sapiente recusandae nostrum non quibusdam provident rerum praesentium.
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="{{ asset('js/Admin/admin-navbars.js') }}"></script>
</body>
</html>
