const tabs = document.querySelectorAll(".tab-link");
const tabContentItems = document.querySelectorAll(".tab-content-item");
const searchInput = document.getElementById("search-input");
const itemsPerPage = 8; // Define how many items per page
let currentPage = 1; // Initial page number
let activeTab = "request"; // Default active tab

const filterPanel = document.getElementById('filter-panel');
const filterBtn = document.getElementById('filter-btn');
const rows = document.querySelectorAll('.appointment-row'); // Select rows by class for flexibility

// Toggle filter panel visibility
filterBtn.addEventListener('click', function () {
    filterPanel.style.display = filterPanel.style.display === 'block' ? 'none' : 'block';
});

// Function to display items for a specific tab and page with filters applied
function displayTabContent(tab, page = 1, search = "", filters = {}) {
    const table = document.getElementById(`${tab}-table`);
    if (!table) return;

    const rows = Array.from(table.querySelector("tbody").rows);

    // Apply search filter
    let filteredRows = search
        ? rows.filter(row => row.textContent.toLowerCase().includes(search.toLowerCase()))
        : rows;

    // Apply sorting filter if applicable, only to rows with .name-column
    if (filters.order) {
        filteredRows = filteredRows.filter(row => row.querySelector(".name-column")); // Keep rows with .name-column
        filteredRows.sort((a, b) => {
            const nameA = a.querySelector(".name-column").textContent.trim().toLowerCase();
            const nameB = b.querySelector(".name-column").textContent.trim().toLowerCase();
            return filters.order === "ascending" ? nameA.localeCompare(nameB) : nameB.localeCompare(nameA);
        });
    }

    // Filter by month if a month filter is provided
    if (filters.month) {
        filteredRows = filteredRows.filter(row => {
            const rowMonth = row.querySelector(".month-column")?.dataset.month.split("-")[1]; // Extract month part
            return rowMonth === filters.month;
        });
    }

    // Filter by day if a day filter is provided
    if (filters.day !== undefined && filters.day !== "") {
        filteredRows = filteredRows.filter(row => {
            const day = new Date(row.querySelector(".month-column")?.dataset.day).getDay();
            return day.toString() === filters.day;
        });
    }

    // Filter by time range if both timeFrom and timeTo filters are provided
    if (filters.timeFrom && filters.timeTo) {
        filteredRows = filteredRows.filter(row => {
            const time = row.querySelector(".time-column")?.dataset.time;
            return time >= filters.timeFrom && time <= filters.timeTo;
        });
    }

    // Pagination logic
    const totalItems = filteredRows.length;
    const start = (page - 1) * itemsPerPage;
    const end = page * itemsPerPage;

    // Hide all rows initially, then show only rows in the current page's range
    rows.forEach(row => row.style.display = "none");
    filteredRows.slice(start, end).forEach(row => row.style.display = "");

    // Update pagination controls with the current page and total pages
    renderPagination(tab, page, Math.ceil(totalItems / itemsPerPage));
}

// Function to switch active tab
function switchTab(tab) {
    activeTab = tab;
    currentPage = 1; // Reset page to the first page

    // Toggle active class for tabs and tab content
    tabs.forEach(t => t.classList.toggle("active", t.dataset.tab === tab));
    tabContentItems.forEach(content => content.classList.toggle("active", content.id === tab));

    // Display content for the current tab
    displayTabContent(tab, currentPage, searchInput.value.trim(), getFilterValues());
}

// Function to render pagination
function renderPagination(tab, currentPage, totalPages) {
    const paginationContainer = document.querySelector(`#${tab} .pagination`);
    paginationContainer.innerHTML = "";

    const maxPagesToShow = 5;
    let startPage = Math.max(1, currentPage - Math.floor(maxPagesToShow / 2));
    let endPage = startPage + maxPagesToShow - 1;

    if (endPage > totalPages) {
        endPage = totalPages;
        startPage = Math.max(1, endPage - maxPagesToShow + 1);
    }

    if (currentPage > 1) {
        const prevButton = document.createElement("button");
        prevButton.innerHTML = '<i class="fa-solid fa-caret-left"></i>';
        prevButton.addEventListener("click", () => {
            currentPage -= 1;
            displayTabContent(tab, currentPage, searchInput.value.trim(), getFilterValues());
        });
        paginationContainer.appendChild(prevButton);
    }

    for (let i = startPage; i <= endPage; i++) {
        const pageButton = document.createElement("button");
        pageButton.textContent = i;
        pageButton.classList.toggle("active", i === currentPage);
        pageButton.addEventListener("click", () => {
            currentPage = i;
            displayTabContent(tab, currentPage, searchInput.value.trim(), getFilterValues());
        });
        paginationContainer.appendChild(pageButton);
    }

    if (currentPage < totalPages) {
        const nextButton = document.createElement("button");
        nextButton.innerHTML = '<i class="fa-solid fa-caret-right"></i>';
        nextButton.addEventListener("click", () => {
            currentPage += 1;
            displayTabContent(tab, currentPage, searchInput.value.trim(), getFilterValues());
        });
        paginationContainer.appendChild(nextButton);
    }
}

// Function to get values from filters
function getFilterValues() {
    return {
        order: document.getElementById("alphabetical-order").value,
        month: document.getElementById("month-filter").value,
        day: document.getElementById("day-of-week-filter").value,
        timeFrom: document.getElementById("filter-time-from").value,
        timeTo: document.getElementById("filter-time-to").value,
    };
}

// Apply filter button event
function applyFilters() {
    currentPage = 1;
    displayTabContent(activeTab, currentPage, searchInput.value.trim(), getFilterValues());
}

// Tab click event listener
tabs.forEach(tab => {
    tab.addEventListener("click", () => switchTab(tab.dataset.tab));
});

// Search input event listener
searchInput.addEventListener("input", () => {
    currentPage = 1;
    displayTabContent(activeTab, currentPage, searchInput.value.trim(), getFilterValues());
});

// Initialize display for the default tab
switchTab(activeTab);




// VIEW DETAIL FUNCTION
const viewDetails = document.querySelectorAll('button.view-details');

viewDetails.forEach(button => {
    button.addEventListener('click', function (){
        const appointmentID = this.getAttribute('data-appointment-id');
        const appointmentStatus = this.getAttribute('data-appointment-status');
        fetchAppointmentDetails(appointmentID, appointmentStatus);
        console.log('button is working', appointmentID);
    });
});

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
                            <label for="fullname">Full Name</label>
                            <input type="text" id="fullname" name="fullname" value="${data.fullname}" disabled>
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
            <button class="close btn-normal">Close</button>
        </div>
    </div>
    `;
    // Show the modal
    modal.classList.add("active");

    // Close modal when 'X' is clicked
    document.querySelectorAll('.close').forEach(button => {
        button.onclick = function () {
            modal.classList.remove("active");
        };
    });
}
// VIEW DETAIL FUNCTION










//APPOINTMENT ACTION FUNCTION
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

function verifyChanges(appointmentID, appointmentSTATUS){
    const modal = document.getElementById('modal');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    if(appointmentSTATUS === "confirm"){
        modal.innerHTML = `
            <form action="/technician/appointment/${appointmentSTATUS}/${appointmentID}" method="POST">
                <input type="hidden" name="_token" value="${csrfToken}">
                <input type="hidden" name="_method" value="PATCH">
                
                <div class="modal-verification">
                    <i class="fa-solid fa-xmark close icon-close"></i>
                    <i class="fa-regular fa-calendar-check sign-success"></i>
                    <div class="verification-message">
                        <h2>Confirm Appointment</h2>
                        <p>Are you sure you want to confirm this appointment?</p>
                    </div>
                    <div class="verification-action">
                        <button type="submit" class="btn-success">Confirm Appointment</button>
                        <button type="button" class="close btn-normal"><b>Dismiss</b></button>
                    </div>
                </div>                
            </form>
        `;                
    }else if(appointmentSTATUS === "reject"){
        modal.innerHTML = `
            <form action="/technician/appointment/${appointmentSTATUS}/${appointmentID}" method="POST">
                <input type="hidden" name="_token" value="${csrfToken}">
                <input type="hidden" name="_method" value="PATCH">

                <div class="modal-verification">
                    <i class="fa-solid fa-xmark close icon-close"></i>
                    <i class="fa-regular fa-calendar-xmark sign-danger"></i>
                    <div class="verification-message">
                        <h2>Reject Appointment</h2>
                        <p>Are you sure you want to Reject this appointment?</p>                        
                    </div>
                    <div class="verification-action">
                        <button type="submit" class="btn-danger">Confirm Rejection</button>
                        <button type="button" class="close btn-normal"><b>Dismiss</b></button>
                    </div>
                </div>                 
            </form>
        `;   
    }else if(appointmentSTATUS === "cancel"){
        modal.innerHTML = `
            <form action="/technician/appointment/${appointmentSTATUS}/${appointmentID}" method="POST">
                <input type="hidden" name="_token" value="${csrfToken}">
                <input type="hidden" name="_method" value="PATCH">

                <div class="modal-verification">
                    <i class="fa-solid fa-xmark close icon-close"></i>
                    <i class="fa-regular fa-calendar-xmark sign-danger"></i>
                    <div class="verification-message">
                        <h2>Cancel Appointment</h2>
                        <p>Are you sure you want to Cancel this appointment?</p>                        
                    </div>
                    <div class="verification-action">
                        <button type="submit" class="btn-danger">Confirm Cancellation</button>
                        <button type="button" class="close btn-normal"><b>Dismiss</b></button>
                    </div>
                </div>                 
            </form>
        `;   
    }else if(appointmentSTATUS === "repair"){
        modal.innerHTML = `
            <form action="/technician/repairstatus/create/${appointmentID}" method="POST">
                <input type="hidden" name="_token" value="${csrfToken}">
                <div class="modal-verification">
                    <i class="fa-solid fa-xmark close icon-close"></i>
                    <i class="fa-solid fa-screwdriver-wrench sign-primary"></i>
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
                        <button type="submit" class="btn-primary">Confirm Start</button>
                        <button type="button" class="close btn-normal"><b>Dismiss</b></button>
                    </div>

                    <p class="note"><b>Note: </b>Do not start the repair unless the device has been dropped off.<br>Starting the repair will automatically notify the customer that the device has been received.</p>   
                </div>                 
            </form>
        `;   
    }

    // Show the modal
    modal.classList.add("active");

    // Close modal when 'X' is clicked
    document.querySelectorAll('.close').forEach(button => {
        button.onclick = function () {
            modal.classList.remove("active");
        };
    });
    
}

//ADD WALKINS BUTTONS
const addAppointmentBtn = document.querySelector('a.add-appointment');

addAppointmentBtn.addEventListener('click', function(e){
    e.preventDefault();

    const modal = document.getElementById('modal');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    console.log('button is working');

    modal.innerHTML = `
    <form action="/technician/appointment/create/walk-ins" method="POST" class="modal-content" id="modal-content">
        <input type="hidden" name="_token" value="${csrfToken}">

        <div class="modal-body">
            <div class="left">
                <div class="form-section">
                    <h2>Customer Details</h2>
                    <div class="row">
                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" id="firstname" name="firstname" required>
                        </div> 
                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" id="lastname" name="lastname" required>
                        </div>                                  
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="contact_no">Mobile Phone Number</label>
                            <input type="tel" id="contact_no" name="contact_no" required> 
                        </div>                                
                    </div>
                </div>  

                <div class="form-section">
                    <h2>Device Information</h2>
                    <div class="row">
                        <div class="form-group">
                            <label for="device_type">Device Type</label>
                            <select type="text" id="device_type" name="device_type" required>
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
                            <label for="device_brand">Device Brand</label>
                            <input type="text" id="device_brand" name="device_brand" required>
                        </div>                                
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="device_model">Device Model</label>
                            <input type="text" id="device_model" name="device_model" required>
                        </div>
                        <div class="form-group">
                            <label for="device_serial">Serial Number</label>
                            <input type="text" id="device_serial" name="device_serial">
                        </div>                                
                    </div>
                </div> 

                <div class="form-section">
                    <h2>Appointment Schedule</h2>
                    <div class="row">
                        <div class="form-group">
                            <label for="appointment_date">Select Date</label>
                            <input type="date" id="appointment_date" name="appointment_date" required>
                        </div>
                        <div class="form-group">
                            <label for="appointment_time">Select Time</label>
                            <input type="time" id="appointment_time" name="appointment_time" required>
                        </div>                                
                    </div>

                    <div class="form-group">
                        <label for="appointment_urgency">Urgency Level</label>
                        <select type="text" id="appointment_urgency" name="appointment_urgency" required>
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="right">
                <div class="form-section excluded">
                    <h2>Device Issue</h2>
                    <div class="form-group-excluded">
                        <label for="issue_descriptions">Description of Issue</label>
                        <textarea id="issue_descriptions" name="issue_descriptions"></textarea>
                    </div>
                    <div class="form-group-excluded">
                        <label for="error_messages">Error Messages</label>
                        <textarea id="error_messages" name="error_messages"></textarea>
                    </div>
                    <div class="form-group-excluded">
                        <label for="repair_attempts">Previous Repair Attempts</label>
                        <textarea id="repair_attempts" name="repair_attempts"></textarea>
                    </div>
                    <div class="form-group-excluded">
                        <label for="recent_events">Recent Changes or Events</label>
                        <textarea id="recent_events" name="recent_events"></textarea>
                    </div>
                    <div class="form-group-excluded">
                        <label for="prepared_parts">Parts Prepared for Repair</label>
                        <textarea id="prepared_parts" name="prepared_parts"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-action">
            <button type="submit" class="submit btn-primary">Add Appointment</button>
            <button type="button" class="close btn-normal">Close</button>
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




