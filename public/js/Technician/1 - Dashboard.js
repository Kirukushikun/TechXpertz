//getting all view buttons
const viewDetails = document.querySelectorAll('button.view-details');

//Then for each buttons we will give them onclick functions that will pass on the id on a specific function
viewDetails.forEach(button => {
    button.addEventListener('click', function (){
        const appointmentID = this.getAttribute('data-appointment-id');
        fetchAppointmentDetails(appointmentID);
        console.log('button is working', appointmentID);
    });
});

// Fetch appointment details from the given id
function fetchAppointmentDetails(appointmentID) {
    // Insert repairID dynamically into the URL
    fetch(`/technician/appointment/details/${appointmentID}`)
        .then(response => response.json())
        .then(data => {
            displayModal(data);
        })
}

// After successfully fetching we will display those data
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


//APPOINTMENT ACTION 
const appointmentActions = document.querySelectorAll('a.appointment-btn');

appointmentActions.forEach(button => {
    button.addEventListener('click', function (){
        const appointmentID = this.getAttribute('data-appointment-id');
        const customerID = this.getAttribute('data-customer-id');
        const appointmentSTATUS = this.getAttribute('data-appointment-status');
        verifyChanges(appointmentID, appointmentSTATUS, customerID);
        console.log('button is working', appointmentID, appointmentSTATUS);
    });
});

function verifyChanges(appointmentID, appointmentSTATUS, customerID){
    const modal = document.getElementById('modal');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    if(appointmentSTATUS === "cancel"){
        modal.innerHTML = `
            <form action="/technician/appointment/${appointmentSTATUS}/${appointmentID}" method="POST">
                <input type="hidden" name="_token" value="${csrfToken}">
                <input type="hidden" name="_method" value="PATCH">

                <div class="modal-verification">
                    <i class="fa-solid fa-triangle-exclamation" id="exclamation"></i>
                    <div class="verification-message">
                        <h2>Cancel Appointment</h2>
                        <p>Are you sure you want to Cancel this appointment?</p>                        
                    </div>
                    <div class="verification-action">
                        <button type="submit" class="danger">Confirm Cancellation</button>
                        <button type="button" class="normal"><b>Dismiss</b></button>
                    </div>
                </div>                 
            </form>
        `;   
    }else if(appointmentSTATUS === "repair"){
        modal.innerHTML = `
            <form action="/technician/repairstatus/create/${appointmentID}/${customerID}" method="POST">
                <input type="hidden" name="_token" value="${csrfToken}">
                <div class="modal-verification">
                    <i class="fa-solid fa-screwdriver-wrench" id="repair"></i>
                    <div class="verification-message">
                        <h2>Start Repair</h2>
                        <p>Are you sure you want to start the repair for this appointment?</p>             
                    </div>
                    <div class="verification-content">
                        <h3>Additional Details</h3>
                        <div class="row">
                            <div class="form-group">
                                <label for="paid_status">Paid Status</label>
                                <select id="paid_status" name="paid_status">
                                    <option value="Unpaid">Unpaid</option>
                                    <option value="Initially Paid">Initially Paid</option>
                                    <option value="Fully Paid">Fully Paid</option>
                                </select>
                            </div>                            
                        </div>
                        <!-- Only accept number -->
                        <div class="row">
                            <div class="form-group">
                                <label for="revenue">Repair Cost (Optional)</label>
                                <input type="text" id="revenue" name="revenue">
                            </div>
                            <div class="form-group">
                                <label for="expenses">Expenses (Optional)</label>
                                <input type="text" id="expenses" name="expenses"> 
                            </div>                                
                        </div>                      
                    </div>

                    <div class="verification-action">
                        <button type="submit" class="submit">Confirm Start</button>
                        <button type="button" class="normal"><b>Dismiss</b></button>
                    </div>

                    <p class="note"><b>Note: </b>Do not start the repair unless the device has been dropped off.<br>Starting the repair will automatically notify the customer that the device has been received.</p>   
                </div>                 
            </form>
        `;   
    }

    // Show the modal
    modal.classList.add("active");

    // Close modal when 'X' is clicked
    document.querySelector('.normal').onclick = function () {
        modal.classList.remove("active");
    };
}