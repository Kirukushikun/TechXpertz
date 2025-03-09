@include('components.admin-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="icon" href="{{ asset('images/TechXpertz-Icon.ico') }}">
    <!-- Crucial Part on every forms -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Crucial Part on every forms/ -->
    <link rel="stylesheet" href="{{ asset('css/Admin/6 - ViewProfile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Admin/admin-sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Admin/admin-modal.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="dashboard">

        <div class="modal" id="modal">
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
                <div class="content">
                    <div class="left">
                        <div class="upper">
                            <div class="profile-navigation">
                                <h2>Customer Profile</h2>
                                <ul>
                                    <li><a href="#" data-target="customer-details" class="active">Customer Details</a></li>
                                    <li><a href="#" data-target="appointment-monitoring">Appointment Monitoring</a></li>
                                    <li><a href="#" data-target="repair-monitoring">Repair Monitoring</a></li>
                                    <li><a href="#" data-target="ratings-feedback">Ratings & Feedback</a></li>
                                    <li><a href="#" data-target="access-logs">Access Logs</a></li>
                                </ul>
                            </div>                            
                        </div>
                    </div>

                    <div class="right">
                        <div id="customer-details" class="form-container active">
                            <div class="form-header">
                                <div class="profile-detail">
                                    <div class="image" style="background-image: url('{{$customer->image_profile ?? ''}}')"></div>
                                    <div class="details">
                                        <h3>{{$customer->firstname}} {{$customer->lastname}}</h3>
                                        <p>{{$customer->email}}</p> 
                                        <span id="{{$customer->profile_status == 'verified' ? 'complete' : $technician->profile_status}}">{{$customer->profile_status}}</span>        
                                    </div>
                                </div>
                                
                                <div class="profile-action">
                                    <!-- <button class="submit">View picture</button>
                                    <button class="normal">Delete picture</button> -->
                                </div>
                            </div>

                            <div class="form-section col-3">
                                <div class="form-group">
                                    <label for="user-ID">ID</label>
                                    <input type="text" id="user-ID" name="user-ID" value="{{$customer->id}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="first-name">First Name</label>
                                    <input type="text" id="first-name" name="first-name" value="{{$customer->firstname}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="middle-name">Middle Name</label>
                                    <input type="text" id="middle-name" name="middle-name" value="" readonly>
                                </div> 
                                <div class="form-group">
                                    <label for="last-name">Last Name</label>
                                    <input type="text" id="last-name" name="last-name" value="{{$customer->lastname}}" readonly>
                                </div> 

                                <div class="form-group">
                                    <label for="email-address">Email Address</label>
                                    <input type="text" id="email-address" name="email-address" value="{{$customer->email}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="contact-no">Contact No.</label>
                                    <input type="text" id="contact-no" name="contact-no" value="{{$customer->contact}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="province">Province</label>
                                    <input type="text" id="province" name="province" value="{{$customer->province}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="city">City/Municipality</label>
                                    <input type="text" id="city" name="city" value="{{$customer->city}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="barangay">Barangay</label>
                                    <input type="text" id="barangay" name="barangay" value="{{$customer->barangay}}" readonly>
                                </div>

                            </div>
                        </div>


                        <div id="appointment-monitoring" class="form-container">
                            <div class="form-header">
                                <h2>Appointment Monitoring</h2>
                                <div class="tab-filters">
                                    <li><button><i class="fa-solid fa-filter"></i> Filter</button></li>
                                    <li><i class="fa-solid fa-magnifying-glass" id="search"></i> <input type="text" placeholder="search"></li>
                                </div>
                            </div>

                            <table>
                                <thead>
                                    <tr>
                                        <th>Repair Shop</th>
                                        <th>Status</th>
                                        <th>Date Requested</th>
                                        <th>Time Requested</th>
                                        <th>Date Updated</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)
                                        @php 
                                            $repairshop = App\Models\RepairShop_Credentials::where('technician_id', $appointment->technician_id)->first();
                                        @endphp
                                        <tr>
                                            <td>{{$repairshop->shop_name}}</td>
                                            <td>{{$appointment->status}}</td>
                                            <td>{{$appointment->appointment_date->format('D - M d, Y')}}</td>
                                            <td>{{$appointment->appointment_time->format('h:i A')}}</td>
                                            <td>{{$appointment->updated_at->format('D - M d, Y')}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>                        

                        <div id="repair-monitoring" class="form-container">
                            <div class="form-header">
                                <h2>Repair Monitoring</h2>

                                <div class="tab-filters">
                                    <li><button><i class="fa-solid fa-filter"></i> Filter</button></li>
                                    <li><i class="fa-solid fa-magnifying-glass" id="search"></i> <input type="text" placeholder="search"></li>
                                </div>
                            </div>

                            <table>
                                <thead>
                                    <tr>
                                        <th>Shop Name</th>
                                        <th>Device</th>
                                        <th>Status</th>
                                        <th>Repair Status</th>
                                        <th>Paid Status</th>
                                        <th>Date Updated</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($repairs as $repair)
                                            @php 
                                                $repairshop = App\Models\RepairShop_Credentials::where('technician_id', $repair->technician_id)->first();
                                                $appointment = App\Models\RepairShop_Appointments::where('customer_id', $repair->customer_id)->first();
                                            @endphp
                                            <tr>
                                                <td>{{$repairshop->shop_name}}</td>
                                                <td>{{$appointment->device_model}}</td>
                                                <td>{{$repair->status}}</td>
                                                <td>{{$repair->repairstatus}}</td>
                                                <td>{{$repair->paid_status}}</td>
                                                <td>{{$repair->updated_at->format('d M, Y')}}</td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>


                        <div id="ratings-feedback" class="form-container">
                            <div class="form-header">
                                <h2>Ratings & Feedback</h2>
                            </div>

                            @foreach($reviews as $review)
                            <div class="review">
                                <div class="review-header">
                                    <span class="review-date">{{$review->created_at->format('d M, Y')}}</span>
                                    <div class="stars">
                                        @for($i = 1; $i <= $review->rating; $i++)
                                            <span class="star"><i class="fa-solid fa-star"></i></span>
                                        @endfor
                                    </div>
                                </div>
                
                                <div class="review-body">
                                    <div class="reviewer-info">
                                        <span class="reviewer-avatar">AK</span>
                                        <div class="reviewer-details">
                                            <span class="reviewer-name">{{$review->customer_fullname}}</span>
                                        </div>
                                        
                                        <i class="fa-solid fa-arrow-right"></i>

                                        <div class="reviewer-details">
                                            @php 
                                                $repairshop = App\Models\RepairShop_Credentials::where('technician_id', $review->technician_id)->first();
                                            @endphp
                                            <a href="{{route('admin.viewprofile', ['userRole' => 'Technician', 'userID' => $review->technician_id])}}" class="shop-name">{{$repairshop->shop_name}}</a>
                                        </div>
                                    </div>
                                    <p class="review-text">
                                        {{$review->review_comment}}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div id="access-logs" class="form-container">
                            <div class="form-header">
                                <h2>Access Logs</h2>
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
                                                {{$activityLog->created_at->format('M d, Y')}} <br>
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
                    </div>
                    
                    <div id="admin-actions" class="admin-actions">
                        <h3>Actions</h3>
                        <div class="admin-buttons">
                        <button class="btn-success" data-user-role="customer" data-user-id="{{$customer->id}}" data-button-type="verify">VERIFY ACCOUNT</button>   
                        <button class="btn-danger" data-user-role="customer" data-user-id="{{$customer->id}}" data-button-type="restrict">RESTRICT ACCOUNT</button> 
                        </div>         
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- <script src="{{ asset('js/Admin/6 - ViewProfile.js') }}" defer></script> -->
    <script src="{{ asset('js/Admin/admin-navbars.js') }}"></script>
    <script src="{{ asset('js/Admin/admin-modal.js') }}"></script>

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
        //Notes
        // Minor: For small infractions or first-time offenses that don’t require significant action (e.g., minor documentation issues).
        // Moderate: For more impactful incidents that require warnings or small disciplinary actions (e.g., missed appointments).
        // Severe: For more serious violations that require significant actions like temporary suspension (e.g., repeat offenses, customer complaints).
        // Critical: For extreme violations that may result in termination or legal action (e.g., fraud, gross negligence).
        // Urgent: For issues that require immediate action, often tied with safety or critical performance (e.g., serious misconduct).

    </script>

    <script>
        const modal = document.getElementById('modal');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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

        //Admin Button
        let adminActions = document.getElementById('admin-actions');
        let adminButtons = adminActions.querySelectorAll('button');

        adminButtons.forEach(button => {
            button.addEventListener('click', function(){
                let userID = this.getAttribute('data-user-id');
                let userType = this.getAttribute('data-user-role');
                let actionType = this.getAttribute('data-button-type');
                verifyAction(userType, userID, actionType);
            });
        });

        function verifyAction(userType, userID, actionType){

            if(actionType == "verify"){
                modal.innerHTML = `
                    <form action="/admin/viewprofile/customer/${userID}/${actionType}" method="POST">        
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="hidden" name="_method" value="PUT">

                        <div class="modal-verification">
                            <i class="fa-solid fa-xmark close icon-close"></i>
                            <i class="fa-solid fa-user-check sign-success"></i>
                            <div class="verification-message">
                                <h2>Verify Account</h2>
                                <p>Are you sure you want to verify this technician?</p>
                            </div>
                            <div class="form-group">
                                <label for="notify_message">Verification notify message:</label>
                                <textarea name="notify_message" id="notify_message" class="notify_message">We regret to inform you that we are unable to proceed with the repair of your device due to unforeseen complications. Please arrange to collect your device at your earliest convenience, and feel free to reach out if you need further assistance.</textarea>
                            </div>
                            <div class="verification-action">
                                <button type="submit" class="btn-success">Restrict</button>
                                <button type="button" class="close btn-normal"><b>Dismiss</b></button>
                            </div>
                        </div> 
                    </form>
                `;   
                console.log({ userType, userID, actionType });             
            } else if (actionType == "restrict"){
                modal.innerHTML = `
                    <form action="/admin/viewprofile/customer/${userID}/${actionType}" method="POST">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="hidden" name="_method" value="PUT">
                        
                        <div class="modal-verification">
                            <i class="fa-solid fa-xmark close icon-close"></i>
                            <i class="fa-solid fa-user-xmark sign-danger"></i>
                            <div class="verification-message">
                                <h2>Restrict Account</h2>
                                <p>Are you sure you want to Restrict this technician?</p> 
                            </div>
                            <div class="form-group">
                                <label for="notify_message">Restriction notify message:</label>
                                <textarea name="notify_message" id="notify_message" class="notify_message">We regret to inform you that we are unable to proceed with the repair of your device due to unforeseen complications. Please arrange to collect your device at your earliest convenience, and feel free to reach out if you need further assistance.</textarea>
                            </div>
                            <div class="verification-action">
                                <button type="submit" class="btn-danger">Restrict</button>
                                <button type="button" class="close btn-normal"><b>Dismiss</b></button>
                            </div>
                        </div>
                    </form>
                `;   
                console.log({ userType, userID, actionType });
            } else if (actionType == "delete"){
                modal.innerHTML = `
                <form method="POST">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="hidden" name="_method" value="PUT">

                        <div class="modal-verification">
                            <i class="fa-solid fa-xmark close icon-close"></i>
                            <i class="fa-solid fa-user-minus sign-danger"></i>
                            <div class="verification-message">
                                <h2>Delete Account</h2>
                                <p>Are you sure you want to Delete this Account?</p>         
                            </div>
                            <div class="verification-action">
                                <button type="submit" class="btn-danger">Delete</button>
                                <button type="button" class="close btn-normal"><b>Dismiss</b></button>
                            </div>
                        </div>                 
                    </form>
                `;   
            }
            modal.classList.add('active');

            // Close modal when 'X' is clicked
            document.querySelectorAll('.close').forEach(button => {
                button.onclick = function () {
                    modal.classList.remove("active");
                };
            });


        }
    </script>
</body>
</html>
