@include('components.technician-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechXpertz</title>
    <!-- Crucial Part on every forms -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Crucial Part on every forms/ -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/Technician/technician-sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/Technician/technician-modal.css')}}">
    <link rel="stylesheet" href="{{asset('css/Technician/technician-notification.css')}}">

    <link rel="stylesheet" href="{{asset('css/Technician/8 - AccountSettings.css')}}">
</head>
<body>
    <div class="dashboard">
        <!-- PUSH NOTIFICATION -->
        @if(session()->has('error'))
            <div class="push-notification danger">
                <i class="fa-solid fa-bell danger"></i>
                <div class="notification-message">
                    <h4>{{session('error')}}</h4>
                    <p>{{session('error_message')}}</p>
                </div>
                <i class="fa-solid fa-xmark" id="close-notification"></i>
            </div>
        @elseif(session()->has('success'))
            <div class="push-notification success">
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

        @yield('sidebar')
        

        <div class="main-content">
            <header>
                <h1>Manage Profile</h1>
                <div class="technician-name">
                    @php
                        $technician = Auth::guard('technician')->user();
                    @endphp
                    <h3>Hi, <span>{{$technician->firstname}}.</span></h3>
                </div>
            </header>

            <div class="content">
            <div class="left">
                <div class="upper">
                        <div class="profile-navigation">
                            <h2>Technician Profile</h2>
                            <ul>
                                <li><a href="#" data-target="technician-details" class="active">Personal Information</a></li>
                                <li><a href="#" data-target="change-password">Change Password</a></li>
                                <li><a href="#" data-target="activity-logs">Access Logs</a></li>
                                <li><a href="#" data-target="terms-of-service">Terms of Service</a></li>
                                <li><a href="#" data-target="privacy-policy">Privacy Policy</a></li>
                                <li><a href="#" data-target="report">Report</a></li>
                                <li><a href="#" data-target="delete-account">Delete Account</a></li>
                            </ul>
                        </div>                            
                    </div>
                </div>

                <div class="right">
                    <form id="technician-details" class="form-container active" action="/technician/account/update" method="POST">
                        @csrf 
                        @method('PATCH')
                        <div class="form-header">
                            <div class="profile-detail">
                                <div class="image"></div>
                                <div class="details">
                                    <h3>{{$technician->firstname}} {{$technician->middlename ?? ''}} {{$technician->lastname}}</h3>
                                    <p>{{$technician->email}}</p> 
                                    <span id="complete">{{$technician->profile_status == 'complete' ? 'verified' : $technician->profile_status}}</span>                               
                                </div>
                            </div>
                            
                            <div class="profile-action">
                                <!-- <button class="btn-primary">View picture</button>
                                <button class="btn-normal">Delete picture</button> -->
                            </div>
                        </div>

                        <div class="form-section col-3">
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" id="firstname" name="firstname" value="{{$technician->firstname}}" required>
                            </div>
                            <div class="form-group">
                                <label for="middlename">Middle Name</label>
                                <input type="text" id="middlename" name="middlename" value="{{$technician->middlename ?? ''}}" required>
                            </div> 
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" id="lastname" name="lastname" value="{{$technician->lastname}}" required>
                            </div> 

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="text" id="email" name="email" value="{{$technician->email}}" required>
                            </div>
                            <div class="form-group">
                                <label for="contact_no">Contact No.</label>
                                <input type="text" id="contact_no" name="contact_no" value="{{$technician->contact_no}}" required>
                            </div>
                            <div class="form-group">
                                <label for="educational_background">Educational Background</label>
                                <input type="text" id="educational_background" name="educational_background" value="{{$technician->educational_background}}" required>
                            </div>

                            <div class="form-group">
                                <label for="province">Province</label>
                                <input type="text" id="province" name="province" value="{{$technician->province}}" required>
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" id="city" name="city" value="{{$technician->city}}" required>
                            </div>
                            <div class="form-group">
                                <label for="barangay">Barangay</label>
                                <input type="text" id="barangay" name="barangay" value="{{$technician->barangay}}" required>
                            </div>

                            <div class="form-group">
                                <label for="zip_code">ZIP Code</label>
                                <input type="text" id="zip_code" name="zip_code" value="{{$technician->zip_code}}" required>
                            </div>

                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" id="date_of_birth" name="date_of_birth" value="{{$technician->date_of_birth->format('Y-m-d')}}" required>
                            </div>
                        </div>

                        <div class="form-action">
                            <button type="submit" class="btn-primary">Save Changes</button>
                        </div>
                    </form>

                    <div id="change-password" class="form-container">
                        <form action="/technician/account/password/change" id="change-password-form" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" id="current_password" name="current_password" required>
                            </div>  
                            <br>           
                            <div class="form-section col-2">
                                <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <input type="password" id="new_password" name="new_password" required>
                                </div>
                                <div class="form-group">
                                    <label for="new_password_confirmation">Confirm New Password</label>
                                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
                                </div>                        
                            </div>
                            <br>
                            
                            <div class="form-action">
                                <a href="/technician/password/forgot">Forgot Password?</a>
                                <button type="submit" class="btn-primary">Change Password</button>
                            </div>
                        </form>
                    </div>

                    <div id="activity-logs" class="form-container">
                        <div class="form-header">
                            <h2>Activity Logs</h2>
                        </div>

                        <table>
                            <thead>
                                <tr>
                                    <th>Timestamp</th>
                                    <th>Action</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>IP Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activityLogs as $activityLog)
                                    <tr>
                                        <td>
                                            {{$activityLog->created_at->format('d M, Y')}} <br>
                                            {{$activityLog->created_at->format('h:i A')}}
                                        </td>
                                        <td>{{$activityLog->action}}</td>
                                        <td>{{$activityLog->description}}</td>
                                        <td>{{$activityLog->status}}</td>
                                        <td>{{$activityLog->ip_address}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="terms-of-service" class="form-container">

                    </div>

                    <div id="privacy-policy" class="form-container">

                    </div>

                    <div id="report" class="form-container">
                        <form action="/technician/submit/report" id="submit-report-form" method="POST">
                            @csrf
                            <input type="hidden" id="firstname" name="firstname" value="{{$technician->firstname}}">
                            <input type="hidden" id="lastname" name="lastname" value="{{$technician->lastname}}">
                            <input type="hidden" id="email" name="email" value="{{$technician->email}}">

                            <div class="form-group">
                                <label for="category">Category</label>
                                <select type="category" id="category" name="category" required>
                                    <option value="Account Issues">Account Issues</option>
                                    <option value="Service Management Problems">Service Management Problems</option>
                                    <option value="Customer Interaction Issues">Customer Interaction Issues</option>
                                    <option value="Performance and Usability">Performance and Usability</option>
                                    <option value="Notifications and Alerts">Notifications and Alerts</option>
                                    <option value="Booking and Appointment Issues">Booking and Appointment Issues</option>
                                    <option value="Customer Feedback and Ratings"> Customer Feedback and Ratings</option>
                                    <option value="Content and Profile Management">Content and Profile Management</option>
                                    <option value="Technician Performance">Technician Performance</option>
                                    <option value="Website Performance and Display Issues">User Interface (UI) & User Experience (UX)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sub_category">Sub Category</label>
                                <select type="sub_category" id="sub_category" name="sub_category" required>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Issue Description</label>
                                <textarea name="description" class="description" id="description" cols="25" rows="7" required ></textarea>  
                            </div>

                            <div class="form-action">
                                <button type="submit" class="btn-primary">SUBMIT</button>
                            </div>
                        </form>
                    </div>
                    <div id="delete-account" class="form-container">
                        <div class="form">
                            <h2>Delete Account</h2>
                            <p>Permanently delete your account. This action is irreversible. All of your data, including your profile, messages, and settings, will be permanently deleted. You will not be able to recover your account once it has been deleted.</p>
                            <ul>
                                <li><strong>Permanent Data Loss:</strong> All of your account data, including services offered, appointment history, customer messages, profile information, and settings, will be permanently deleted. You will lose all records related to your work and interactions on this platform.</li>
                                <li><strong>No Account Recovery:</strong> Once your account is deleted, you will lose all access and will need to create a new technician account to provide services again. Deletion is permanent, and previously held data cannot be retrieved.</li>
                                <li><strong>Pending or Active Appointments and Repairs:</strong> If you have any pending or active appointments or repairs with customers, your account deletion request will not proceed. Please make sure to complete, cancel, or settle all ongoing services before attempting to delete your account.</li>
                            </ul>

                            <div class="form-action">
                                <button class="btn-danger" id="delete-account">Delete Account</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const links = document.querySelectorAll('.profile-navigation a');
            const sections = document.querySelectorAll('.right .form-container');

            // Add event listeners to each navigation link
            links.forEach(link => {
                link.addEventListener('click', function (event) {
                    event.preventDefault();

                    // Remove the 'active' class from all links
                    links.forEach(link => link.classList.remove('active'));

                    // Add the 'active' class to the clicked link
                    this.classList.add('active');

                    // Hide all sections
                    sections.forEach(section => section.classList.remove("active"));

                    // Show the corresponding section
                    const sectionId = this.getAttribute('data-target');
                    document.getElementById(sectionId).classList.add("active");
                });
            });
        });
    </script>
    <script>
        let mainCategory = document.getElementById('category');
        let subCategory = document.getElementById('sub_category');
        let subCategoryContents = {
            "Account Issues": [
                "I can't access my account.",
                "My login credentials aren't working.",
                "I forgot my password and can't reset it.",
                "I'm not receiving my account verification email.",
                "My account is locked or disabled.",
                "My profile information isn't updating correctly.",
                "Changes to my contact information aren't saving.",
                "Other"
            ],
            "Service Management Problems": [
                "I can't add or update my services.",
                "Clients see incorrect or outdated schedule options.",
                "My rates aren't displayed accurately.",
                "I can't set or update custom prices for services.",
                "Other"
            ],
            "Customer Interaction Issues": [
                "I'm having trouble with messaging.",
                "My messages to customers aren't going through.",
                "I don't receive notifications for new messages.",
                "Customer contact information is incomplete.",
                "I can't view the customer's full contact details.",
                "The customer's phone number or email is missing.",
                "Customers aren't responding or canceling appointments.",
                "I'm experiencing high rates of no-shows.",
                "Customers frequently reschedule on short notice.",
                "Other"
            ],
            "Performance and Usability": [
                "The website is slow or unresponsive.",
                "Pages take too long to load on my device.",
                "Features are laggy or freeze during use.",
                "The layout or interface is difficult to navigate.",
                "Buttons or menus aren't easy to find.",
                "The mobile view is hard to use.",
                "I'm experiencing errors or glitches.",
                "Error messages pop up unexpectedly.",
                "I encounter frequent bugs or crashes.",
                "Other"
            ],
            "Notifications and Alerts": [
                "I'm not receiving notifications as expected.",
                "I don't get alerts for new bookings or messages.",
                "System notifications are delayed or missing.",
                "The notifications I receive are incorrect or irrelevant.",
                "I get alerts unrelated to my services.",
                "Other"
            ],
            "Booking and Appointment Issues": [
                "I can't view or manage my appointments.",
                "Appointments are missing or duplicated.",
                "Booking confirmations or updates aren't reaching customers.",
                "Customers report they don't get confirmation emails.",
                "Updates to bookings aren't notifying clients.",
                "Booking attempts fail for clients on my profile.",
                "Other"
            ],
            "Customer Feedback and Ratings": [
                "Customer reviews seem inaccurate or inappropriate.",
                "I received an unfair or offensive review.",
                "Reviews from unknown clients appear on my profile.",
                "My overall rating isn't updating correctly.",
                "New reviews aren't affecting my overall rating.",
                "My average rating displays inconsistently across pages.",
                "I need assistance responding to reviews.",
                "I can't reply to feedback on my profile.",
                "My responses to reviews aren't saving.",
                "Other"
            ],
            "Content and Profile Management": [
                "I'm having trouble uploading images or files.",
                "Profile pictures or gallery images aren't uploading.",
                "My profile information isn't displaying correctly.",
                "Bio or description sections show errors.",
                "I need assistance with profile visibility or settings.",
                "My profile doesn't show up in search results.",
                "Other"
            ],
            "Website Performance and Display Issues": [
                "Tables, graphs, or layouts are misaligned.",
                "Content is cut off or overlapping on smaller screens.",
                "I'm experiencing broken links or missing pages.",
                "Some links lead to error pages or are nonfunctional.",
                "Pages load with missing content or images.",
                "I'm having trouble with the website's accessibility.",
                "Text or buttons are difficult to read or interact with.",
                "Other"
            ]
        }


        // Define the function to populate sub-categories
        function populateSubCategories() {
            // Clear any existing options in the sub-category dropdown
            subCategory.innerHTML = '';

            // Get the selected main category value
            let selectedCategory = mainCategory.value;

            // Retrieve the corresponding sub-category list
            let subCategories = subCategoryContents[selectedCategory];

            // Populate sub-category dropdown if there are sub-categories
            if (subCategories) {
                subCategories.forEach(subCat => {
                    let option = document.createElement('option');
                    option.value = subCat;
                    option.textContent = subCat;
                    subCategory.appendChild(option);
                });
            }
        }

        // Add an event listener to the main category dropdown to trigger sub-category update
        mainCategory.addEventListener('change', populateSubCategories);

        // Optionally, call the function initially to set sub-categories on page load
        populateSubCategories();
    </script>

    <script>
        let modal = document.getElementById('modal');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let personalInformationForm = document.getElementById('technician-details');
        let personalInformationAction = personalInformationForm.querySelector('.form-action');
        let personalInformationInputs = personalInformationForm.querySelectorAll('input');

        personalInformationInputs.forEach(input => {
            input.addEventListener('input', function(){
                personalInformationAction.classList.add('active');
            });
        });

        let personalInformationSubmitBtn = personalInformationAction.querySelector('.btn-primary');
        personalInformationSubmitBtn.addEventListener('click', function(event){
            event.preventDefault();
            modal.innerHTML = 
            `
            <div>
                <div class="modal-verification">
                    <i class="fa-solid fa-xmark close icon-close"></i>
                    <i class="fa-regular fa-calendar-check sign-primary"></i>
                    <div class="verification-message">
                        <h2>Confirm Appointment</h2>
                        <p>Are you sure you want to confirm this appointment?</p>
                    </div>
                    <div class="verification-action">
                        <button type="submit" class="btn-primary" id="personal-information">Confirm Appointment</button>
                        <button type="button" class="close btn-normal"><b>Dismiss</b></button>
                    </div>
                </div>                
            </div>
            `;

            document.getElementById('personal-information').addEventListener('click', function(){
                personalInformationForm.submit();
            });

            modal.classList.add('active');

            // Close modal when 'X' is clicked
            document.querySelectorAll('.close').forEach(button => {
                button.onclick = function () {
                    modal.classList.remove("active");
                };
            });
        });

        let changePasswordForm = document.getElementById('change-password-form');
        let changePasswordAction = changePasswordForm.querySelector('.btn-primary');
        let changePasswordInputs = changePasswordForm.querySelectorAll('input');

        changePasswordInputs.forEach(input => {
            input.addEventListener('input', function(){
                changePasswordAction.classList.add('active');
            });
        });

        changePasswordAction.addEventListener('click', function(event){
            event.preventDefault();
            modal.innerHTML = 
            `
            <div>
                <div class="modal-verification">
                    <i class="fa-solid fa-xmark close icon-close"></i>
                    <i class="fa-regular fa-calendar-check sign-primary"></i>
                    <div class="verification-message">
                        <h2>Change Password</h2>
                        <p>Are you sure you want to change your password?</p>
                    </div>
                    <div class="verification-action">
                        <button type="submit" class="btn-primary" id="change-password">Confirm Appointment</button>
                        <button type="button" class="close btn-normal"><b>Dismiss</b></button>
                    </div>
                </div>                
            </div>
            `;

            document.getElementById('change-password').addEventListener('click', function(){
                changePasswordForm.submit();
            });

            modal.classList.add('active');

            // Close modal when 'X' is clicked
            document.querySelectorAll('.close').forEach(button => {
                button.onclick = function () {
                    modal.classList.remove("active");
                };
            });
        });


        let submitReportForm = document.getElementById('submit-report-form');
        let submitReportAction = submitReportForm.querySelector('.btn-primary');
        // let submitReportInputs = changePasswordForm.querySelectorAll('input');
        
        submitReportAction.addEventListener('click', function(event){
            event.preventDefault();
            modal.innerHTML = 
            `
            <div>
                <div class="modal-verification">
                    <i class="fa-solid fa-xmark close icon-close"></i>
                    <i class="fa-regular fa-calendar-check sign-primary"></i>
                    <div class="verification-message">
                        <h2>Submit Report</h2>
                        <p>Are you sure you want to submit your report?</p>
                    </div>
                    <div class="verification-action">
                        <button type="submit" class="btn-primary" id="submit-report">Submit Report</button>
                        <button type="button" class="close btn-normal"><b>Dismiss</b></button>
                    </div>
                </div>                
            </div>
            `;

            document.getElementById('submit-report').addEventListener('click', function(){
                submitReportForm.submit();
            });

            modal.classList.add('active');

            // Close modal when 'X' is clicked
            document.querySelectorAll('.close').forEach(button => {
                button.onclick = function () {
                    modal.classList.remove("active");
                };
            });
        })

        document.getElementById('delete-account').addEventListener('click', function(){
            
            modal.innerHTML = 
            `
            <form action="/technician/account/delete" method="POST">
                <input type="hidden" name="_token" value="${csrfToken}">
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-verification">
                    <i class="fa-solid fa-xmark close icon-close"></i>
                    <i class="fa-regular fa-calendar-check sign-danger"></i>
                    <div class="verification-message">
                        <h2>Account Deletion</h2>
                        <p>Are you sure you want to delete your account?</p>
                    </div>
                    <div class="verification-action">
                        <button type="submit" class="btn-danger">Confirm Deletion</button>
                        <button type="button" class="close btn-normal"><b>Dismiss</b></button>
                    </div>
                </div>                
            </form>
            `;

            document.getElementById('change-password').addEventListener('click', function(){
                changePasswordForm.submit();
            });

            modal.classList.add('active');

            // Close modal when 'X' is clicked
            document.querySelectorAll('.close').forEach(button => {
                button.onclick = function () {
                    modal.classList.remove("active");
                };
            });
        });

    </script>
    <script src="{{asset('js/Technician/technician-sidebar.js')}}" defer></script>
    <script src="{{asset('js/Technician/technician-notification.js')}}" defer></script>
</body>
</html>