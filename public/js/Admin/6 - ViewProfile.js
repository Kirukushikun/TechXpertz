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

//Disciplinary Button
let disciplinaryButton = document.querySelector('button.disiplinary-btn');

disciplinaryButton.addEventListener('click', function(){
    let technicianID = this.getAttribute('data-technician-id');
    modal.innerHTML = `
        <form action="/admin/viewprofile/discipline/${technicianID}" method="POST">
            <input type="hidden" name="_token" value="${csrfToken}">
            <div class="modal-verification">
                <i class="fa-solid fa-xmark close icon-close"></i>
                <i class="fa-solid fa-screwdriver-wrench sign-primary"></i>
                <div class="verification-message">
                    <h2>Add Violation Record</h2>
                    <p>Please confirm and log the disciplinary action details for this incident.</p>             
                </div>
                <div class="verification-content">
                    <div class="row">
                        <div class="form-group">
                            <label for="violation_level">Violation Level</label>
                            <input type="text" id="violation_level" name="violation_level" readonly />
                        </div>   
                        <div class="form-group">
                            <label for="violation_status">Violation Status</label>
                            <select id="violation_status" name="violation_status">
                                <option value="Pending">Pending</option>
                                <option value="Warning Issued">Warning Issued</option>
                                <option value="Under Investigation">Under Investigation</option>
                                <option value="Suspended">Suspended</option>
                                <option value="Solved">Solved</option>
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="date_of_incident">Date of Incident</label>
                            <input type="date" id="date_of_incident" name="date_of_incident" required/>
                        </div>                         
                    </div>
                    
                    <div class="row">
                        <div class="form-group">
                            <label for="violation_header">Violation Header</label>
                            <select id="violation_header" name="violation_header" required>
                                <option value="">Select Violation</option>
                                <option value="Unprofessional Conduct">Unprofessional Conduct</option>
                                <option value="No-Show for Scheduled Appointment">No-Show for Scheduled Appointment</option>
                                <option value="Misleading Information">Misleading Information</option>
                                <option value="Inappropriate Communication">Inappropriate Communication</option>
                                <option value="Repeated Appointment Cancellations">Repeated Appointment Cancellations</option>
                                <option value="Customer Privacy Violation">Customer Privacy Violation</option>
                                <option value="Excessive Delay in Response">Excessive Delay in Response</option>
                                <option value="Fraudulent Activity">Fraudulent Activity</option>
                                <option value="Incomplete Work">Incomplete Work</option>
                                <option value="Repeated Customer Complaints">Repeated Customer Complaints</option>
                                <option value="Failure to Follow Platform Policies">Failure to Follow Platform Policies</option>
                                <option value="Damaged Equipment or Property">Damaged Equipment or Property</option>
                                <option value="Harassment or Discrimination">Harassment or Discrimination</option>
                                <option value="Unethical Behavior">Unethical Behavior</option>
                                <option value="Unauthorized Account Access">Unauthorized Account Access</option>
                                <option value="Refusal to Cooperate with Investigation">Refusal to Cooperate with Investigation</option>
                            </select>
                        </div>                               
                    </div> 
                    <div class="row">
                        <div class="form-group">
                            <label for="violation_description">Violation Description</label>
                            <textarea id="violation_description" name="violation_description" disabled></textarea>
                        </div>
                    </div>                     
                </div>

                <div class="verification-action">
                    <button type="submit" class="btn-primary">Submit Record</button>
                    <button type="button" class="close btn-normal"><b>Dismiss</b></button>
                </div>

                <p class="note"><b>Note: </b>This action will notify the technician and will be recorded in their profile.</p>   
            </div> 
        </form>
    `;

    modal.classList.add("active");

    populateViolationInput();

    // Close modal when 'X' is clicked
    document.querySelectorAll('.close').forEach(button => {
        button.onclick = function () {
            modal.classList.remove("active");
        };
    });
});

//Update Disiplinary Button
let updateDisciplinaryButtons = document.querySelectorAll('button.update-record-btn');
updateDisciplinaryButtons.forEach(button => {
    button.addEventListener('click', function(){
        let technicianID = this.getAttribute('data-technician-id');
        let action = this.getAttribute('data-action-type');

        if(action == 'update'){
            modal.innerHTML = `
                <form method="POST">
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <div class="modal-verification">
                        <i class="fa-solid fa-xmark close icon-close"></i>
                        <i class="fa-solid fa-screwdriver-wrench sign-primary"></i>
                        <div class="verification-message">
                            <h2>Update Violation Record</h2>
                            <p>Please confirm and log the disciplinary action details for this incident.</p>             
                        </div>
                        <div class="verification-content">
                            <div class="row">
                                <div class="form-group">
                                    <label for="violation_level">Violation Level</label>
                                    <input type="text" id="violation_level" name="violation_level" readonly />
                                </div>   
                                <div class="form-group">
                                    <label for="violation_status">Violation Status</label>
                                    <select id="violation_status" name="violation_status">
                                        <option value="Pending">Pending</option>
                                        <option value="Warning Issued">Warning Issued</option>
                                        <option value="Under Investigation">Under Investigation</option>
                                        <option value="Suspended">Suspended</option>
                                        <option value="Solved">Solved</option>
                                    </select>
                                </div> 
                                <div class="form-group">
                                    <label for="date_of_incident">Date of Incident</label>
                                    <input type="date" id="date_of_incident" name="date_of_incident" required/>
                                </div>                         
                            </div>
                            

                            
                            <div class="row">
                                <div class="form-group">
                                    <label for="violation_header">Violation Header</label>
                                    <select id="violation_header" name="violation_header" required>
                                        <option value="">Select Violation</option>
                                        <option value="Unprofessional Conduct">Unprofessional Conduct</option>
                                        <option value="No-Show for Scheduled Appointment">No-Show for Scheduled Appointment</option>
                                        <option value="Misleading Information">Misleading Information</option>
                                        <option value="Inappropriate Communication">Inappropriate Communication</option>
                                        <option value="Repeated Appointment Cancellations">Repeated Appointment Cancellations</option>
                                        <option value="Customer Privacy Violation">Customer Privacy Violation</option>
                                        <option value="Excessive Delay in Response">Excessive Delay in Response</option>
                                        <option value="Fraudulent Activity">Fraudulent Activity</option>
                                        <option value="Incomplete Work">Incomplete Work</option>
                                        <option value="Repeated Customer Complaints">Repeated Customer Complaints</option>
                                        <option value="Failure to Follow Platform Policies">Failure to Follow Platform Policies</option>
                                        <option value="Damaged Equipment or Property">Damaged Equipment or Property</option>
                                        <option value="Harassment or Discrimination">Harassment or Discrimination</option>
                                        <option value="Unethical Behavior">Unethical Behavior</option>
                                        <option value="Unauthorized Account Access">Unauthorized Account Access</option>
                                        <option value="Refusal to Cooperate with Investigation">Refusal to Cooperate with Investigation</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="offense_number">Offense Number</label>
                                    <select id="offense_number" name="offense_number">
                                        <option value="First Offense">First Offense</option>
                                        <option value="Second Offense">Second Offense</option>
                                        <option value="Third Offense">Third Offense</option>
                                        <option value="Fourth Offense">Fourth Offense</option>
                                        <option value="Fifth Offense">Fifth Offense</option>
                                    </select>
                                </div> 
                            </div> 
                            <div class="row">
                                <div class="form-group">
                                    <label for="violation_description">Violation Description</label>
                                    <textarea id="violation_description" name="violation_description" disabled></textarea>
                                </div>
                            </div>                     
                        </div>

                        <div class="verification-action">
                            <button type="submit" class="btn-primary">Submit Record</button>
                            <button type="button" class="close btn-normal"><b>Dismiss</b></button>
                        </div>

                        <p class="note"><b>Note: </b>This action will notify the technician and will be recorded in their profile.</p>   
                    </div> 
                </form>
            `;
        }else{
            modal.innerHTML = `
                <form method="POST">
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <div class="modal-verification">
                        <i class="fa-solid fa-xmark close icon-close"></i>
                        <i class="fa-solid fa-screwdriver-wrench sign-primary"></i>
                        <div class="verification-message">
                            <h2>Add Violation Record</h2>
                            <p>Please confirm and log the disciplinary action details for this incident.</p>             
                        </div>
                        <div class="verification-content">


                            <div class="row">
                                <div class="form-group">
                                    <label for="date_of_incident">Resolution Date</label>
                                    <input type="date" id="date_of_incident" name="date_of_incident" required/>
                                </div>                         
                            </div>
                            
                            <div class="row">
                                <div class="form-group">
                                    <label for="violation_description">Action Taken</label>
                                    <textarea id="violation_description" name="violation_description"></textarea>
                                </div>
                            </div>                     
                        </div>

                        <div class="verification-action">
                            <button type="submit" class="btn-primary">Submit Record</button>
                            <button type="button" class="close btn-normal"><b>Dismiss</b></button>
                        </div>

                        <p class="note"><b>Note: </b>This action will notify the technician and will be recorded in their profile.</p>   
                    </div> 
                </form>
            `;
        }


    
        modal.classList.add("active");
    
        // Close modal when 'X' is clicked
        document.querySelectorAll('.close').forEach(button => {
            button.onclick = function () {
                modal.classList.remove("active");
            };
        });
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
            <form action="/admin/viewprofile/${userType}/${userID}/${actionType}" method="POST">        
                <input type="hidden" name="_token" value="${csrfToken}">
                <input type="hidden" name="_method" value="PATCH">

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
                        <button type="submit" class="btn-success">Terminate</button>
                        <button type="button" class="close btn-normal"><b>Dismiss</b></button>
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
                        <button type="submit" class="btn-danger">Terminate</button>
                        <button type="button" class="close btn-normal"><b>Dismiss</b></button>
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

function populateViolationInput() {
    let violationHeader = document.getElementById('violation_header');
    let violationLevelInput = document.getElementById('violation_level');
    let violationDescriptionInput = document.getElementById('violation_description');

    let violationDescription = {
        "Unprofessional Conduct": "Technician engaged in rude or unprofessional behavior towards a customer.",
        "No-Show for Scheduled Appointment": "Technician failed to appear for an appointment without prior notice or valid reason.",
        "Misleading Information": "Technician provided inaccurate or misleading information in their profile or service description.",
        "Inappropriate Communication": "Technician sent inappropriate or offensive messages to a customer.",
        "Repeated Appointment Cancellations": "Technician frequently canceled appointments, causing inconvenience to customers.",
        "Customer Privacy Violation": "Technician mishandled or disclosed customer personal information without consent.",
        "Excessive Delay in Response": "Technician repeatedly delayed responses to customer messages or requests.",
        "Fraudulent Activity": "Technician engaged in deceptive practices or fraud, such as false reviews.",
        "Incomplete Work": "Technician failed to complete a service after accepting an appointment.",
        "Repeated Customer Complaints": "Technician received multiple complaints from customers regarding service quality.",
        "Failure to Follow Platform Policies": "Technician did not comply with the platform's rules and guidelines.",
        "Damaged Equipment or Property": "Technician caused damage to customer equipment or property during service.",
        "Harassment or Discrimination": "Technician engaged in harassing or discriminatory behavior towards a customer.",
        "Unethical Behavior": "Technician engaged in dishonest or unethical practices, affecting the platform's integrity.",
        "Unauthorized Account Access": "Technician attempted unauthorized access to another user’s account or data.",
        "Refusal to Cooperate with Investigation": "Technician refused to cooperate or provide necessary information during a platform investigation.",
    };
    
    let violationLevel = {
        "Unprofessional Conduct": "Moderate",
        "No-Show for Scheduled Appointment": "Minor",
        "Misleading Information": "Moderate",
        "Inappropriate Communication": "Severe",
        "Repeated Appointment Cancellations": "Moderate",
        "Customer Privacy Violation": "Critical",
        "Excessive Delay in Response": "Minor",
        "Fraudulent Activity": "Critical",
        "Incomplete Work": "Severe",
        "Repeated Customer Complaints": "Severe",
        "Failure to Follow Platform Policies": "Minor",
        "Damaged Equipment or Property": "Severe",
        "Harassment or Discrimination": "Critical",
        "Unethical Behavior": "Critical",
        "Unauthorized Account Access": "Critical",
        "Refusal to Cooperate with Investigation": "Severe",
    };

    // Update fields when violationHeader changes
    violationHeader.addEventListener('change', function() {
        let selectedViolation = violationHeader.value;
        if(selectedViolation){
            violationLevelInput.disabled = false;
            violationDescriptionInput.disabled = false;

            // Set the values for level and description based on the selected violation
            violationLevelInput.value = violationLevel[selectedViolation] || "";
            violationDescriptionInput.value = violationDescription[selectedViolation] || "";

        }else{
            violationLevelInput.disabled = true;
            violationDescriptionInput.disabled = true;

                        // Set the values for level and description based on the selected violation
            violationLevelInput.value = "";
            violationDescriptionInput.value = "";
        }

    });
}