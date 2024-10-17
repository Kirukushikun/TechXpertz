@include('components.header-footer')
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TechXpertz</title>
        <!-- Crucial Part on every forms -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Crucial Part on every forms/ -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('css/Customer/header-footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/6 - Account.css') }}">
    </head>
    <body id="main-body">

        <div class="modal" id="modal">
        </div>

        @yield('header')    

        <form class="appointment-form">

            <div class="right">
                <div class="upper">
                    <div class="profile-navigation">
                        <h2>Settings</h2>
                        <ul>
                            <li><a href="#" data-target="account-settings" class="active">Account Settings</a></li>
                            <li><a href="#" data-target="notifications">Notifications</a></li>
                            <li><a href="#" data-target="privacy-policy">Privacy Policy</a></li>
                            <li><a href="#" data-target="terms-of-service">Terms of Service</a></li>
                            <li><a href="#" data-target="delete-account">Delete Account</a></li>
                        </ul>
                    </div>                                        
                </div>

                <button class="logout-button" onclick="window.location.href='{{route('customer.logoutCustomer')}}'">LOG OUT</button>
            </div>
        
            <div class="left">
                <div id="account-settings" class="form-section">
                    
                    <div class="profile-container">
                        <div class="profile-detail">
                            @if($customerData->image_profile)
                                <div class="image" style="background-image: url('{{ asset($customerData->image_profile) }}');"></div>
                            @else
                                <div class="image"></div>
                            @endif
                            <div class="details">
                                <h3>{{$customerData->firstname}} {{$customerData->lastname}}</h3>
                                <p>{{$customerData->email}}</p>                                
                            </div>
                        </div>
                        
                        <div class="profile-action">
                            @if($customerData->image_profile)
                            <button type="button" class="upload-image submit" data-customer-id="{{$customerData->id}}">Change picture</button>
                            @else
                            <button type="button" class="upload-image submit" data-customer-id="{{$customerData->id}}">Upload picture</button>
                            @endif
                            <button type="button" class="normal">Delete picture</button>
                        </div>
                    </div>

                    <div class="form-container">
                        
                        <div class="form-group">
                            <label for="first-name">First Name</label>
                            <input type="text" id="first-name" name="first-name" value="{{$customerData->firstname}}" required>
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last Name</label>
                            <input type="text" id="last-name" name="last-name" value="{{$customerData->lastname}}" required>
                        </div>                        
                    </div>

                    <div class="form-container">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" value="{{$customerData->email}}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Mobile Phone Number</label>
                            <input type="tel" id="phone" name="phone">
                        </div>                        
                    </div>

                    <div class="line">
                        <div class="lines"> </div>
                        <h3>CHANGE PASSWORD</h3>
                        <div class="lines"> </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="current-password">Current Password</label>
                        <input type="password" id="current-password" name="current-password">
                    </div>  
                                      
                    <div class="form-container">
                        <div class="form-group">
                            <label for="new-password">New Password</label>
                            <input type="password" id="new-password" name="new-password">
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirm New Password</label>
                            <input type="password" id="confirm-password" name="confirm-password">
                        </div>                        
                    </div>
                    
                    <div class="form-action">
                        <button class="submit-btn submit">SAVE CHANGES</button>
                    </div>
                    
                </div>

                <!-- Notifications Section -->
                <div id="notifications" class="form-section">
                    <h2>Notifications</h2>

                    @foreach($notifications as $notification)
                    <div class="notification">
                        <div class="notification-header">
                            <div class="left-header">
                                <div class="notification-icon">
                                    <i class="fa-solid fa-bell"></i>
                                </div>
                                <div class="notification-details">
                                    <span class="notification-title">{{$notification->title}}</span>
                                    <span class="notification-date">{{ $notification->created_at->format('M d, Y, h:i A') }}</span>
                                </div>                        
                            </div>
                            <div class="right-header">
                                <form action="" method="POST">
                                    <button type="submit" style="cursor:pointer;">
                                            <i class="fa-solid fa-envelope"></i>Mark as Read
                                    </button>
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

                </div>

                <!-- Privacy Section -->
                <div id="privacy-policy" class="form-section">
                    <h2>Privacy Policy</h2>
                    <!-- Add privacy-related fields here -->
                </div>

                <div id="terms-of-service" class="form-section">
                    <h2>Terms of Service</h2>
                </div>

                <div id="delete-account" class="form-section">
                    <div class="form-content">
                        <h2>Delete Account</h2>
                        <p>Permanently delete your account. This action is irreversible. All of your data, including your profile, messages, and settings, will be permanently deleted. You will not be able to recover your account once it has been deleted.</p>
                        <ul>
                            <li><strong>Permanent Data Loss:</strong> All of your account data, including posts, messages, settings, and any ongoing or past service history, will be permanently deleted.</li>
                            <li><strong>No Account Recovery:</strong> Once your account is deleted, you will lose all access and will need to create a new account to use our services again.</li>
                            <li><strong>Upcoming or Ongoing Appointments:</strong> If you have any upcoming or ongoing appointments with a repair shop or technician, or an ongoing repair service, account deletion will not proceed. Please complete or cancel all active services before attempting to delete your account.</li>
                        </ul>                          
                    </div>

                    <div class="form-action" id="delete-action">
                        <button class="submit-btn danger">DELETE ACCOUNT</button>
                    </div>
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
                    const sectionId = this.getAttribute('data-target');
                    document.getElementById(sectionId).style.display = 'flex';
                });
            });

            // Display the first section by default
            sections[0].style.display = 'flex';
        });
    </script>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>

    <script>
        let uploadImage = document.querySelector('button.upload-image');
        let modal = document.getElementById('modal');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        uploadImage.addEventListener('click', function(){
            let customerID = this.getAttribute('data-customer-id');

            modal.innerHTML = `
                <form class="modal-content" action="/customer/myaccount/update/${customerID}"  method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="_token" value="${csrfToken}">
                    <input type="hidden" name="_method" value="PATCH">

                    <h2>Upload Your Image</h2>
                    <div class="image-upload">
                        <label for="file-input" class="upload-label">
                            <img id="preview" src="https://via.placeholder.com/150" alt="Image Preview">
                            <div class="upload-text">Click to Upload Image</div>
                        </label>
                        <input id="file-input" type="file" name="image" onchange="previewImage(event)" />
                    </div>
                    <div class="modal-action">
                        <button type="submit" class="submit">Save</button>  
                        <button type="button" class="close normal">Dismiss</button> 
                    </div>
                </form>
            `;

            modal.classList.add('active');

            document.querySelector('.close').onclick = function () {
                modal.classList.remove('active');
            };
        })
    </script>
</html>