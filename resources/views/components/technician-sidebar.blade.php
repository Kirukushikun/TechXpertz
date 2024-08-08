@section('sidebar')
<aside class="sidebar-main">

    <nav>
        <div class="logo">
            <h2>Tech<span>X</span>pertz</h2>
        </div>

        <ul>
            <li><a href="/6"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="/7"><i class="fas fa-calendar-alt"></i> Appointment</a></li>
            <li><a href="/8"><i class="fas fa-tools"></i> Repair Status</a></li>
            <li><a href="/9"><i class="fas fa-user"></i> Messages</a></li>
            <li><a href="/10"><i class="fas fa-star"></i> Shop Reviews</a></li>
            <li><a href="/11"><i class="fas fa-user-cog"></i> Manage Profile</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
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