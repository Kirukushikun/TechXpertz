@section('sidebar')
<aside class="sidebar">

    <div class="content">
        <nav>
            <ul>
                <li class="active">
                    <a href="/admin/dashboard"><i class="fa-solid fa-table-columns"></i></a>
                </li>
                <li >
                    <a href="/admin/customers"><i class="fas fa-users"></i></a>
                </li>

                <!-- <li>
                    <a href="/admin/technicians"><i class="fas fa-users"></i></a>
                </li>

                <li>
                    <a href="/admin/admins"><i class="fas fa-user-shield"></i></a>
                </li>

                <li>
                    <a href="/admin/repairshops"><i class="fas fa-store"></i></a>
                </li> -->

                <li>
                    <a href="/admin/notifications"><i class="fa-solid fa-bell"></i></a>
                </li>
                <li>
                    <a href="/admin/messages"><i class="fa-solid fa-message"></i></a>
                </li>
                <li>
                    <a href="/admin/reviews"><i class="fas fa-star"></i></a>
                </li>
                <li>
                    <a href="/admin/settings"><i class="fas fa-cog"></i></a>
                </li>
                <li>
                    <a href="/admin/reports"><i class="fas fa-chart-bar"></i></a>
                </li>
            </ul>
        </nav>

        <div class="sidebar-footer">
            <button class="logout">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </button>
            
            <div class="dark-mode">
                <label class="switch">
                    <input type="checkbox" id="dark-mode-toggle">
                    <span class="slider round"></span>
                </label>                    
            </div>
        </div>                
    </div>

</aside>
@endsection


@section('navbar')
<nav class="admin-navbar">
    <ul>
        <li><a href="/admin/dashboard">Dashboard</a></li>
        <li><a href="/admin/usermanagement">User Management</a></li>
        <li><a href="/admin/notificationcenter">Notification Center</a></li>
        <li><a href="/admin/reportmanagement">Report Management</a></li>
        <li><a href="/admin/reviewsmanagement">Reviews Management</a></li>
        <li><a href="">System Settings</a></li>
    </ul>                    
</nav>
@endsection