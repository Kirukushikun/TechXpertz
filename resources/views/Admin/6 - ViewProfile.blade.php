@include('components.admin-sidebar')
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>User Management</title>
        <link rel="icon" href="{{ asset('images/TechXpertz-Icon.ico') }}" />
        <!-- Crucial Part on every forms -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- Crucial Part on every forms/ -->
        <link rel="stylesheet" href="{{ asset('css/Admin/6 - ViewProfile.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/Admin/admin-sidebar.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/Admin/admin-modal.css') }}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <div class="dashboard">
            <div id="modal" class="modal"></div>

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
                                    <h2>Technician Profile</h2>
                                    <ul>
                                        <li><a href="#" data-target="technician-details" class="active">Technician Details</a></li>
                                        <li><a href="#" data-target="repair-shop-profile">Repair Shop Profile</a></li>
                                        <li><a href="#" data-target="compliance-documents">Uploads</a></li>
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

                                    <div class="profile-action"></div>
                                </div>

                                <div class="form-section col-3">
                                    <div class="form-group">
                                        <label for="user_ID">ID</label>
                                        <input type="text" id="user_ID" name="user_ID" value="{{$technician->id}}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="account_created">Account Created</label>
                                        <input type="text" id="account_created" name="account_created" value="{{$technician->created_at->format('M d, Y - h:i A')}}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" id="first_name" name="first_name" value="{{$technician->firstname}}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="middle_name">Middle Name</label>
                                        <input type="text" id="middle_name" name="middle_name" value="{{$technician->middlename ?? 'N/A'}}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" id="last_name" name="last_name" value="{{$technician->lastname}}" readonly />
                                    </div>

                                    <div class="form-group">
                                        <label for="email_address">Email Address</label>
                                        <input type="text" id="email_address" name="email_address" value="{{$technician->email}}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_no">Contact No.</label>
                                        <input type="text" id="contact_no" name="contact_no" value="{{$technician->contact_no}}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="educational_bg">Educational Background</label>
                                        <input type="text" id="educational_bg" name="educational_bg" value="{{$technician->educational_background}}" readonly />
                                    </div>

                                    <div class="form-group">
                                        <label for="province">Province</label>
                                        <input type="text" id="province" name="province" value="{{$technician->province}}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" id="city" name="city" value="{{$technician->city}}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="barangay">Barangay</label>
                                        <input type="text" id="barangay" name="barangay" value="{{$technician->barangay}}" readonly />
                                    </div>

                                    <div class="form-group">
                                        <label for="ZIP_code">ZIP Code</label>
                                        <input type="text" id="ZIP_code" name="ZIP_code" value="{{$technician->zip_code}}" readonly />
                                    </div>

                                    <div class="form-group">
                                        <label for="d_o_b">Date of Birth</label>
                                        <input type="text" id="d_o_b" name="d_o_b" value="{{$technician->date_of_birth->format('M d, Y')}}" readonly />
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
                                        <input type="text" id="shop_name" name="shop_name" value="{{$technician->repairshopCredentials->shop_name}}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="shop_email">Shop Email</label>
                                        <input type="text" id="shop_email" name="shop_email" value="{{$technician->repairshopCredentials->shop_email}}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="shop_contact">Shop Contact No.</label>
                                        <input type="text" id="shop_contact" name="shop_contact" value="{{$technician->repairshopCredentials->shop_contact}}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="shop_address">Address</label>
                                        <input type="text" id="shop_address" name="shop_address" value="{{$technician->repairshopCredentials->shop_address}}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="shop_province">Province</label>
                                        <input type="text" id="shop_province" name="shop_province" value="{{$technician->repairshopCredentials->shop_province}}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="shop_city">City</label>
                                        <input type="text" id="shop_city" name="shop_city" value="{{$technician->repairshopCredentials->shop_city}}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="shop_barangay">Barangay</label>
                                        <input type="text" id="shop_barangay" name="shop_barangay" value="{{$technician->repairshopCredentials->shop_barangay}}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="shop_zip_code">ZIP Code</label>
                                        <input type="text" id="shop_zip_code" name="shop_zip_code" value="{{$technician->repairshopCredentials->shop_zip_code}}" readonly />
                                    </div>
                                </div>

                                <div class="form-header">
                                    <h2>Repair Shop Profile</h2>
                                </div>
                                <div class="line">
                                    <h3>REPAIR SHOP BADGES</h3>
                                    <div class="lines"></div>
                                </div>
                                <div class="form-section col-4">
                                    <div class="form-group">
                                        <label for="badge_1">Badge 1</label>
                                        <input type="text" id="badge_1" name="badge_1" value="{{$technician->repairshopBadges->badge_1 ?? ''}}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="badge_2">Badge 2</label>
                                        <input type="text" id="badge_2" name="badge_2" value="{{$technician->repairshopBadges->badge_2 ?? ''}}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="badge_3">Badge 3</label>
                                        <input type="text" id="badge_3" name="badge_3" value="{{$technician->repairshopBadges->badge_3 ?? ''}}" readonly />
                                    </div>

                                    <div class="form-group">
                                        <label for="badge_4">Badge 4</label>
                                        <input type="text" id="badge_4" name="badge_4" value="{{$technician->repairshopBadges->badge_4 ?? ''}}" readonly />
                                    </div>
                                </div>

                                <div class="line">
                                    <h3>REPAIR SHOP MASTERY</h3>
                                    <div class="lines"></div>
                                </div>

                                <div class="form-group">
                                    <label for="main_mastery">Main Mastery</label>
                                    <input type="text" id="main_mastery" name="main_mastery" value="{{$technician->repairshopMastery->main_mastery ?? ''}}" required />
                                </div>

                                <div class="form-section col-5">
                                    @foreach(['Smartphone', 'Tablet', 'Desktop', 'Laptop', 'Smartwatch', 'Camera', 'Printer', 'Speaker', 'Drone', 'All-In-One'] as $item)
                                    <div class="mastery {{$technician->repairshopMastery && $technician->repairshopMastery->$item ? 'active' : ''}}">
                                        <img src="{{asset('images/' . $item . '.png')}}" />
                                        <p>{{$item}}</p>
                                    </div>
                                    @endforeach
                                </div>

                                <div class="line">
                                    <h3>REPAIR SHOP SERVICES</h3>
                                    <div class="lines"></div>
                                </div>

                                <div class="form-section col-2">
                                    @foreach($technician->repairshopServices as $service)
                                    <div class="form-group">
                                        <label for="service">Service {{$loop->iteration}}</label>
                                        <input type="text" id="service" name="service" value="{{$service->service}}" required />
                                    </div>
                                    @endforeach
                                </div>

                                <div class="line">
                                    <h3>REPAIR SHOP SCHEDULE</h3>
                                    <div class="lines"></div>
                                </div>

                                <div class="form-section col-3">
                                    @foreach($technician->repairshopSchedules as $schedule) @php $weekDays = [ 1 => "Monday", 2 => "Tuesday", 3 => "Wednesday", 4 => "Thursday", 5 => "Friday", 6 => "Saturday", 7 => "Sunday"] @endphp
                                    <div class="form-group">
                                        <label for="{{$weekDays[$schedule->day]}}">{{$weekDays[$schedule->day]}}</label>
                                        @if($schedule->opening_time || $schedule->closing_time)
                                        <input type="text" id="{{$weekDays[$schedule->day]}}" name="{{$weekDays[$schedule->day]}}" value="{{$schedule->opening_time->format('h:i A')}} - {{$schedule->closing_time->format('h:i A')}}" readonly />
                                        @else
                                        <input type="text" id="{{$weekDays[$schedule->day]}}" name="{{$weekDays[$schedule->day]}}" value="Close" readonly />
                                        @endif
                                    </div>
                                    @endforeach
                                </div>

                                <div class="line">
                                    <h3>REPAIR SHOP ABOUT</h3>
                                    <div class="lines"></div>
                                </div>

                                <div class="form-group">
                                    <label for="repairshop_header">Header</label>
                                    <input type="text" id="repairshop_header" name="repairshop_header" value="{{$technician->repairshopProfile->header ?? ''}}" readonly />
                                </div>
                                <div class="form-group">
                                    <label for="repairshop_description">Description</label>
                                    <textarea type="text" id="repairshop_description" name="repairshop_description" readonly>{{$technician->repairshopProfile->description ?? ''}}</textarea>
                                </div>
                            </div>

                            <div id="compliance-documents" class="form-container">
                                <div class="form-header">
                                    <h2>Image Uploads</h2>
                                </div>

                                <div class="form-body">
                                    @foreach(['image_profile', 'image_2', 'image_3', 'image_4', 'image_5'] as $image) @if($technician->repairshopImages && $technician->repairshopImages->$image)
                                    <div class="compliance-card" style="background-image: url('{{ asset($technician->repairshopImages->$image) }}');"></div>
                                    @endif @endforeach
                                </div>
                            </div>

                            <div id="repair-monitoring" class="form-container">
                                <div class="form-header">
                                    <h2>Repair Monitoring</h2>
                                    <div class="tab-filters">
                                        <li>
                                            <button><i class="fa-solid fa-filter"></i> Filter</button>
                                        </li>
                                        <li><i class="fa-solid fa-magnifying-glass" id="search"></i> <input type="text" placeholder="search" /></li>
                                    </div>
                                </div>
                                @if(!$technician->repairshopRepairStatus || count($technician->repairshopRepairStatus) == 0)
                                <div class="empty-container">No current repairs at the moment</div>
                                @else
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Repair ID</th>
                                            <th>Customer Name</th>
                                            <th>Status</th>
                                            <th>Repair Status</th>
                                            <th>Revenue</th>
                                            <th>Date Updated</th>
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
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>

                            <div id="appointment-monitoring" class="form-container">
                                <div class="form-header">
                                    <h2>Appointment Monitoring</h2>
                                    <div class="tab-filters">
                                        <li>
                                            <button><i class="fa-solid fa-filter"></i> Filter</button>
                                        </li>
                                        <li><i class="fa-solid fa-magnifying-glass" id="search"></i> <input type="text" placeholder="search" /></li>
                                    </div>
                                </div>
                                @if(!$technician->repairshopAppointments || count($technician->repairshopAppointments) == 0)
                                <div class="empty-container">No current appointments at the moment</div>
                                @else
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Appointment ID</th>
                                            <th>Customer Name</th>
                                            <th>Status</th>
                                            <th>Date Requested</th>
                                            <th>Time Requested</th>
                                            <th>Date Updated</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($technician->repairshopAppointments as $appointmentData)
                                        <tr>
                                            <td>{{$appointmentData->id}}</td>
                                            <td>{{$appointmentData->fullname}}</td>
                                            <td>{{$appointmentData->status}}</td>
                                            <td>{{$appointmentData->appointment_date->format('M d, Y')}}</td>
                                            <td>{{$appointmentData->appointment_time->format('h:i A')}}</td>
                                            <td>{{$appointmentData->updated_at->format('M d, Y, h:i A')}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>

                            <div id="ratings-feedback" class="form-container">
                                <div class="form-header">
                                    <h2>Ratings & Feedback</h2>
                                </div>
                                @if(!$technician->repairshopReviews || count($technician->repairshopReviews) == 0)
                                <div class="empty-container">No current reviews at the moment</div>
                                @else @foreach($technician->repairshopReviews as $review)
                                <div class="review {{$review->status}}">
                                    <div class="review-header">
                                        <!-- <span class="status">Approved</span> -->
                                        <span class="review-date">{{$review->created_at->format('M d, Y')}}</span>
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
                                        </div>
                                        <p class="review-text">{{$review->review_comment}}</p>
                                        @if($review->status == "Pending")
                                        <div class="review-action">
                                            <button class="Approve" button-action="Approve" data-review-id="{{$review->id}}">APPROVE</button>
                                            <button class="Reject" button-action="Reject" data-review-id="{{$review->id}}">REJECT</button>
                                        </div>
                                        @elseif($review->status == "Approved")
                                        <div class="review-action">
                                            <button class="Reject" button-action="Reject" data-review-id="{{$review->id}}">REJECT</button>
                                        </div>
                                        @elseif($review->status == "Rejected")
                                        <div class="review-action">
                                            <button class="Approve" button-action="Approve" data-review-id="{{$review->id}}">APPROVE</button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach @endif
                            </div>

                            <div id="disciplinary-records" class="form-container">
                                <div class="form-header">
                                    <h2>Disciplinary Records</h2>
                                    <button class="disiplinary-btn btn-normal" data-technician-id="{{$technician->id}}">Add Record</button>
                                </div>
                                @if(!$disciplinaryRecords || count($disciplinaryRecords) == 0)
                                <div class="empty-container">No current records at the moment</div>
                                @else @foreach($disciplinaryRecords as $disciplinaryRecord)
                                <div class="disciplinary-card {{$disciplinaryRecord->status == 'Solved' ? 'solved' : ''}}">
                                    <div class="card-header">
                                        <div class="title">
                                            <h3>Violation: {{$disciplinaryRecord->violation_header}}</h3>
                                            <p><strong>Date of Incident:</strong> {{$disciplinaryRecord->date_of_incident->format('M d, Y')}}</p>
                                        </div>
                                        <div class="card-status">
                                            @php
                                                // Initialize variables
                                                $offense = "";
                                                $level = "";

                                                // Map violation offense to status classes
                                                $offenseMap = [
                                                    "First Offense" => "status-soft",
                                                    "Second Offense" => "status-mild",
                                                    "Third Offense" => "status-moderate",
                                                    "Fourth Offense" => "status-high",
                                                    "Fifth Offense" => "status-severe",
                                                ];

                                                // Map violation level to status classes
                                                $levelMap = [
                                                    "Minor" => "status-soft",
                                                    "Moderate" => "status-mild",
                                                    "Urgent" => "status-moderate",
                                                    "Critical" => "status-high",
                                                    "Severe" => "status-severe",
                                                ];

                                                // Assign offense and level based on mappings
                                                $offense = $offenseMap[$disciplinaryRecord->violation_offense] ?? "";
                                                $level = $levelMap[$disciplinaryRecord->violation_level] ?? "";
                                            @endphp

                                            <span class="{{$offense}}">{{$disciplinaryRecord->violation_offense}}</span>
                                            <span class="{{$level}}">{{$disciplinaryRecord->violation_level}}</span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!-- <p><strong>Technician:</strong> John Doe</p> -->
                                        <p><strong>Violation Status: </strong>{{$disciplinaryRecord->status}}</p>
                                        <p><strong>Violation Description: </strong>{{$disciplinaryRecord->violation_description}}</p>
                                        @if($disciplinaryRecord->action_taken)
                                        <p><strong>Action Taken: </strong> {{$disciplinaryRecord->action_taken}}</p>
                                        @endif
                                    </div>
                                    <div class="card-footer">
                                        @if($disciplinaryRecord->resolution_date)
                                        <p><strong>Resolution Date:</strong> {{$disciplinaryRecord->resolution_date->format('M d, Y')}}</p>
                                        @endif @if($disciplinaryRecord->status != "Solved")
                                        <div class="card-footer-action">
                                            <button class="update-record-btn btn-primary" data-record-id="{{$disciplinaryRecord->id}}" data-technician-id="{{$technician->id}}" data-action-type="update">UPDATE</button>
                                            <button class="update-record-btn btn-success" data-record-id="{{$disciplinaryRecord->id}}" data-technician-id="{{$technician->id}}" data-action-type="resolve">MARK AS RESOLVED</button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach @endif
                            </div>

                            <div id="access-logs" class="form-container">
                                <div class="form-header">
                                    <h2>Activity Logs</h2>
                                </div>
                                @if(!$activityLogs || count($activityLogs) == 0)
                                <div class="empty-container">No current records at the moment</div>
                                @else
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
                                                {{$activityLog->created_at->format('M d, Y')}} <br />
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
                                @endif
                            </div>
                        </div>

                        <div id="admin-actions" class="admin-actions">
                            <h3>Actions</h3>
                            <div class="admin-buttons">
                                <button class="btn-success" data-user-role="technician" data-user-id="{{$technician->id}}" data-button-type="verify">VERIFY ACCOUNT</button>
                                <button class="btn-danger" data-user-role="technician" data-user-id="{{$technician->id}}" data-button-type="restrict">RESTRICT ACCOUNT</button>

                                <!-- <button class="delete" data-user-role="technician" data-user-id="{{$technician->id}}" data-button-type="delete">DELETE ACCOUNT</button>      -->
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <script src="{{ asset('js/Admin/6 - ViewProfile.js') }}" defer></script>
        <script src="{{ asset('js/Admin/admin-navbars.js') }}" defer></script>
        <script src="{{ asset('js/Admin/admin-modal.js') }}" defer></script>

        <script>
            //Notes
            // Minor: For small infractions or first-time offenses that don’t require significant action (e.g., minor documentation issues).
            // Moderate: For more impactful incidents that require warnings or small disciplinary actions (e.g., missed appointments).
            // Severe: For more serious violations that require significant actions like temporary suspension (e.g., repeat offenses, customer complaints).
            // Critical: For extreme violations that may result in termination or legal action (e.g., fraud, gross negligence).
            // Urgent: For issues that require immediate action, often tied with safety or critical performance (e.g., serious misconduct).

            //$ loop -> iteration - can serve as your row count or headcount foreach data
        </script>

        <script>
            // Run the code only after the webpage is fully loaded
            document.addEventListener("DOMContentLoaded", function () {
                // Get all the review-action sections on the page
                const reviewActions = document.querySelectorAll(".review-action");

                // Loop through each review-action section
                reviewActions.forEach(function (action) {
                    // Find the parent review container (the element with the 'review' class)
                    const reviewContainer = action.closest(".review");

                    // Find the Approve and Reject buttons
                    const approveButton = action.querySelector(".Approve");
                    const rejectButton = action.querySelector(".Reject");

                    // When the Approve button is clicked
                    if (approveButton) {
                        approveButton.addEventListener("click", function () {
                            let reviewID = this.getAttribute("data-review-id");
                            updateReview(reviewID, "Approved");
                            // Remove existing status classes (Pending, Rejected) and add Approved
                            reviewContainer.classList.remove("Pending", "Rejected");
                            reviewContainer.classList.add("Approved");

                            action.style.display = "none";
                        });
                    }

                    // When the Reject button is clicked
                    if (rejectButton) {
                        rejectButton.addEventListener("click", function () {
                            let reviewID = this.getAttribute("data-review-id");
                            updateReview(reviewID, "Rejected");
                            // Remove existing status classes (Pending, Approved) and add Rejected
                            reviewContainer.classList.remove("Pending", "Approved");
                            reviewContainer.classList.add("Rejected");

                            action.style.display = "none";
                        });
                    }
                });

                function updateReview(reviewID, reviewStatus) {
                    fetch(`/admin/reviewsmanagement/${reviewID}`, {
                        method: "PATCH", // You can use 'PUT' or 'PATCH' depending on your API design
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                        },
                        body: JSON.stringify({ status: reviewStatus }), // Send necessary data in the body
                    })
                        .then((response) => {
                            if (response.ok) {
                                console.log("Review updated successfully");
                            } else {
                                console.log("Review update failed");
                            }
                        })
                        .catch((error) => {
                            console.log("There was an error with the request:", error);
                        });
                }
            });
        </script>

    </body>
</html>
