@include('components.admin-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
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

        <div id="modal" class="modal">

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
                <!-- <div class="header">
                    <h1>View Profile</h1>
                </div> -->
                <!-- <div class="content">
                </div> -->
                <div class="content">
                    <div class="left">
                        <div class="upper">
                            <div class="profile-navigation">
                                <h2>Technician Profile</h2>
                                <ul>
                                    <li><a href="#" data-target="technician-details" class="active">Technician Details</a></li>
                                    <li><a href="#" data-target="repair-shop-profile">Repair Shop Profile</a></li>
                                    <li><a href="#" data-target="compliance-documents">Compliance & Documentation</a></li>
                                    <li><a href="#" data-target="repair-monitoring">Repair Monitoring</a></li>
                                    <li><a href="#" data-target="appointment-monitoring">Appointment Monitoring</a></li>
                                    <li><a href="#" data-target="ratings-feedback">Ratings & Feedback</a></li>
                                    <li><a href="#" data-target="disciplinary-records">Disciplinary Records</a></li>
                                    <li><a href="#" data-target="access-logs">Access Logs</a></li>
                                </ul>
                            </div>                            
                        </div>
                    </div>

                    <div class="right">
                        <div id="technician-details" class="form-container active">
                            <div class="form-header">
                                <div class="profile-detail">
                                    <div class="image"></div>
                                    <div class="details">
                                        <h3>{{$technician->firstname}} {{$technician->middlename ?? ''}} {{$technician->lastname}}</h3>
                                        <p>{{$technician->email}}</p> 
                                        <span id="{{$technician->profile_status}}">{{$technician->profile_status == 'complete' ? 'verified' : $technician->profile_status}}</span>                               
                                    </div>
                                </div>
                                
                                <div class="profile-action">
                                    <button class="submit">View picture</button>
                                    <button class="normal">Delete picture</button>
                                </div>
                            </div>

                            <div class="form-section col-3">
                                <div class="form-group">
                                    <label for="user_ID">ID</label>
                                    <input type="text" id="user_ID" name="user_ID" value="{{$technician->id}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="account_created">Account Created</label>
                                    <input type="text" id="account_created" name="account_created" value="{{$technician->created_at->format('M d, Y - h:i A')}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" id="first_name" name="first_name" value="{{$technician->firstname}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="middle_name">Middle Name</label>
                                    <input type="text" id="middle_name" name="middle_name" value="{{$technician->middlename ?? 'N/A'}}" readonly>
                                </div> 
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" value="{{$technician->lastname}}" readonly>
                                </div> 

                                <div class="form-group">
                                    <label for="email_address">Email Address</label>
                                    <input type="text" id="email_address" name="email_address" value="{{$technician->email}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="contact_no">Contact No.</label>
                                    <input type="text" id="contact_no" name="contact_no" value="{{$technician->contact_no}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="educational_bg">Educational Background</label>
                                    <input type="text" id="educational_bg" name="educational_bg" value="{{$technician->educational_background}}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="province">Province</label>
                                    <input type="text" id="province" name="province" value="{{$technician->province}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" id="city" name="city" value="{{$technician->city}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="barangay">Barangay</label>
                                    <input type="text" id="barangay" name="barangay" value="{{$technician->barangay}}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="ZIP_code">ZIP Code</label>
                                    <input type="text" id="ZIP_code" name="ZIP_code" value="{{$technician->zip_code}}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="d_o_b">Date of Birth</label>
                                    <input type="text" id="d_o_b" name="d_o_b" value="{{$technician->date_of_birth->format('M d, Y')}}" readonly>
                                </div>
                            </div>
                        </div>

                        <div id="repair-shop-profile" class="form-container">
                            <div class="form-header">
                                <h2>Repair Shop Credentials</h2>
                            </div>

                            <div class="form-section col-3">
                                <div class="form-group">
                                    <label for="shop_name">Shop Name</label>
                                    <input type="text" id="shop_name" name="shop_name" value="{{$technician->repairshopCredentials->shop_name}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="shop_email">Shop Email</label>
                                    <input type="text" id="shop_email" name="shop_email" value="{{$technician->repairshopCredentials->shop_email}}" readonly>
                                </div> 
                                <div class="form-group">
                                    <label for="shop_contact">Shop Contact No.</label>
                                    <input type="text" id="shop_contact" name="shop_contact" value="{{$technician->repairshopCredentials->shop_contact}}" readonly>
                                </div> 
                                <div class="form-group">
                                    <label for="shop_address">Address</label>
                                    <input type="text" id="shop_address" name="shop_address" value="{{$technician->repairshopCredentials->shop_address}}" readonly>
                                </div> 
                                <div class="form-group">
                                    <label for="shop_province">Province</label>
                                    <input type="text" id="shop_province" name="shop_province" value="{{$technician->repairshopCredentials->shop_province}}" readonly>
                                </div> 
                                <div class="form-group">
                                    <label for="shop_city">City</label>
                                    <input type="text" id="shop_city" name="shop_city" value="{{$technician->repairshopCredentials->shop_city}}" readonly>
                                </div> 
                                <div class="form-group">
                                    <label for="shop_barangay">Barangay</label>
                                    <input type="text" id="shop_barangay" name="shop_barangay" value="{{$technician->repairshopCredentials->shop_barangay}}" readonly>
                                </div> 
                                <div class="form-group">
                                    <label for="shop_zip_code">ZIP Code</label>
                                    <input type="text" id="shop_zip_code" name="shop_zip_code" value="{{$technician->repairshopCredentials->shop_zip_code}}" readonly>
                                </div> 
                            </div>

                            <div class="form-header">
                                <h2>Repair Shop Profile</h2>
                            </div>
                            <div class="line">
                                <h3>REPAIR SHOP BADGES</h3>
                                <div class="lines"> </div>
                            </div>
                            <div class="form-section col-4">
                                <div class="form-group">
                                    <label for="badge_1">Badge 1</label>
                                    <input type="text" id="badge_1" name="badge_1" value="{{$technician->repairshopBadges->badge_1 ?? ''}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="badge_2">Badge 2</label>
                                    <input type="text" id="badge_2" name="badge_2" value="{{$technician->repairshopBadges->badge_2 ?? ''}}" readonly>
                                </div> 
                                <div class="form-group">
                                    <label for="badge_3">Badge 3</label>
                                    <input type="text" id="badge_3" name="badge_3" value="{{$technician->repairshopBadges->badge_3 ?? ''}}" readonly>
                                </div> 

                                <div class="form-group">
                                    <label for="badge_4">Badge 4</label>
                                    <input type="text" id="badge_4" name="badge_4" value="{{$technician->repairshopBadges->badge_4 ?? ''}}" readonly>
                                </div>
                            </div>

                            <div class="line">
                                <h3>REPAIR SHOP MASTERY</h3>
                                <div class="lines"> </div>
                            </div>

                            <div class="form-group">
                                <label for="main_mastery">Main Mastery</label>
                                <input type="text" id="main_mastery" name="main_mastery" value="{{$technician->repairshopMastery->main_mastery ?? ''}}" required>
                            </div>

                            <div class="form-section col-5">
                                @foreach(['Smartphone', 'Tablet', 'Desktop', 'Laptop', 'Smartwatch', 'Camera', 'Printer', 'Speaker', 'Drone', 'All-In-One'] as $item)
                                <div class="mastery {{$technician->repairshopMastery && $technician->repairshopMastery->$item ? 'active' : ''}}">
                                    <img src="{{asset('images/' . $item . '.png')}}">
                                    <p>{{$item}}</p>
                                </div>
                                @endforeach
                            </div>


                            <div class="line">
                                <h3>REPAIR SHOP SERVICES</h3>
                                <div class="lines"> </div>
                            </div>

                            <div class="form-section col-2">
                                @foreach($technician->repairshopServices as $service)
                                    <div class="form-group">
                                        <label for="service">Service {{$loop->iteration}}</label>
                                        <input type="text" id="service" name="service" value="{{$service->service}}" required>
                                    </div>
                                @endforeach
                            </div>

                            <div class="line">
                                <h3>REPAIR SHOP SCHEDULE</h3>
                                <div class="lines"> </div>
                            </div>

                            <div class="form-section col-3">
                                @foreach($technician->repairshopSchedules as $schedule)
                                    @php
                                        $weekDays = [ 
                                            1 => "Monday", 
                                            2 => "Tuesday", 
                                            3 => "Wednesday", 
                                            4 => "Thursday", 
                                            5 => "Friday", 
                                            6 => "Saturday", 
                                            7 => "Sunday"]
                                    @endphp
                                    <div class="form-group">
                                        <label for="{{$weekDays[$schedule->day]}}">{{$weekDays[$schedule->day]}}</label>
                                        @if($schedule->opening_time || $schedule->closing_time)
                                            <input type="text" id="{{$weekDays[$schedule->day]}}" name="{{$weekDays[$schedule->day]}}" value="{{$schedule->opening_time->format('h:i A')}} - {{$schedule->closing_time->format('h:i A')}}" readonly>
                                        @else
                                        <input type="text" id="{{$weekDays[$schedule->day]}}" name="{{$weekDays[$schedule->day]}}" value="Close" readonly>
                                        @endif
                                        
                                    </div>
                                @endforeach
                            </div>

                            <div class="line">
                                <h3>REPAIR SHOP ABOUT</h3>
                                <div class="lines"> </div>
                            </div>

                            <div class="form-group">
                                <label for="repairshop_header">Header</label>
                                <input type="text" id="repairshop_header" name="repairshop_header" value="{{$technician->repairshopProfile->header}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="repairshop_description">Description</label>
                                <textarea type="text" id="repairshop_description" name="repairshop_description" readonly>{{$technician->repairshopProfile->description}}</textarea>
                            </div>
                        </div>

                        <div id="compliance-documents" class="form-container">
                            <div class="form-header">
                                <h2>Compliance & Documentation</h2>
                            </div>

                            <div class="form-body">
                                <div class="compliance-card">
                                    <div class="card-header">
                                        <h3>Certification of Technical Competence</h3>
                                        <span class="status pending">Pending Review</span>
                                    </div>
                                    <div class="card-body">
                                        <!-- <p><strong>Uploaded By:</strong> Technician Name</p> -->
                                        <p><strong>Date Submitted:</strong> 2024-10-10</p>
                                        <p><strong>Description:</strong> A certification that proves the technician's expertise in repair services.</p>
                                        <a href="#" class="btn view-document">View Document</a>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn approve">Approve</button>
                                        <button class="btn reject">Reject</button>
                                        <button class="btn request-resubmission">Resubmit</button>
                                    </div>
                                </div>

                                <div class="compliance-card">
                                    <div class="card-header">
                                        <h3>Certification of Technical Competence</h3>
                                        <span class="status pending">Pending Review</span>
                                    </div>
                                    <div class="card-body">
                                        <!-- <p><strong>Uploaded By:</strong> Technician Name</p> -->
                                        <p><strong>Date Submitted:</strong> 2024-10-10</p>
                                        <p><strong>Description:</strong> A certification that proves the technician's expertise in repair services.</p>
                                        <a href="#" class="btn view-document">View Document</a>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn approve">Approve</button>
                                        <button class="btn reject">Reject</button>
                                        <button class="btn request-resubmission">Resubmit</button>
                                    </div>
                                </div>
                            </div>
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
                                        <th>Repair ID</th>
                                        <th>Customer Name</th>
                                        <th>Status</th>
                                        <th>Repair Status</th>
                                        <th>Revenue</th>
                                        <th>Date Updated</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($technician->repairshopRepairStatus as $repairdata)
                                        <tr>
                                            <td>{{$repairdata->id}}</td>
                                            <td>{{$repairdata->customer_fullname}}</td>
                                            <td>{{$repairdata->status}}</td>
                                            <td>{{$repairdata->repairstatus}}</td>
                                            <td>{{$repairdata->revenue}}</td>
                                            <td>{{$repairdata->updated_at->format('M d, Y, h:i A')}}</td>
                                            <td><button class="view-details" data-appointment-id="{{$repairdata->appointment_id ?? ''}}">View</button></td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
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
                                        <th>Appointment ID</th>
                                        <th>Customer Name</th>
                                        <th>Status</th>
                                        <th>Date Requested</th>
                                        <th>Time Requested</th>
                                        <th>Date Updated</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($technician->repairshopAppointments as $appointmentData)
                                        <tr>
                                            <td>{{$appointmentData->id}}</td>
                                            <td>{{$appointmentData->fullname}}</td>
                                            <td>{{$appointmentData->status}}</td>
                                            <td>{{$appointmentData->appointment_date}}</td>
                                            <td>{{$appointmentData->appointment_time}}</td>
                                            <td>{{$appointmentData->updated_at->format('M d, Y, h:i A')}}</td>
                                            <td><button class="view-details" data-appointment-id="">View</button></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div id="ratings-feedback" class="form-container">
                            <div class="form-header">
                                <h2>Ratings & Feedback</h2>
                            </div>

                            <div class="review">
                                <div class="review-header">
                                    <span class="review-date">Jan 20, 2024</span>
                                    <div class="stars">
                                        <span class="star"><i class="fa-solid fa-star"></i></span>
                                        <span class="star"><i class="fa-solid fa-star"></i></span>
                                        <span class="star"><i class="fa-solid fa-star"></i></span>
                                        <span class="star"><i class="fa-solid fa-star"></i></span>
                                        <span class="star"><i class="fa-solid fa-star"></i></span>
                                    </div>
                                </div>
                
                                <div class="review-body">
                                    <div class="reviewer-info">
                                        <span class="reviewer-avatar">AK</span>
                                        <div class="reviewer-details">
                                            <span class="reviewer-name">Alex K.</span>
                                        </div>
                                    </div>
                                    <p class="review-text">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo est modi, vitae tempore quia asperiores tenetur facilis, ipsam temporibus mollitia nihil suscipit vero necessitatibus porro nostrum error. Corrupti, nulla voluptatibus!
                                    </p>
                                </div>
                            </div>
                            <div class="review">
                                <div class="review-header">
                                    <span class="review-date">Jan 20, 2024</span>
                                    <div class="stars">
                                        <span class="star"><i class="fa-solid fa-star"></i></span>
                                        <span class="star"><i class="fa-solid fa-star"></i></span>
                                        <span class="star"><i class="fa-solid fa-star"></i></span>
                                        <span class="star"><i class="fa-solid fa-star"></i></span>
                                        <span class="star"><i class="fa-solid fa-star"></i></span>
                                    </div>
                                </div>
                
                                <div class="review-body">
                                    <div class="reviewer-info">
                                        <span class="reviewer-avatar">AK</span>
                                        <div class="reviewer-details">
                                            <span class="reviewer-name">Alex K.</span>
                                        </div>
                                    </div>
                                    <p class="review-text">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo est modi, vitae tempore quia asperiores tenetur facilis, ipsam temporibus mollitia nihil suscipit vero necessitatibus porro nostrum error. Corrupti, nulla voluptatibus!
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div id="disciplinary-records" class="form-container">
                            <div class="form-header">
                                <h2>Disciplinary Records</h2>
                            </div>

                            <div class="disciplinary-card">
                                <div class="card-header">
                                    <div class="title">
                                        <h3>Violation: Missed Appointment</h3>
                                        <p><strong>Date of Incident:</strong> October 5, 2023</p>    
                                    </div>
                                    <span>Resolved</span>
                                </div>
                                <div class="card-body">
                                    
                                    <!-- <p><strong>Technician:</strong> John Doe</p> -->
                                    <p><strong>Violation Level:</strong> Minor</p>
                                    <p><strong>Description:</strong> Technician failed to upload the necessary documents for the completed repair of a customer’s device, leading to a delay in approval.</p>
                                    <p><strong>Action Taken:</strong> Formal warning issued, with a requirement to complete documentation by a set deadline.</p>
                                </div>
                                <div class="card-footer">
                                    <p><strong>Resolution Date:</strong> October 1, 2023</p>
                                </div>
                            </div>
                            <div class="disciplinary-card">
                                <div class="card-header">
                                    <div class="title">
                                        <h3>Violation: Missed Appointment</h3>
                                        <p><strong>Date of Incident:</strong> October 5, 2023</p>                                        
                                    </div>
                                    <span>Pending Review</span>
                                </div>
                                <div class="card-body">
                                    <!-- <p><strong>Technician:</strong> Jane Smith</p> -->
                                    <p><strong>Violation Level:</strong> Moderate</p>
                                    <p><strong>Description:</strong> Technician did not show up for a scheduled customer appointment, causing customer dissatisfaction.</p>
                                    <p><strong>Action Taken:</strong> Technician was suspended for two days and required to undergo customer service training.</p>
                                </div>
                                <div class="card-footer">
                                    
                                </div>
                            </div>
                        </div>

                        <div id="access-logs" class="form-container">
                            <div class="form-header">
                                <h2>Access Logs</h2>
                            </div>

                            <table>
                                <thead>
                                    <tr>
                                        <th>Date of Login</th>
                                        <th>IP Address</th>
                                        <th>Status</th>
                                        <th>Browser Information</th>
                                        <th>Last Password Reset (date)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div id="admin-actions" class="admin-actions">
                        <h3>Actions</h3>
                        <div class="admin-buttons">
                           <button id="complete" data-user-role="technician" data-user-id="{{$technician->id}}" data-button-type="verify">VERIFY ACCOUNT</button>   
                           <button id="restricted" data-user-role="technician" data-user-id="{{$technician->id}}" data-button-type="restrict">RESTRICT ACCOUNT</button> 
                           <!-- <button class="delete" data-user-role="technician" data-user-id="{{$technician->id}}" data-button-type="delete">DELETE ACCOUNT</button>      -->
                        </div>         
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script src="{{ asset('js/Admin/2 - UserManagement.js') }}"></script>
    <script src="{{ asset('js/Admin/admin-navbars.js') }}"></script>
    <script src="{{ asset('js/Admin/admin-modal.js') }}"></script>

    <script>
        let modal = document.getElementById('modal');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
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
                    <form action="/admin/viewprofile/${userType}/${userID}/${actionType}" method="POST">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="hidden" name="_method" value="PATCH">
                        
                        <div class="modal-verification">
                            <i class="fa-solid fa-user-check" id="check"></i>
                            <div class="verification-message">
                                <h2>Verify Account</h2>
                                <p>Are you sure you want to verify this technician?</p>
                            </div>
                            <div class="verification-action">
                                <button type="submit" class="success">Verify</button>
                                <button type="button" class="normal"><b>Dismiss</b></button>
                            </div>
                        </div>                
                    </form>
                `;                
            } else if (actionType == "restrict"){
                modal.innerHTML = `
                    <form action="/admin/viewprofile/${userType}/${userID}/${actionType}" method="POST">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="hidden" name="_method" value="PATCH">

                        <div class="modal-verification">
                            <i class="fa-solid fa-user-xmark" id="exclamation"></i>
                            <div class="verification-message">
                                <h2>Restrict Account</h2>
                                <p>Are you sure you want to Restrict this technician?</p>                        
                            </div>
                            <div class="verification-action">
                                <button type="submit" class="danger">Restrict</button>
                                <button type="button" class="normal"><b>Dismiss</b></button>
                            </div>
                        </div>                 
                    </form>
                `;   
            } else if (actionType == "delete"){
                modal.innerHTML = `
                   <form method="POST">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="hidden" name="_method" value="PATCH">

                        <div class="modal-verification">
                            <i class="fa-solid fa-user-minus" id="exclamation"></i>
                            <div class="verification-message">
                                <h2>Delete Account</h2>
                                <p>Are you sure you want to Delete this Account?</p>                        
                            </div>
                            <div class="verification-action">
                                <button type="submit" class="danger">Delete</button>
                                <button type="button" class="normal"><b>Dismiss</b></button>
                            </div>
                        </div>                 
                    </form>
                `;   
            }

            // Close modal when 'X' is clicked
            document.querySelector('.normal').onclick = function () {
                modal.classList.remove("active");
            };

            modal.classList.add('active');
        }
    </script>

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

        //$ loop -> iteration - can serve as your row count or headcount foreach data

    </script>
</body>
</html>
