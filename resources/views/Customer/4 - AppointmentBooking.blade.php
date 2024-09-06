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

        @yield('header')
        
        <form class="appointment-form" action="{{ route('bookappointment', ['id' => $technicianID]) }}" method="POST">
            @csrf
            <div class="left">
                <div class="form-section">
                    <h2>Customer Details</h2>
                    <div class="form-group">
                        <label for="first-name">First Name</label>
                        <input type="text" id="first-name" name="first-name" value="{{ $customerDetails->firstname ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last Name</label>
                        <input type="text" id="last-name" name="last-name" value="{{ $customerDetails->lastname ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ $customerDetails->email ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Mobile Phone Number</label>
                        <!-- value="{{ $customerDetails->contact ?? '' }}" -->
                        <input type="tel" id="phone" name="phone" > 
                    </div>
                </div>
    
                <div class="form-section">
                    <h2>Device Information</h2>
                    <div class="form-group">
                        <label for="device-type">Device Type</label>
                        <select id="device-type" name="device-type">
                            <option value="laptop">Laptop</option>
                            <option value="desktop">Desktop</option>
                            <option value="tablet">Tablet</option>
                            <option value="phone">Phone</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="brand">Brand</label>
                        <input type="text" id="brand" name="brand">
                    </div>
                    <div class="form-group">
                        <label for="device-model">Device Model</label>
                        <input type="text" id="device-model" name="device-model">
                    </div>
                    <div class="form-group">
                        <label for="serial-number">Serial Number (if applicable)</label>
                        <input type="text" id="serial-number" name="serial-number">
                    </div>
                </div>
    
                <div class="form-section excluded">
                    <h2>Device Issue</h2>
                    <div class="form-group-excluded">
                        <label for="issue-description">Description of Issue</label>
                        <textarea id="issue-description" name="issue-description" placeholder="Please provide a detailed description of the issue you are experiencing with your device."></textarea>
                    </div>
                    <div class="form-group-excluded">
                        <label for="error-message">Error Messages <span>(if applicable)</span></label>
                        <textarea id="error-message" name="error-message" placeholder="If your device is displaying any error messages or codes, please provide them here."></textarea>
                    </div>
                    <div class="form-group-excluded">
                        <label for="previous-steps">Previous Repair Attempts <span>(if applicable)</span></label>
                        <textarea id="previous-steps" name="previous-steps" placeholder="Have you attempted any repairs or troubleshooting on the device before? If yes, please describe here"></textarea>
                    </div>
                    <div class="form-group-excluded">
                        <label for="issue-duration">Recent Changes or Events <span>(if applicable)</span></label>
                        <textarea id="issue-duration" name="issue-duration" placeholder="Have there been any recent changes or events that may have contributed to the issue? Ex. Drops, spills and etc. "></textarea>
                    </div>
                    <div class="form-group-excluded">
                        <label for="additional-info">Parts Prepared for Repair <span>(if applicable)</span></label>
                        <textarea id="additional-info" name="additional-info" placeholder="Are there any specific parts or components that you have already prepared for the repair?"></textarea>
                    </div>
                </div>
    
                <div class="form-section">
                    <h2>Appointment Schedule</h2>
                    <div class="form-group">
                        <label for="appointment-date">Select Date</label>
                        <input type="date" id="appointment-date" name="appointment-date">
                    </div>
                    <div class="form-group">
                        <label for="appointment-time">Select Time</label>
                        <input type="time" id="appointment-time" name="appointment-time">
                    </div>
                    <div class="form-group">
                        <label for="urgency-level">Urgency Level</label>
                        <select id="urgency-level" name="urgency-level">
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
                            <h4></h4>
                        </div>
                        <div class="detail-group">
                            <p>Contact</p>
                            <h4></h4>
                        </div>
                        <div class="detail-group">
                            <p>Email</p>
                            <h4></h4>
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
                document.getElementById('first-name').addEventListener('input', function () {
                    const firstName = document.getElementById('first-name').value;
                    const lastName = document.getElementById('last-name').value;
                    document.querySelector('.contact-summary .detail-group:nth-child(1) h4').textContent = `${firstName} ${lastName}`;
                });

                document.getElementById('last-name').addEventListener('input', function () {
                    const firstName = document.getElementById('first-name').value;
                    const lastName = document.getElementById('last-name').value;
                    document.querySelector('.contact-summary .detail-group:nth-child(1) h4').textContent = `${firstName} ${lastName}`;
                });

                // Update Contact
                updateSummary('phone', '.contact-summary .detail-group:nth-child(2)');

                // Update Email
                updateSummary('email', '.contact-summary .detail-group:nth-child(3)');

                // Update Device Type
                updateSummary('device-type', '.device-summary .detail-group:nth-child(1)');

                // Update Brand
                updateSummary('brand', '.device-summary .detail-group:nth-child(2)');

                // Update Model
                updateSummary('device-model', '.device-summary .detail-group:nth-child(3)');

                // Update Serial Number
                updateSummary('serial-number', '.device-summary .detail-group:nth-child(4)');

                // Update Request Date
                updateSummary('appointment-date', '.schedule-summary .detail-group:nth-child(1)');

                // Update Request Time
                updateSummary('appointment-time', '.schedule-summary .detail-group:nth-child(2)');

                // Update Urgency Level
                updateSummary('urgency-level', '.schedule-summary .detail-group:nth-child(3)');

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
