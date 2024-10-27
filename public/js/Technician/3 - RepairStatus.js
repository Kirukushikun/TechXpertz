//TAB FUNCTION
const tabs = document.querySelectorAll('.tab-link');
const contents = document.querySelectorAll('.tab-content-item');

tabs.forEach(tab => {
    tab.addEventListener('click', function() {
        // Remove active class from all tabs and contents
        tabs.forEach(t => t.classList.remove('active'));
        contents.forEach(c => c.classList.remove('active'));
        
        // Add active class to the clicked tab and corresponding content
        this.classList.add('active');
        document.getElementById(this.dataset.tab).classList.add('active');
    });
});


//UPDATE BUTTON FUNCTION
const updateStatusButtons = document.querySelectorAll('a.update-btn');
        
updateStatusButtons.forEach(button => {
    button.addEventListener('click', function (){
        const repairID = this.getAttribute('data-repair-id');
        const customerID = this.getAttribute('data-customer-id');
        fetchRepairData(repairID, customerID);
        console.log('button is working', repairID);
    });
});

function fetchRepairData(repairID, customerID){
    try{
        // Insert repairID dynamically into the URL
        fetch(`/technician/repairstatus/details/${repairID}`)
        .then(response => response.json())
        .then(data => {
            updateStatusForm(data, repairID, customerID);
            
        })
    } catch (error){
        // Catch any errors (network, HTTP errors, etc.)
        console.error('Error:', error);
    }

}

function updateStatusForm(data, repairID, customerID){
    const modal = document.getElementById('modal');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const action = 'Update';

    modal.innerHTML = `
    <form  action="/technician/repairstatus/update/${repairID}/${customerID}/${action}" method="POST">
    <input type="hidden" name="_token" value="${csrfToken}">
    <input type="hidden" name="_method" value="PATCH">

        <div class="modal-verification">
            <div class="update-content">
                <div class="header">
                    <h2>Payment Information </h2>
                    <i class="fa-solid fa-circle-exclamation" title="Payment Information is visible to you only" id="info"></i>
                </div>
                <div class="form-group">
                    <label for="paid_status">Paid Status</label>
                    <select id="paid_status" name="paid_status" class="paid_status" required>
                        <option value="${data.paid_status}">${data.paid_status}</option>
                    </select>
                </div> 

                <div class="row">
                    <div class="form-group">
                        <label for="revenue">Revenue</label>
                        <input type="text" id="revenue" name="revenue" value="${data.revenue}">
                    </div>
                    <div class="form-group">
                        <label for="expenses">Expenses</label>
                        <input type="text" id="expenses" name="expenses" value="${data.expenses}"> 
                    </div>                            
                </div>
                
                <h2>Repair Information</h2>
                <div class="repair-information">
                    <div class="row">
                        <div class="form-group">
                            <label for="repair_status">Repair Status</label>
                            <select id="repair_status" name="repair_status" class="repair_status">
                                <option value="${data.repairstatus}">${data.repairstatus}</option>
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="repair_status_conditional">Repair Status (Conditional)</label>
                            <select id="repair_status_conditional" name="repair_status_conditional" class="repair_status_conditional">
                                <option value="${data.repairstatus_conditional}">${data.repairstatus_conditional}</option>
                            </select>
                        </div>                                    
                    </div>
                                
                    <div class="form-group">
                        <label for="repairstatus_message">Repair Status Message</label>
                        <textarea type="text" id="repairstatus_message" name="repairstatus_message" required></textarea>
                    </div>                          
                </div>
            </div>

            <div class="update-action">
                <button type="submit" class="submit">Confirm Repair Update</button>
                <button type="button" class="normal"><b>Dismiss</b></button>
            </div>

            <div class="reminder">
                <p><b>Reminder: </b> Updating the repair status will notify the customer of the progress. Ensure the information is accurate before proceeding,<br> as this action cannot be undone or reverted to a previous step.</p>
            </div>
        </div>                 
    </form>
    `;

    // Show the modal
    modal.classList.add("active");          
    // Close modal when 'X' is clicked
    document.querySelector('.normal').onclick = function () {
        modal.classList.remove("active");
    };

    //Run or access these functions upon opening the update modal
    populateSelectInputs();
    repopulateSelectInputs();
    if(data.repairstatus_conditional){
        conditionalMessages(data.repairstatus_conditional);
    }else{
        generateMessages(data.repairstatus);
    }
}

//POPULATE FUNCTIONS
// Function to populate select inputs with options
function populateSelectInputs() {
    const paidStatusOptions = [
        "Fully Paid",
        "Initially Paid",
        "Unpaid"
    ];

    const repairStatusOptions = [
        "Device Dropped Off",
        "Diagnosis In Progress",
        "Repair In Progress",
        "Waiting For Parts",
        "Repair Completed",
        "Ready For Pickup",
        "Device Collected"
    ];

    const repairStatusConditionalOptions = {
        "Diagnosis In Progress": [
            "Extended Diagnostic Process",
            "Unable to Diagnose"
        ],
        "Repair In Progress": [
            "Unexpected Complications in Repair",
            "Additional Issues Found"
        ],
        "Waiting For Parts": [
            "Delay in Parts Shipment",
            "Part Unavailability"
        ],
        "Repair Completed": [
            "Device Requires Additional Testing"
        ],
        "Ready For Pickup": [
            "Last-minute Check Revealed an Issue"
        ],
    };

    const selectClasses = ["paid_status", "repair_status", "repair_status_conditional"];

    selectClasses.forEach(className => {

        const selects = document.querySelectorAll(`.${className}`);

        selects.forEach(select => {
            // Get the corresponding options array based on the class name
            let optionsArray;
            if (className === "paid_status") {
                optionsArray = paidStatusOptions;
            } else if (className === "repair_status") {
                optionsArray = repairStatusOptions;
            } else if (className === "repair_status_conditional") {
                // Get conditional options based on the selected repair status
                optionsArray = repairStatusConditionalOptions[document.getElementById('repair_status').value] || [];
            }

            // Preserve the existing selected value
            const savedValue = select.value;
            select.innerHTML = '';

            if(className === "repair_status_conditional"){
                const repairstatusValue = document.getElementById('repair_status').value;
                const repairstatusConditional = document.getElementById('repair_status_conditional');

                if(repairstatusValue === "Device Dropped Off" || repairstatusValue === "Device Collected"){
                    // Add No available conditional status option at the top
                    const emptyOption = document.createElement("option");
                    emptyOption.value = 'No available conditional status';
                    emptyOption.textContent = 'No available conditional status';
                    select.appendChild(emptyOption);
                    repairstatusConditional.disabled = true;
                    
                }else{
                    // Add an empty option at the top
                    const emptyOption = document.createElement("option");
                    emptyOption.value = '';
                    emptyOption.textContent = '';
                    select.appendChild(emptyOption);   
                    repairstatusConditional.disabled = false;                         
                }
            }

            // Add each option from the array
            optionsArray.forEach(option => {
                const newOption = document.createElement("option");
                newOption.value = option;
                newOption.textContent = option;

                // Set the saved value as selected if it matches
                if (option === savedValue) {
                    newOption.selected = true;
                }

                select.appendChild(newOption);
            });
        });
    });
}

function repopulateSelectInputs(){
    // Get references to elements
    const repairStatusSelects = document.getElementById('repair_status');
    const repairStatusConditional = document.getElementById('repair_status_conditional');

    repairStatusSelects.addEventListener('change', function(){
        const repairStatus = repairStatusSelects.value;                  
        populateSelectInputs();
        generateMessages(repairStatus);
    });

    repairStatusConditional.addEventListener('change', function(){
        const repairStatus = repairStatusConditional.value;                  
        populateSelectInputs();
        conditionalMessages(repairStatus);
    });
}

function generateMessages(repairStatus){
    const repairstatusMessage = document.getElementById('repairstatus_message');

    // Define repair status messages
    const messages = {
        'Device Dropped Off': 'We’ve received your device at our repair shop/center. We are now preparing to begin the diagnostic process to determine the necessary repairs.',
        'Diagnosis In Progress': 'Our technicians are now conducting a thorough diagnosis of your device. This process helps us pinpoint the exact issue and recommend the best possible repair solution. Once the diagnosis is complete, we’ll update you as soon as possible.',
        'Repair In Progress': 'We’ve started working on the repairs for your device. Our skilled technicians are diligently addressing the issues identified during the diagnostic phase. We’ll continue to keep you updated on the progress and notify you as soon as possible.',
        'Waiting For Parts': 'The repair process is currently paused as we are awaiting specific parts necessary to complete the job. We’re working to secure the required components as quickly as possible. We’re ready to resume the repair work as soon as the parts have arrived. Thank you for your patience during this time.',
        'Repair Completed': 'We’re pleased to inform you that the repair of your device has been successfully completed. Our technicians have tested it thoroughly to ensure that everything is working as expected. We’ll now proceed with a final quality check before we notify you that your device is ready for pickup. Thanks for your patience!',
        'Ready For Pickup': 'Your device is now fully repaired and ready for pickup! You can visit our repair shop at your convenience to collect it. Please make sure to bring any necessary identification or paperwork when you arrive. If you have any further questions or concerns, we’re happy to assist you. Thank you for choosing our service!',
        'Device Collected': 'Thank you for picking up your device! We hope the repairs have met your expectations and that your device is now functioning perfectly. If you encounter any issues or need further assistance, don’t hesitate to reach out. We appreciate your business and look forward to serving you again in the future.'
    };

    // Set the message if the repair status is found in the messages object
    repairstatusMessage.value = messages[repairStatus] || '';
}

function conditionalMessages(conditionalStatus){
    const conditionalMessage = document.getElementById('repairstatus_message');

    const messages = {
        'Extended Diagnostic Process': 'We are still conducting a thorough diagnosis of your device. Unfortunately, the process is taking longer than anticipated due to the complexity of the issue. We will update you as soon as we have more information.',
        'Unable to Diagnose': 'We are experiencing difficulties in diagnosing the exact issue with your device. We may need additional time or further investigation. We will keep you informed of any necessary steps to continue.',
        'Unexpected Complications in Repair': 'While working on your device, we encountered an unexpected issue that requires more time than originally estimated. Our technician is doing their best to resolve the issue and will keep you updated.',
        'Additional Issues Found': 'During the repair process, we discovered additional issues with your device that were not initially detected. We will reach out to you with details about the extra repairs needed and get your approval before proceeding.',
        'Delay in Parts Shipment': 'We are currently waiting for the necessary parts to arrive for your repair. Unfortunately, there has been a delay in the shipment of these parts. We are doing everything we can to expedite the process and will inform you once we receive them.',
        'Part Unavailability': 'We regret to inform you that the part required for your repair is temporarily unavailable. We are actively looking for alternatives and will update you on the expected delivery time as soon as possible.',
        'Device Requires Additional Testing': 'Although we have completed the repairs on your device, we need to conduct additional testing to ensure that everything is functioning as expected. We will notify you once your device is ready for pickup.',
        'Last-minute Check Revealed an Issue': 'Before handing your device back, our team performed a final quality check and discovered a minor issue that needs to be addressed. We are working on it now and will let you know when the device is truly ready for pickup.',
        'Post-Repair Issue': 'We understand you’ve encountered an issue with your device after the repair. Please return the device to our shop, and we will inspect and resolve the problem promptly, free of charge.'
    };

    conditionalMessage.value = messages[conditionalStatus] || '';
}

//TERMINATE BUTTON FUNCATION
const terminateButtons = document.querySelectorAll('a.terminate-btn');

terminateButtons.forEach(button =>{
    button.addEventListener('click', function(){
        const repairID = this.getAttribute('data-repair-id');
        const customerID = this.getAttribute('data-customer-id');

        verifyTermination(repairID, customerID);
        console.log('button is working', repairID);
    });
});

function verifyTermination(repairID, customerID){
    const modal = document.getElementById('modal');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const action = "Terminate";

    modal.innerHTML = `
    <form action="/technician/repairstatus/update/${repairID}/${customerID}/${action}" method="POST">
        <input type="hidden" name="_token" value="${csrfToken}">
        <input type="hidden" name="_method" value="PATCH">

        <div class="modal-verification">
            <i class="fa-solid fa-screwdriver-wrench" id="exclamation"></i>
            <div class="verification-message">
                <h2>Terminate Repair</h2>
                <p>Are you sure you want to Terminate this repair? <br> This action cannot be undone.</p>                        
            </div>
            <div class="form-group">
                <label for="terminate_message" class="terminate_message">Termination notify message:</label>
                <textarea name="terminate_message" id="terminate_message" class="terminate_message">We regret to inform you that we are unable to proceed with the repair of your device due to unforeseen complications. Please arrange to collect your device at your earliest convenience, and feel free to reach out if you need further assistance.</textarea>
            </div>
            <div class="verification-action">
                <button type="submit" class="danger">Terminate</button>
                <button type="button" class="close"><b>Dismiss</b></button>
            </div>
        </div>                 
    </form>
    `;

    // Show the modal
    modal.classList.add("active");

    // Close modal when 'X' is clicked
    document.querySelector('.close').onclick = function () {
        modal.classList.remove("active");
    };
}

//ADD WALKINS BUTTONS
const addrepairBtn = document.querySelector('a.add-repair');

addrepairBtn.addEventListener('click', function(e){
    e.preventDefault();

    const modal = document.getElementById('modal');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    console.log('button is working');

    modal.innerHTML = `
    <form action="/technician/repairstatus/create/walk-ins" method="POST" class="modal-content" id="modal-content">
        <input type="hidden" name="_token" value="${csrfToken}">

        <div class="modal-body">
            <div class="left">
                <div class="form-section">
                    <h2>Customer Details</h2>
                    <div class="row">
                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input type="text" id="fullname" name="fullname" required>
                        </div>                                
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="contact">Mobile Phone Number</label>
                            <input type="tel" id="contact" name="contact" required> 
                        </div>                                
                    </div>
                </div>

                <div class="form-section">
                    <h2>Payment Information</h2>

                    <div class="form-group">
                        <label for="payment-status">Payment Status</label>
                        <select id="payment-status" name="payment-status">
                            <option value="Unpaid">Unpaid</option>
                            <option value="Initially Paid">Initially Paid</option>
                            <option value="Fully Paid">Fully Paid</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="revenue">Repair Cost</label>
                            <input type="number" id="revenue" name="revenue">
                        </div>
                        <div class="form-group">
                            <label for="expenses">Expenses</label>
                            <input type="number" id="expenses" name="expenses">
                        </div>                                
                    </div>


                </div>  

                <div class="form-section">
                    <h2>Device Information</h2>
                    <div class="row">
                        <div class="form-group">
                            <label for="device-type">Device Type</label>
                            <select type="text" id="device-type" name="device-type" required>
                                <option value="Smartphone">Smartphone</option>
                                <option value="Tablet">Tablet</option>
                                <option value="Desktop">Desktop</option>
                                <option value="Laptop">Laptop</option>
                                <option value="Smartwatch">Smartwatch</option>
                                <option value="Camera">Camera</option>
                                <option value="Printer">Printer</option>
                                <option value="Speaker">Speaker</option>
                                <option value="Drone">Drone</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="device-brand">Device Brand</label>
                            <input type="text" id="device-brand" name="device-brand" required>
                        </div>                                
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="device-model">Device Model</label>
                            <input type="text" id="device-model" name="device-model" required>
                        </div>
                        <div class="form-group">
                            <label for="serial-number">Serial Number</label>
                            <input type="text" id="serial-number" name="serial-number">
                        </div>                                
                    </div>
                </div> 
            </div>

            <div class="right">
                <div class="form-section excluded">
                    <h2>Device Issue</h2>
                    <div class="form-group-excluded">
                        <label for="issue-description">Description of Issue</label>
                        <textarea id="issue-description" name="issue-description"></textarea>
                    </div>
                    <div class="form-group-excluded">
                        <label for="error-message">Error Messages</label>
                        <textarea id="error-message" name="error-message"></textarea>
                    </div>
                    <div class="form-group-excluded">
                        <label for="previous-steps">Previous Repair Attempts</label>
                        <textarea id="previous-steps" name="previous-steps"></textarea>
                    </div>
                    <div class="form-group-excluded">
                        <label for="recent-events">Recent Changes or Events</label>
                        <textarea id="recent-events" name="recent-events"></textarea>
                    </div>
                    <div class="form-group-excluded">
                        <label for="prepared-parts">Parts Prepared for Repair</label>
                        <textarea id="prepared-parts" name="prepared-parts"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-action">
            <button type="submit" class="submit">Add Repair</button>
            <button type="button" class="close">Close</button>
        </div>
    </form>
    `;

    // Show the modal
    modal.classList.add("active");          
    // Close modal when 'X' is clicked
    document.querySelector('.close').onclick = function () {
        modal.classList.remove("active");
    };

});


//VIEW DETAIL BUTTON
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
    try {
        // Insert repairID dynamically into the URL
        fetch(`/technician/appointment/details/${appointmentID}`)
            .then(response => response.json())
            .then(data => {
                displayModal(data);
            })
    } catch (error) {
        // Catch any errors (network, HTTP errors, etc.)
        console.error('Error:', error);
    }
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