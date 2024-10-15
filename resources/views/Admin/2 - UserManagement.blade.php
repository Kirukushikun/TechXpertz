@include('components.admin-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="{{ asset('css/Admin/2 - UserManagement.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Admin/admin-sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Admin/admin-modal.css') }}">
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
                            <li class="tab-link active" data-tab="all-users">All Users</li>
                            <li class="tab-link" data-tab="user-customer">Customers</li>
                            <li class="tab-link" data-tab="user-technician">Technicians</li>
                        </div>

                        <div class="tab-summary">
                            <p>Total Users: {{$totalUsers}}</p>
                            <p>Total Customers: {{$customer->count()}}</p>
                            <p>Total Technicians: {{$technician->count()}}</p>
                        </div>
                    </ul>

                    <div class="tab-content">
                        <div id="all-users" class="tab-content-item card active">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Account Status</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Ishi Robles</td>
                                        <td>Ishirobless@gmail.com</td>
                                        <td>Customer</td>
                                        <td>
                                            Verified
                                        </td>
                                        <td>
                                            <input type="text" value="Active">
                                        </td>
                                        <td>
                                            <button>Manage</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>                        

                        <div id="user-customer" class="tab-content-item card">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Account Status</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customer as $user)
                                    <tr>
                                        <td>{{$user->firstname}} {{$user->lastname}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            Verified
                                        </td>
                                        <td>
                                            <input type="text" value="Active">
                                        </td>
                                        <td>
                                            <button>Manage</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
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
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($technician as $user)
                                    <tr>
                                        <td>{{$user->firstname}} {{$user->middlename ?? ''}} {{$user->lastname}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            @if($user->profile_status == 'complete')
                                                verified
                                            @else
                                                {{$user->profile_status}}
                                            @endif
                                        </td>
                                        <td>
                                            <input type="text" value="Active">
                                        </td>
                                        <td>
                                            <button>Manage</button>
                                        </td>
                                    </tr>
                                    @endforeach
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
    <script src="{{ asset('js/Admin/admin-modal.js') }}"></script>
</body>
</html>
