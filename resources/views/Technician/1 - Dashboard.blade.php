@include('components.technician-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/Technician/technician-sidebar.css')}}">

    <link rel="stylesheet" href="{{asset('css/Technician/1 - Dashboard.css')}}">
</head>
<body>
    <div class="dashboard">

        <div class="modal active" id="modal">
            <form action="">
                <div class="modal-verification">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <div class="verification-message">
                        <h2>Terminate Appointment</h2>
                        <p>Are you sure you want to terminate appointment?</p>                        
                    </div>
                    <div class="verification-action">
                        <button type="submit" class="">Terminate</button>
                        <button class="cancel">Cancel</button>
                    </div>
                </div>                
            </form>
        </div>

        @yield('sidebar')

        <main class="main-content">
            <header>
                <h1>Dashboard</h1>
            </header>

            <section class="stats">
                <div class="stat revenue-card">
                    <div class="info">
                        <p>Revenue</p>
                        <h2>P{{$revenue}}</h2>
                    </div>
                    <div class="progress revenue">
                        <h4 class="percentage">+22%</h4>
                        <i class="fa-solid fa-arrow-trend-up"></i>
                    </div>
                </div>
                <div class="stat repairs-card">
                    <div class="info">
                        <p>Total Repairs</p>
                        <h2>{{count($totalRepairs)}}</h2>
                    </div>
                    <div class="progress repairs">
                        <h4 class="percentage">-25%</h4>
                        <i class="fa-solid fa-arrow-trend-down"></i>
                    </div>
                </div>
                <div class="stat visitors-card">
                    <div class="info">
                        <p>Visitors</p>
                        <h2>1.5K</h2>
                    </div>
                    <div class="progress visitors">
                        <h4 class="percentage">+49%</h4>
                        <i class="fa-solid fa-arrow-trend-up"></i>
                    </div>
                </div>
                <div class="stat reviews-card">
                    <div class="info">
                        <p>Reviews</p>
                        <h2>{{count($reviews)}}</h2>
                    </div>
                    <div class="progress reviews">
                        <h4 class="percentage">+1.9%</h4>
                        <i class="fa-solid fa-arrow-trend-up"></i>
                    </div>
                </div>
            </section>
            
            <section class="appointments">
                <div class="appointments-requests card">
                    <div class="actions">
                        <h2>Appointment Requests</h2>
                        <a href="">More <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Device Type</th>
                                <th>Date</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requestedAppointments as $request)
                                <tr>
                                    <td class="profile-cell">{{$request->fullname}}</td>
                                    <td>{{$request->device_type}}</td>
                                    <td>{{$request->formatted_date}}</td>
                                    <td>{{$request->formatted_time}}</td>
                                </tr>                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="appointment-summary card">
                    <div class="actions">
                        <h2>Activity Summary</h2>
                        <a href="">More <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    <div class="summary-cards">
                        <div class="summary-card">
                            <div class="info">
                                <p>Upcoming</p>
                                <h2>{{count($upcomingAppointments)}}</h2>                                
                            </div>
                            <i class="fa-solid fa-calendar-day upcoming"></i>
                        </div>
                        <div class="summary-card">
                            <div class="info">
                                <p>Requests</p>
                                <h2>{{count($requestedAppointments)}}</h2>                                
                            </div>
                            <i class="fa-solid fa-calendar-plus request"></i>
                        </div>
                        <div class="summary-card">
                            <div class="info">
                                <p>Pending Repairs</p>
                                <h2>{{count($pendingStatus)}}</h2>                                
                            </div>
                            <i class="fa-solid fa-screwdriver-wrench pending"></i>
                        </div>
                        <div class="summary-card">
                            <div class="info">
                                <p>Completed Repairs</p>
                                <h2>{{count($completedStatus)}}</h2>                                
                            </div>
                            <i class="fa-solid fa-check-double completed"></i>
                        </div>
                    </div>
                </div>
            </section>

            <section class="upcoming-appointments card">
                <div class="actions">
                    <h2>Upcoming Appointments</h2>
                    <a href="">More <i class="fa-solid fa-arrow-right"></i></a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Details</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($upcomingAppointments as $upcoming)
                            <tr>
                                <td>{{$upcoming->fullname}}</td>
                                <td>{{$upcoming->email}}</td>
                                <td>{{$upcoming->contact_no}}</td>
                                <td>{{$upcoming->formatted_date}}</td>
                                <td>{{$upcoming->formatted_time}}</td>
                                <td><button class="view-upcoming" data-upcoming-id="{{$upcoming->id}}">View</button></td>
                                <td>
                                    <a class="delete" href=""><i class="fas fa-trash"></i></a>
                                    <!-- <a class="more" href=""><i class="fa-solid fa-ellipsis"></i></a> -->
                                </td>
                            </tr>                            
                        @endforeach

                    </tbody>
                </table>
            </section>
        </main>
    </div>
    
    <script src="{{asset('js/Technician/technician-sidebar.js')}}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const viewUpcoming = document.querySelectorAll('button.view-upcoming');

            viewUpcoming.forEach(button => {
                button.addEventListener('click', function (){
                    const upcomingID = this.getAttribute('data-upcoming-id');
                    fetchUpcomingDetails(upcomingID);
                    console.log('button is working', upcomingID);
                });
            });

            function fetchUpcomingDetails(upcomingID) {
                // Insert repairID dynamically into the URL
                fetch(`/technician/appointment/details/${upcomingID}`)
                    .then(response => response.json())
                    .then(data => {
                        displayModal(data);
                    })
            }

            function displayModal(data){
                const modal = document.getElementById('modal');

                modal.innerHTML = `
                <div class="modal-content" id="modal-content">
                    <div class="modal-body">
                        <div class="left">
                            <div class="form-section">
                                <h2>Customer Details</h2>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="first-name">ID</label>
                                        <input type="text" id="first-name" name="first-name" value="${data.ID}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="last-name">Full Name</label>
                                        <input type="text" id="last-name" name="last-name" value="${data.fullname}" disabled>
                                    </div>                                
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" id="email" name="email" value="${data.email}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Mobile Phone Number</label>
                                        <input type="tel" id="phone" name="phone" value="${data.contact}" disabled> 
                                    </div>                                
                                </div>
                            </div>

                            <div class="form-section">
                                <h2>Device Information</h2>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="device-type">Device Type</label>
                                        <input type="text" id="device-type" name="device-type" value="${data.device_type}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="brand">Brand</label>
                                        <input type="text" id="brand" name="brand" value="${data.device_brand}" disabled>
                                    </div>                                
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <label for="device-model">Device Model</label>
                                        <input type="text" id="device-model" name="device-model" value="${data.device_model}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="serial-number">Serial Number</label>
                                        <input type="text" id="serial-number" name="serial-number" value="${data.device_serial}" disabled>
                                    </div>                                
                                </div>
                            </div>

                            <div class="form-section">
                                <h2>Appointment Schedule</h2>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="appointment-date">Select Date</label>
                                        <input type="text" id="appointment-date" name="appointment-date" value="${data.formatted_date}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="appointment-time">Select Time</label>
                                        <input type="text" id="appointment-time" name="appointment-time" value="${data.formatted_time}" disabled>
                                    </div>                                
                                </div>

                                <div class="form-group">
                                    <label for="urgency-level">Urgency Level</label>
                                    <input type="text" id="urgency-level" name="urgency-level" value="${data.appointment_urgency}" disabled>
                                </div>
                            </div>   
                        </div>

                        <div class="right">
                            <div class="form-section excluded">
                                <h2>Device Issue</h2>
                                <div class="form-group-excluded">
                                    <label for="issue-description">Description of Issue</label>
                                    <textarea id="issue-description" name="issue-description" disabled>${data.issue_description}</textarea>
                                </div>
                                <div class="form-group-excluded">
                                    <label for="error-message">Error Messages</label>
                                    <textarea id="error-message" name="error-message" disabled>${data.error_message}</textarea>
                                </div>
                                <div class="form-group-excluded">
                                    <label for="previous-steps">Previous Repair Attempts</label>
                                    <textarea id="previous-steps" name="previous-steps" disabled>${data.repair_attempts}</textarea>
                                </div>
                                <div class="form-group-excluded">
                                    <label for="issue-duration">Recent Changes or Events</label>
                                    <textarea id="issue-duration" name="issue-duration" disabled>${data.recent_events}</textarea>
                                </div>
                                <div class="form-group-excluded">
                                    <label for="additional-info">Parts Prepared for Repair</label>
                                    <textarea id="additional-info" name="additional-info" disabled>${data.prepared_parts}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-action">
                        <button class="close">Close</button>
                    </div>
                </div>
                `;

                // Show the modal
                modal.classList.add("active");

                // Close modal when 'X' is clicked
                document.querySelector('.close').onclick = function () {
                    modal.classList.remove("active");
                };
            }
            
        });
    </script>
</body>
</html>
