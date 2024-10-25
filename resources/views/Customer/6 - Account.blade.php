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
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-modal.css') }}">
    </head>
    <body id="main-body">

        @if(session()->has('error'))
            <div class="push-notification danger active">
                <i class="fa-solid fa-bell danger"></i>
                <div class="notification-message">
                    <h4>{{session('error')}}</h4>
                    <p>{{session('error_message')}}</p>
                </div>
                <i class="fa-solid fa-xmark" id="close-notification"></i>
            </div>
        @elseif(session()->has('success'))
            <div class="push-notification success active">
                <i class="fa-solid fa-bell success"></i>
                <div class="notification-message">
                    <h4>{{session('success')}}</h4>
                    <p>{{session('success_message')}}</p>
                </div>
                <i class="fa-solid fa-xmark" id="close-notification"></i>
            </div>
        @endif

        <div class="modal" id="modal">

        </div>

        @yield('header')    

        <div class="appointment-form">

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
                <form action="{{ route('customer.updateprofile', ['actionType' => 'update', 'customerID' => $customerData->id]) }}" id="account-settings" class="form-section" method="POST">
                    @csrf
                    @method('PATCH')
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
                            <button type="button" class="upload-image submit" data-customer-id="{{$customerData->id}}" data-action="upload">Change picture</button>
                            @else
                            <button type="button" class="upload-image submit" data-customer-id="{{$customerData->id}}" data-action="upload">Upload picture</button>
                            @endif
                            <button type="button" class="upload-image normal" data-customer-id="{{$customerData->id}}" data-action="delete">Delete picture</button>
                        </div>
                    </div>

                    <div class="form-container">
                        
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" value="{{$customerData->firstname}}" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" value="{{$customerData->lastname}}" required>
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
                        <label for="current_password">Current Password</label>
                        <input type="password" id="current_password" name="current_password">
                    </div>  
                                      
                    <div class="form-container">
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" id="new_password" name="new_password">
                        </div>
                        <div class="form-group">
                            <label for="new_password_confirmation">Confirm New Password</label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation">
                        </div>                        
                    </div>
                    
                    <div id="form-action" class="form-action">
                        <button type="submit" class="submit-btn submit">SAVE CHANGES</button>
                    </div>
                    
                </form>

                <!-- Notifications Section -->
                <div id="notifications" class="form-section">
                    <h2>Notifications</h2>

                    @if($notifications->isNotEmpty())
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
                                        <div class="notification-action">
                                            @if($notification->is_read)
                                                <button style="color: #999" disabled>
                                                    <i class="fa-solid fa-envelope-open-text"></i>Marked as Read
                                                </button>
                                            @else
                                                <button class="submit" data-notification-id="{{$notification->id}}" type="submit" style="cursor:pointer;">
                                                    <i class="fa-solid fa-envelope"></i>Mark as Read
                                                </button>
                                            @endif
                                        </div>
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
                    @else
                        <div class="empty">
                            <i class="fa-solid fa-bell"></i>
                            <p>You have no notifications yet</p>
                        </div>                    
                    @endif
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

                    <div class="delete-action" id="delete-action">
                        <button class="submit-btn danger">DELETE ACCOUNT</button>
                    </div>
                </div>
            </div>
        </div>

        @yield('footer')

    </body>

    <!-- SIDEBAR FUNCTION -->
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

    <!-- PREVIEW IMAGE FUNCTION -->
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

    <!-- UPLOAD IMAGE FUNCTION -->
    <script>
        let uploadImage = document.querySelectorAll('button.upload-image');
        let modal = document.getElementById('modal');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        uploadImage.forEach(button => {
            button.addEventListener('click', function(){
                let customerID = this.getAttribute('data-customer-id');
                let actionType = this.getAttribute('data-action');
                
                if(actionType == 'upload'){
                    modal.innerHTML = `                    
                        <form class="modal-content" action="/customer/myaccount/${actionType}/${customerID}"  method="POST" enctype="multipart/form-data">

                            <input type="hidden" name="_token" value="${csrfToken}">
                            <input type="hidden" name="_method" value="PATCH">

                            
                            <div class="image-upload">
                                <h2>Upload Your Image</h2>
                                <label for="file-input" class="upload-label">
                                    <img id="preview" src="{{ asset('images/image-upload.png') }}" alt="Image Preview">
                                    
                                </label>
                                <input id="file-input" type="file" name="image" onchange="previewImage(event)" />
                            </div>
                            <div class="modal-action">
                                <button type="submit" class="submit">Save</button>  
                                <button type="button" class="close normal">Dismiss</button> 
                            </div>
                        </form>
                    `;                    
                }else if(actionType == 'delete'){
                    modal.innerHTML = `
                        <form action="/customer/myaccount/${actionType}/${customerID}" method="POST">
                            <input type="hidden" name="_token" value="${csrfToken}">
                            <input type="hidden" name="_method" value="PATCH">

                            <div class="modal-verification">
                                <i class="fa-solid fa-triangle-exclamation" id="repair"></i>
                                <div class="verification-message">
                                    <h2>Delete Profile</h2>
                                    <p>Are you sure you want to Delete your picture?</p>                        
                                </div>
                                <div class="verification-action">
                                    <button type="submit" class="submit">Delete Picture</button>
                                    <button type="button" class="close normal"><b>Dismiss</b></button>
                                </div>
                            </div>                 
                        </form>
                    `;
                }

                modal.classList.add('active');

                document.querySelector('.close').onclick = function () {
                    modal.classList.remove('active');
                };
            })
        });
    </script>

    <!-- DISPLAYS SAVE BUTTON FOR EVERY CHANGES DETECTED -->
    <script>
        let profileSettings = document.getElementById('account-settings');
        let inputs = profileSettings.querySelectorAll('input');

        inputs.forEach(input => {
            input.addEventListener('input', function(){
                displaySaveChanges();
            });
        });

        function displaySaveChanges(){
            document.getElementById('form-action').classList.add('active');
        }
    </script>

    <script>
        document.querySelectorAll('.notification-action').forEach(notificationElement => {
            const markAsReadButton = notificationElement.querySelector('.submit');
            
            if (!markAsReadButton) return;  // Early return if no button is found
            
            const notificationID = markAsReadButton.getAttribute('data-notification-id');
            
            markAsReadButton.addEventListener('click', () => {
                // Disable the button to prevent multiple requests
                markAsReadButton.disabled = true;

                updateNotification(notificationID);

                // Change the button appearance after marking as read
                markAsReadButton.innerHTML = `
                    <button style="color: #999" class="marked-as-read" disabled>
                        <i class="fa-solid fa-envelope-open-text"></i>Marked as Read
                    </button>
                `;
                
                console.log(`Notification ID: ${notificationID}`);
            });
        });

        function updateNotification(notificationID) {
            fetch(`/customer/myaccount/notification/update/${notificationID}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                }
            })
            .then(response => {
                if (response.ok) {
                    console.log('Notification marked as read successfully');
                } else {
                    console.log('Failed to mark notification as read');
                }
            })
            .catch(error => {
                console.error('There was an error with the request:', error);
            });
        }
    </script>


    <script src="{{asset('js/Customer/customer-notification.js')}}"></script>
</html>