@include('components.header-footer')
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TechXpertz</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('css/Customer/header-footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/6 - Account.css') }}">
    </head>
    <body>

        @yield('header')    

        <form class="appointment-form">

            <div class="right">
                <div class="upper">
                    <div class="profile-container">
                        <div class="form-group">
                            <div class="image"></div>
                            <h3>{{$customerData->firstname}} {{$customerData->lastname}}</h3>
                            <p>{{$customerData->email}}</p>
                        </div>                 
                    </div>
                    <div class="profile-navigation">
                        <ul>
                            <li><a href="#" class="active">Personal Information</a></li>
                            <li><a href="#">Account Settings</a></li>
                            <li><a href="#">Notifications</a></li>
                            <li><a href="#">Privacy</a></li>
                        </ul>
                    </div>                                        
                </div>

                <button class="logout-button" onclick="window.location.href='{{route('customer.logoutCustomer')}}'">Log Out</button>
            </div>
        
            <div class="left">
                <div id="personal-information" class="form-section">
                    <h2>Personal Information</h2>
                    <div class="form-group">
                        <label for="first-name">First Name</label>
                        <input type="text" id="first-name" name="first-name">
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last Name</label>
                        <input type="text" id="last-name" name="last-name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="phone">Mobile Phone Number</label>
                        <input type="tel" id="phone" name="phone">
                    </div>
                </div>

                <div id="account-settings" class="form-section">
                    <h2>Change Password</h2>
                    <div class="form-group">
                        <label for="current-password">Current Password</label>
                        <input type="password" id="current-password" name="current-password">
                    </div>
                    <div class="form-group">
                        <label for="new-password">New Password</label>
                        <input type="password" id="new-password" name="new-password">
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm New Password</label>
                        <input type="password" id="confirm-password" name="confirm-password">
                    </div>
                </div>

                <!-- Notifications Section -->
                <div id="notifications" class="form-section" style="display:none;">
                    <h2>Notifications</h2>
                    <!-- Add notification-related fields here -->
                </div>

                <!-- Privacy Section -->
                <div id="privacy" class="form-section" style="display:none;">
                    <h2>Privacy</h2>
                    <!-- Add privacy-related fields here -->
                </div>

                <!-- Billing Section -->
                <div id="billing" class="form-section" style="display:none;">
                    <h2>Billing</h2>
                    <!-- Add billing-related fields here -->
                </div>
            </div>
        </form>

        @yield('footer')

    </body>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const links = document.querySelectorAll('.profile-navigation a');
            const sections = document.querySelectorAll('.left .form-section');

            // Add event listeners to each navigation link
            links.forEach(link => {
                link.addEventListener('click', function (event) {
                    event.preventDefault();

                    // Remove the 'active' class from all links
                    links.forEach(link => link.classList.remove('active'));

                    // Add the 'active' class to the clicked link
                    this.classList.add('active');

                    // Hide all sections
                    sections.forEach(section => section.style.display = 'none');

                    // Show the corresponding section
                    const sectionId = this.textContent.toLowerCase().replace(' ', '-');
                    document.getElementById(sectionId).style.display = 'block';
                });
            });

            // Display the first section by default
            sections[0].style.display = 'block';
        });
    </script>
</html>