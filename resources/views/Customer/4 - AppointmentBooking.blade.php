@include('components.header-footer')
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TechXpertz</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('css/Customer/header-footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/4 - AppointmentBooking.css') }}">
        <style>
            .summary h4 {
                text-transform: capitalize;
            }
        </style>
    </head>
    <body>

        @if(session()->has('error'))
            <div class="push-notification danger active">
                <i class="fa-solid fa-bell danger"></i>
                <div class="notification-message">
                    <h4>Appointment Booked</h4>
                    <p>{{session('error')}}</p>
                </div>
                <i class="fa-solid fa-xmark" id="close-notification"></i>
            </div>
        @elseif(session()->has('success'))
            <div class="push-notification success active">
                <i class="fa-solid fa-bell success"></i>
                <div class="notification-message">
                    <h4>Appointment Booked</h4>
                    <p>{{session('success')}}</p>
                </div>
                <i class="fa-solid fa-xmark" id="close-notification"></i>
            </div>
        @endif

        @yield('header')
        
        <form class="appointment-form" action="{{ route('bookappointment', ['id' => $technicianID]) }}" method="POST">
            @csrf
            <div class="left">
                <div class="form-section">
                    <h2>Customer Details</h2>
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" id="firstname" name="firstname" value="{{ $customerDetails->firstname ?? '' }}" required> 
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" id="lastname" name="lastname" value="{{ $customerDetails->lastname ?? '' }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ $customerDetails->email ?? '' }}" required>
                    </div>
                    <div class="form-group">
                        <label for="contact_no">Mobile Phone Number</label>
                        <!-- value="{{ $customerDetails->contact ?? '' }}" -->
                        <input type="tel" id="contact_no" name="contact_no" required> 
                    </div>
                </div>
    
                <div class="form-section">
                    <h2>Device Information</h2>
                    <div class="form-group">
                        <label for="device-type">Device Type</label>
                        <select id="device_type" name="device_type" required>
                            <option value="laptop">Laptop</option>
                            <option value="desktop">Desktop</option>
                            <option value="tablet">Tablet</option>
                            <option value="phone">Phone</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="device_brand">Brand</label>
                        <input type="text" id="device_brand" name="device_brand" required>
                    </div>
                    <div class="form-group">
                        <label for="device_model">Device Model</label>
                        <input type="text" id="device_model" name="device_model" required>
                    </div>
                    <div class="form-group">
                        <label for="device_serial">Serial Number (if applicable)</label>
                        <input type="text" id="device_serial" name="device_serial">
                    </div>
                </div>
    
                <div class="form-section excluded">
                    <h2>Device Issue</h2>
                    <div class="form-group-excluded">
                        <label for="issue_descriptions">Description of Issue</label>
                        <textarea id="issue_descriptions" name="issue_descriptions" placeholder="Please provide a detailed description of the issue you are experiencing with your device."></textarea>
                    </div>
                    <div class="form-group-excluded">
                        <label for="error_messages">Error Messages <span>(if applicable)</span></label>
                        <textarea id="error_messages" name="error_messages" placeholder="If your device is displaying any error messages or codes, please provide them here."></textarea>
                    </div>
                    <div class="form-group-excluded">
                        <label for="repair_attempts">Previous Repair Attempts <span>(if applicable)</span></label>
                        <textarea id="repair_attempts" name="repair_attempts" placeholder="Have you attempted any repairs or troubleshooting on the device before? If yes, please describe here"></textarea>
                    </div>
                    <div class="form-group-excluded">
                        <label for="recent_events">Recent Changes or Events <span>(if applicable)</span></label>
                        <textarea id="recent_events" name="recent_events" placeholder="Have there been any recent changes or events that may have contributed to the issue? Ex. Drops, spills and etc. "></textarea>
                    </div>
                    <div class="form-group-excluded">
                        <label for="prepared_parts">Parts Prepared for Repair <span>(if applicable)</span></label>
                        <textarea id="prepared_parts" name="prepared_parts" placeholder="Are there any specific parts or components that you have already prepared for the repair?"></textarea>
                    </div>
                </div>
    
                <div class="form-section">
                    <h2>Appointment Schedule</h2>
                    <div class="form-group">
                        <label for="appointment_date">Select Date</label>
                        <input type="date" id="appointment_date" name="appointment_date" required>
                    </div>
                    <div class="form-group">
                        <label for="appointment_time">Select Time</label>
                        <input type="time" id="appointment_time" name="appointment_time" required>
                    </div>
                    <div class="form-group">
                        <label for="appointment_urgency">Urgency Level</label>
                        <select id="appointment_urgency" name="appointment_urgency">
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>
                </div>            
            </div>
    
            <div class="right">
                <div class="form-summary">
                    <h2>Summary</h2>
                    <div class="summary contact-summary">
                        <div class="detail-group">
                            <p>Full Name</p>
                            <h4>{{ $customerDetails->firstname ?? '' }} {{ $customerDetails->lastname ?? '' }}</h4>
                        </div>
                        <div class="detail-group">
                            <p>Contact</p>
                            <h4></h4>
                        </div>
                        <div class="detail-group">
                            <p>Email</p>
                            <h4>{{ $customerDetails->email ?? '' }}</h4>
                        </div>
                    </div>
    
                    <div class="summary device-summary">
                        <div class="detail-group">
                            <p>Device Type</p>
                            <h4></h4>
                        </div>
                        <div class="detail-group">
                            <p>Brand</p>
                            <h4></h4>
                        </div>
                        <div class="detail-group">
                            <p>Model</p>
                            <h4></h4>
                        </div>
                        <div class="detail-group">
                            <p>Serial Number</p>
                            <h4></h4>
                        </div>
                    </div>
    
                    <div class="summary issue-summary">
                        <div class="detail-group">
                            <h4>Error Messages</h4>
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div class="detail-group">
                            <h4>Previous Repair Attempts</h4>
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div class="detail-group">
                            <h4>Recent Changes or Events</h4>
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div class="detail-group">
                            <h4>Parts Prepared for Repair</h4>
                            <i class="fa-solid fa-check"></i>
                        </div>                    
                    </div>
    
                    <div class="summary schedule-summary">
                        <div class="detail-group">
                            <p>Request Date</p>
                            <h4></h4>
                        </div>
                        <div class="detail-group">
                            <p>Request Time</p>
                            <h4></h4>
                        </div>
                        <div class="detail-group">
                            <p>Urgency Level</p>
                            <h4></h4>
                        </div>
                    </div>
    
                    <h2>Preferred Contact Method</h2>
                    <div class="summary contact-preference">
                        <div class="form-group">
                            <input type="checkbox" id="contact-email" name="contact-method" value="email">
                            <label for="contact-email">Email</label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="contact-phone" name="contact-method" value="phone">
                            <label for="contact-phone">Phone Call</label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="contact-sms" name="contact-method" value="sms">
                            <label for="contact-sms">SMS</label>
                        </div>                    
                    </div>
                    
                    <div class="action">
                        @if(Auth::check())
                            <button type="submit" class="submit-button">REQUEST APPOINTMENT</button>
                            <p><b>Reminder :</b> Please review your information before submitting. Changes cannot be made after submission.</p>                            
                        @else
                            <button type="button" class="submit-button" onclick="window.location.href='{{route('customer.loginCustomer')}}'">LOGIN</button>
                            <p><b>Reminder :</b> You need to log in first to request an appointment.</p>
                        @endif
                    </div>

                </div>            
            </div>
        </form>

        @yield('footer')

        <script>
            // Get the close icon element
            const closeNotification = document.getElementById('close-notification');

            // Add a click event listener to the close icon
            closeNotification.addEventListener('click', function() {
                // Get the push notification container
                const notification = document.querySelector('.push-notification');
                
                // Remove the 'active' class to hide the notification
                notification.classList.remove('active');
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Function to update the summary
                function updateSummary(inputId, summaryClass) {
                    const inputElement = document.getElementById(inputId);
                    const summaryElement = document.querySelector(summaryClass + ' h4');

                    inputElement.addEventListener('input', function () {
                        summaryElement.textContent = inputElement.value;
                    });
                }

                // Update Full Name
                document.getElementById('firstname').addEventListener('input', function () {
                    const firstName = document.getElementById('firstname').value;
                    const lastName = document.getElementById('lastname').value;
                    document.querySelector('.contact-summary .detail-group:nth-child(1) h4').textContent = `${firstName} ${lastName}`;
                });

                document.getElementById('lastname').addEventListener('input', function () {
                    const firstName = document.getElementById('firstname').value;
                    const lastName = document.getElementById('lastname').value;
                    document.querySelector('.contact-summary .detail-group:nth-child(1) h4').textContent = `${firstName} ${lastName}`;
                });

                // Update Contact
                updateSummary('contact_no', '.contact-summary .detail-group:nth-child(2)');

                // Update Email
                updateSummary('email', '.contact-summary .detail-group:nth-child(3)');

                // Update Device Type
                updateSummary('device_type', '.device-summary .detail-group:nth-child(1)');

                // Update Brand
                updateSummary('device_brand', '.device-summary .detail-group:nth-child(2)');

                // Update Model
                updateSummary('device_model', '.device-summary .detail-group:nth-child(3)');

                // Update Serial Number
                updateSummary('device_serial', '.device-summary .detail-group:nth-child(4)');

                // Update Request Date
                updateSummary('appointment_date', '.schedule-summary .detail-group:nth-child(1)');

                // Update Request Time
                updateSummary('appointment_time', '.schedule-summary .detail-group:nth-child(2)');

                // Update Urgency Level
                updateSummary('appointment_urgency', '.schedule-summary .detail-group:nth-child(3)');

                // Handle dynamic checkmarks for device issues
                const issueTextAreas = document.querySelectorAll('.form-group-excluded textarea');

                issueTextAreas.forEach(function (textarea, index) {
                    const checkMark = document.querySelector('.issue-summary .detail-group:nth-child(' + (index + 1) + ') i');

                    textarea.addEventListener('input', function () {
                        if (textarea.value.trim() !== "") {
                            checkMark.style.display = 'inline'; // Show the checkmark
                        } else {
                            checkMark.style.display = 'none'; // Hide the checkmark if the field is empty
                        }
                    });

                    // Initialize the state of the checkmark when the page loads
                    if (textarea.value.trim() !== "") {
                        checkMark.style.display = 'inline';
                    } else {
                        checkMark.style.display = 'none';
                    }
                });

            });
        </script>
    </body>
</html>
