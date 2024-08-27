@section('sidebar')
<aside class="sidebar-main">

    <nav>
        <div class="logo">
            <h2>Tech<span>X</span>pertz</h2>
        </div>

        <ul>
            <li><a href="/admin/dashboard"><i class="fa-solid fa-table-columns"></i>Dashboard</a></li>
            
            <!-- User Management -->
            <li><a href="/admin/customers"><i class="fas fa-users"></i>Manage Customers</a></li>
            <li><a href="/admin/technicians"><i class="fas fa-user-wrench"></i>Manage Technicians</a></li>
            <li><a href="/admin/admins"><i class="fas fa-user-shield"></i>Manage Admins</a></li>

            <!-- Repair Shop Management -->
            <li><a href="/admin/repairshops"><i class="fas fa-store"></i>Manage Repair Shops</a></li>
            <li><a href="/admin/appointments"><i class="fas fa-calendar-check"></i>Appointment Management</a></li>

            <!-- Notifications and Messaging -->
            <li><a href="/admin/notifications"><i class="fa-solid fa-bell"></i>Notifications</a></li>
            <li><a href="/admin/messages"><i class="fa-solid fa-message"></i>Messaging</a></li>

            <!-- Review and Rating Management -->
            <li><a href="/admin/reviews"><i class="fas fa-star"></i>Review Management</a></li>

            <!-- System Settings -->
            <li><a href="/admin/settings"><i class="fas fa-cog"></i>System Settings</a></li>
            
            <!-- Reporting and Analytics -->
            <li><a href="/admin/reports"><i class="fas fa-chart-bar"></i>Reports & Analytics</a></li>
        </ul>
    </nav>

    <div class="sidebar-footer">
        <button class="logout">LOG OUT</button>
        
        <div class="dark-mode">
            <span>Dark mode</span>
            <label class="switch">
                <input type="checkbox" id="dark-mode-toggle">
                <span class="slider round"></span>
            </label>                    
        </div>
    </div>

</aside>
@endsection
