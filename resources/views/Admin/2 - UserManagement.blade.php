@include('components.admin-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="icon" href="{{ asset('images/TechXpertz-Icon.ico') }}">
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
                        <!-- <li><button><i class="fa-solid fa-filter"></i>Filter</button></li> -->
                        <li><i class="fa-solid fa-magnifying-glass" id="search"></i> <input type="text" id="search-input" placeholder="search"></li>
                        <!-- <a class="add-repair"><i class="fa-solid fa-plus" id="add-appointment"></i></a> -->
                    </div>
                </div>
                <div class="body">
                    <ul class="tabs">
                        <div class="tab-navigation">
                            <li class="tab-link active" data-tab="all-users" data-table="all-users-table">All Users</li>
                            <li class="tab-link" data-tab="user-customer" data-table="user-customer-table">Customers</li>
                            <li class="tab-link" data-tab="user-technician" data-table="user-technician-table">Technicians</li>
                        </div>

                        <div class="tab-summary">
                            <p>Total Users: {{$totalUsers}}</p>
                            <p>Total Customers: {{$customer->count()}}</p>
                            <p>Total Technicians: {{$technician->count()}}</p>
                        </div>
                    </ul>

                    <div class="tab-content">
                        <div id="all-users" class="tab-content-item card active">
                            <table id="all-users-table">
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
                                    @foreach($allUsers as $user)
                                    <tr>
                                        <td>{{$user->firstname}} {{$user->middlename ?? ''}} {{$user->lastname}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->role}}</td>
                                        <td style="text-transform:capitalize;">
                                            {{$user->profile_status == 'complete' ? 'Verified' : $user->profile_status}}
                                        </td>
                                        <td>
                                            <input type="text" value="Active">
                                        </td>
                                        <td>
                                            <button onclick="window.location.href='{{route('admin.viewprofile', ['userRole' => $user->role,'userID' => $user->id])}}'">Manage</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="pagination">
                            </div>   
                        </div>                        

                        <div id="user-customer" class="tab-content-item card">
                            <table id="user-customer-table">
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
                                            <button onclick="window.location.href='{{route('admin.viewprofile', ['userRole' => $user->role,'userID' => $user->id])}}'">Manage</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="pagination">
                            </div>                            
                        </div>


                        <div id="user-technician" class="tab-content-item card">
                            <table id="user-technician-table">
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
                                        <td style="text-transform:capitalize;">
                                            {{$user->profile_status == 'complete' ? 'Verified' : $user->profile_status}}
                                        </td>
                                        <td>
                                            <input type="text" value="Active">
                                        </td>
                                        <td>
                                            <button onclick="window.location.href='{{route('admin.viewprofile', ['userRole' => $user->role,'userID' => $user->id])}}'">Manage</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination">
                            </div>  
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

    <script src="{{ asset('js/Admin/2 - UserManagement.js') }}" defer></script>
    <script src="{{ asset('js/Admin/admin-navbars.js') }}" defer></script>
    <script src="{{ asset('js/Admin/admin-modal.js') }}" defer></script>
</body>
</html>
