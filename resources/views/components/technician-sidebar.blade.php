@section('sidebar')
<aside class="sidebar-main">

    <nav>
        <div class="logo">
            <h2>Tech<span>X</span>pertz</h2>
        </div>

        <ul>
            <li><a href="/technician/notifications"><i class="fa-solid fa-bell"></i>Notifications</a></li>
            <li><a href="/technician/dashboard"><i class="fa-solid fa-table-columns"></i>Dashboard</a></li>
            <!-- <li><a href="/technician/appointment"><i class="fa-solid fa-calendar-day"></i>Appointment</a></li>
            <li><a href="/technician/repairstatus"><i class="fas fa-tools"></i>Repair Status</a></li>
            <li><a href="/technician/messages"><i class="fa-solid fa-message"></i>Messages</a></li>
            <li><a href="/technician/shopreviews"><i class="fas fa-star"></i>Shop Reviews</a></li>
            <li><a href="/technician/profile"><i class="fas fa-user-cog"></i>Manage Profile</a></li>
            <li><a href="#"><i class="fas fa-cog"></i>Settings</a></li> -->
        </ul>
    </nav>

    <div class="sidebar-footer">
        <button class="logout" onclick="window.location.href='{{route('technician.logoutTechnician')}}'">LOG OUT</button>
        
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