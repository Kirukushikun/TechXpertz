@include('components.technician-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechXpertz</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/Technician/technician-sidebar.css')}}">

    <link rel="stylesheet" href="{{asset('css/Technician/7 - Notification.css')}}">
</head>
<body>
    <div class="dashboard">

        @yield('sidebar')
        
        <main class="main-content">
            <header>
                <h1>Notifications</h1>
                <div class="technician-name">
                    @php
                        $technician = Auth::guard('technician')->user();
                    @endphp
                    <h3>Hi, <span>{{$technician->firstname}}.</span></h3>
                </div>
            </header>

            
            <div class="notification">
                <div class="notification-header">
                    <div class="left">
                        <div class="notification-icon">
                            <i class="fa-solid fa-bell"></i>
                        </div>
                        <div class="notification-details">
                            <span class="notification-title">Welcome to TechXpertz!</span>
                            <span class="notification-date">Jan 20, 2024</span>
                        </div>                        
                    </div>
                </div>

                <div class="notification-body">
                    <div class="notification-message">
                        <p>
                            We're excited to have you on board as a valued member of our community of expert technicians. To make the most of your experience, let's get your profile fully set up so you can start connecting with customers and showcasing your skills. Below is your personalized checklist to guide you through the essential steps to complete your profile and unlock all the features of TechXpertz.
                        </p>
                    </div>
                    <div class="notification-checklist">
                        <ul>
                            <li><i class="fa-solid fa-circle"></i> Basic Information</li>
                            <li><i class="fa-solid fa-circle"></i> Repair Shop Badges</li>
                            <li><i class="fa-solid fa-circle"></i> Specializations</li>
                            <li><i class="fa-solid fa-circle"></i> Operating Hours</li>
                            <li><i class="fa-solid fa-circle"></i> Services Offered</li>
                            <li><i class="fa-solid fa-circle"></i> Profile Verification</li>
                        </ul>
                    </div>
                </div>
            </div>

            @foreach($combinedNotifications as $notification)
            <div class="notification">
                <div class="notification-header">
                    <div class="left">
                        <div class="notification-icon">
                            <i class="fa-solid fa-bell"></i>
                        </div>
                        <div class="notification-details">
                            <span class="notification-title">{{$notification->title}}</span>
                            <span class="notification-date">{{$notification->formatted_date}}</span>
                        </div>                        
                    </div>
                    <div class="right">
                        <form action="{{ route('notifications.isread', ['id' => $notification->id]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            
                            @if($notification->is_read)
                                <button style="color: #999" disabled>
                                    <i class="fa-solid fa-envelope-open-text"></i>Marked as Read
                                </button>
                            @else
                                <button type="submit" style="cursor:pointer;">
                                    <i class="fa-solid fa-envelope"></i>Mark as Read
                                </button>
                            @endif
                        </form>
                    </div>
                </div>

                <div class="notification-body">
                    <div class="notification-message">
                        <p>
                            {{$notification->message}}
                        </p>
                    </div>
                    <div class="notification-checklist">
                        <!-- OPTIONAL CONTAINER -->
                    </div>
                </div>
            </div>
            @endforeach

            <!-- <div class="notification">
                <div class="notification-header">
                    <div class="notification-icon">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <div class="notification-details">
                        <span class="notification-title">Explore Your Dashboard</span>
                        <span class="notification-date">Jan 20, 2024</span>
                    </div>
                </div>

                <div class="notification-body">
                    <div class="notification-message">
                        <p>
                            You now have access to your dashboard! Explore the available features, but don’t forget to complete your profile to unlock all functionalities and improve your visibility to customers.
                        </p>
                    </div>
                    <div class="notification-checklist">
                        
                    </div>
                </div>
            </div>

            <div class="notification">
                <div class="notification-header">
                    <div class="notification-icon">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <div class="notification-details">
                        <span class="notification-title">Profile Approved – Full Access Granted</span>
                        <span class="notification-date">Jan 20, 2024</span>
                    </div>
                </div>

                <div class="notification-body">
                    <div class="notification-message">
                        <p>
                        Congratulations! Your profile has been verified, and you now have full access to all features. Start managing appointments, updating repair statuses, and connecting with customers.
                        </p>
                    </div>
                    <div class="notification-checklist">
                        
                    </div>
                </div>
            </div> -->

            <!-- <div class="notification">
                <div class="notification-header">
                    <div class="notification-icon">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <div class="notification-details">
                        <span class="notification-title">Need Help? We’re Here for You!</span>
                        <span class="notification-date">Jan 20, 2024</span>
                    </div>
                </div>

                <div class="notification-body">
                    <div class="notification-message">
                        <p>
                            You’re just a few steps away from completing your profile. Adding your badges, specialization, working hours, and services can significantly boost your visibility. Let’s finish setting up!
                        </p>
                    </div>
                    <div class="notification-checklist">
                        
                    </div>
                </div>
            </div> -->

            <!-- <div class="notification">
                <div class="notification-header">
                    <div class="notification-icon">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <div class="notification-details">
                        <span class="notification-title">New Feature Alert!</span>
                        <span class="notification-date">Jan 20, 2024</span>
                    </div>
                </div>

                <div class="notification-body">
                    <div class="notification-message">
                        <p>
                        We’ve added a new feature to help you manage your shop more efficiently. Check it out on your dashboard and start using it today!
                        </p>
                    </div>
                    <div class="notification-checklist">
                        
                    </div>
                </div>
            </div> -->

            <!-- <div class="notification">
                <div class="notification-header">
                    <div class="notification-icon">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <div class="notification-details">
                        <span class="notification-title">Profile Verification in Progress</span>
                        <span class="notification-date">Jan 20, 2024</span>
                    </div>
                </div>

                <div class="notification-body">
                    <div class="notification-message">
                        <p>
                        We’re currently reviewing your profile. This process might take some time. You’ll be notified once your profile is verified and fully activated.
                        </p>
                    </div>
                    <div class="notification-checklist">
                    </div>
                </div>
            </div> -->
            

        </main>

    </div>
    
    <script src="{{asset('js/Technician/5 - ShopReviews.js')}}"></script>
    <script src="{{asset('js/Technician/technician-sidebar.js')}}"></script>
</body>
</html>
