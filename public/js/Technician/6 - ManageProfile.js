// TAB FUNCTION
const tabs = document.querySelectorAll('.tab');
const contents = document.querySelectorAll('.tab-content');

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



//  POPULATING SHOP BADGES INPUT DROPDOWNS
function populateSelectInputs() {
    const badges = [
        "24/7 Customer Support",
        "Advanced Diagnostic Tools",
        "Authorized Repair Center",
        "Certified Technicians On-Site",
        "Emergency Repair Service",
        "Exclusive Offers Available",
        "Experienced Staff",
        "Expert Troubleshooting",
        "Fastest Repair Times",
        "Free Diagnostic Service",
        "Loyalty Rewards Program",
        "No Hidden Charges",
        "Original Parts Used",
        "Pickup and Delivery Service",
        "Proven Repair Methods",
        "Same-Day Service",
        "Seamless Repair Process",
        "Secure Data Handling",
        "Specialized in All Brands",
        "Warranty on All Repairs"
    ];

    const selectIds = ["badge_1", "badge_2", "badge_3", "badge_4"];

    selectIds.forEach(id => {
        const select = document.getElementById(id);

        // Retrieve saved value from data attribute
        const savedValue = select.getAttribute('data-saved-value') || '';

        // Clear existing options
        select.innerHTML = '';

        // Add an empty option at the top
        const emptyOption = document.createElement("option");
        emptyOption.value = '';
        emptyOption.textContent = '';
        select.appendChild(emptyOption);

        // Add each badge as an option
        badges.forEach(badge => {
            const option = document.createElement("option");
            option.value = badge;
            option.textContent = badge;

            // If the badge matches the saved value, mark it as selected
            if (badge === savedValue) {
                option.selected = true;
            }

            select.appendChild(option);
        });

        // If there's no pre-selected value, ensure the first option is selected
        if (!savedValue) {
            select.value = '';
        }
    });
}
// Call the function to populate the select inputs when the page loads
populateSelectInputs();



// SPECIALIZATION ONCLICK TOOGGLE
const masteryCheckBox = document.querySelectorAll('.form-details');

masteryCheckBox.forEach(detail => {
    detail.addEventListener('click', () => {
        const checkbox = detail.querySelector('.checkbox-input');
        checkbox.checked = !checkbox.checked;

        // Toggle the 'active' class based on the checkbox state
        if (checkbox.checked) {
            detail.classList.add('active');
        } else {
            detail.classList.remove('active');
        }
    });
});



// SERVICES ADD BUTTON 
// Select the specific Services section
const servicesSection = document.querySelector('.services-section');
const addServiceButton = servicesSection.querySelector('.add-service');
const formDetails = servicesSection.querySelector('.form-details');

addServiceButton.addEventListener('click', function() {
    // Get the current number of service groups within this section
    const currentServiceCount = formDetails.querySelectorAll('.form-group').length;
    const newServiceCount = currentServiceCount + 1;
    
    if (currentServiceCount <= 4) {
        // Create a new form group
        const newFormGroup = document.createElement('div');
        newFormGroup.classList.add('form-group');

        // Create and append the label
        const newLabel = document.createElement('label');
        newLabel.setAttribute('for', `service${newServiceCount}`);
        newLabel.textContent = `Service ${newServiceCount}`;
        newFormGroup.appendChild(newLabel);

        // Create and append the textarea
        const newTextarea = document.createElement('textarea');
        newTextarea.type = 'text';
        newTextarea.id = `service${newServiceCount}`;
        newTextarea.name = `service[]`; // Use an array name to handle multiple inputs in backend
        newTextarea.required = true;
        newFormGroup.appendChild(newTextarea);

        // Append the new form group to the form details
        formDetails.insertBefore(newFormGroup, addServiceButton);  
        showButtons();                  
    }

});




// REPAIRSHOP SCHEDULE TOGGLE BUTTONS 

// Get all checkbox inputs
const checkboxes = document.querySelectorAll('.opening-hours-input input[type="checkbox"]');

// Loop through each checkbox and add an event listener
checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        // Find the corresponding <p> tag in the same row
        const statusText = this.closest('td').querySelector('.status p');
        
        // Update the text based on the checkbox state
        if (this.checked) {
            statusText.textContent = 'Open';
        } else {
            statusText.textContent = 'Closed';
        }
    });
});



// MODAL SAVE CHANGES VERIFICATION
const saveprofileBtn = document.querySelector('button.save-btn');
        
saveprofileBtn.addEventListener('click', function (e){
    e.preventDefault();
    verifySaveChanges();
});

function verifySaveChanges(){
    const modal = document.getElementById('modal');

    modal.innerHTML = `
    <div class="form">
        <div class="modal-verification">
            <i class="fa-solid fa-xmark close icon-close"></i>
            <i class="fa-solid fa-circle-check sign-primary"></i>
            <div class="verification-message">
                <h2>Confirm Save Changes</h2>
                <p>Are you sure you want to save these changes?</p>
            </div>
            <div class="verification-action">
                <button type="submit" class="submit btn-primary" id="save-changes">Save Changes</button>
                <button type="button" class="close btn-normal"><b>Dismiss</b></button>
            </div>
        </div>                
    </div>
    `;

    document.getElementById('save-changes').addEventListener('click', function(){
        document.querySelector('form.manage-profile').submit();
    });

    // Show the modal
    modal.classList.add("active");

    // Close modal when 'X' is clicked
    document.querySelectorAll('.close').forEach(button => {
        button.onclick = function () {
            modal.classList.remove("active");
        };
    });
}


//IMAGE UPLOAD FUNCTION
let imageDiv = document.getElementsByClassName('upload');

Array.from(imageDiv).forEach(image => {
    image.addEventListener('click', function(){
        let technicianID = this.getAttribute('data-technician-id');
        let imageType = this.getAttribute('data-image');
        addImage(technicianID, imageType);
    });
});

//Add Image
function addImage(technicianID, imageType){
    let modal = document.getElementById('modal');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


    modal.innerHTML = `
        <form action="/technician/profile/update/${technicianID}/${imageType}" class="modal-upload" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="_token" value="${csrfToken}">
            <input type="hidden" name="_method" value="PATCH">
            
            <i class="fa-solid fa-xmark close icon-close"></i>
            <h2>Upload Your Image</h2>
            <div class="image-upload">
                <img id="upload-icon" src="/images/image-upload-primary.png">
                <label for="file-input" class="upload-label">
                    <img id="preview">
                    <!-- <div class="upload-text">Click to Upload Image</div> -->
                </label>
                <input id="file-input" type="file" name="image" onchange="previewImage(event)" />
            </div>
            <div class="upload-action">
                <button type="submit" class="submit btn-primary">Save</button>  
                <!-- <button type="button" class="close">Dismiss</button>  -->
            </div>
        </form>
    `;

    modal.classList.add('active');

    // Close modal when 'X' is clicked
    document.querySelectorAll('.close').forEach(button => {
        button.onclick = function () {
            modal.classList.remove("active");
        };
    });
}

//Preview Image upon upload
function previewImage(event) {
    const preview = document.getElementById('preview');
    const file = event.target.files[0];
    const uploadIcon = document.getElementById('upload-icon');

    if (file) {
        uploadIcon.style.display = "None";
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);

    }
}


//SHOW SAVE CHANGES BUTTON WHEN CHANGES ARE MADE
let profileForm = document.getElementById('manage-profile');
let formBtns = document.getElementById('form-actions');
let tabContents = document.getElementsByClassName('tab-content');

// Select all form inputs, selects, and textareas within the profile form
let inputs = profileForm.querySelectorAll('input, select, textarea', 'checkbox');

inputs.forEach(input => {

    // Use 'input' event for text-based inputs (text, textarea)
    if (input.type === 'text' || input.type === 'email' || input.tagName.toLowerCase() === 'textarea') {
        input.addEventListener('input', function(){
            showButtons()
        });
    
    // Use 'change' event for checkboxes, radio buttons, and select dropdowns
    } else {
        input.addEventListener('change', function(){
            showButtons()
        });
    }
});

function showButtons(){
    formBtns.classList.add('active');
            
    // Update height for all tabContents elements
    Array.from(tabContents).forEach(tab => {
        tab.style.height = "87%";
    });
}

let deleteImage = document.getElementsByClassName('delete-image');

Array.from(deleteImage).forEach(button => {
    button.addEventListener('click', function(){
        let technicianID = this.getAttribute('data-technician-id');
        let imageType = this.getAttribute('data-image');
        verifyDeleteImage(technicianID, imageType);
    });
});

function verifyDeleteImage(technicianID, imageType){
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const modal = document.getElementById('modal');

    modal.innerHTML = `
    <form action="/technician/profile/delete/${technicianID}/${imageType}" method="POST">
        <input type="hidden" name="_token" value="${csrfToken}">
        <input type="hidden" name="_method" value="PATCH">

        <div class="modal-verification">
            <i class="fa-solid fa-xmark close icon-close"></i>
            <i class="fa-solid fa-trash sign-danger"></i>
            <div class="verification-message">
                <h2>Confirm Delete Image</h2>
                <p>Are you sure you want to delete this image?</p>
            </div>
            <div class="verification-action">
                <button type="submit" class="submit btn-danger">Save Changes</button>
                <button type="button" class="close btn-normal"><b>Dismiss</b></button>
            </div>
        </div>                
    </form>
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

// ADD LINK FUNCTION
// Function to add a new link
document.querySelector('.add-link').addEventListener('click', function () {
    
    const technicianID = this.getAttribute('data-technician-id');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const modal = document.getElementById('modal');

    modal.innerHTML = `
        <form action="/technician/profile/${technicianID}/social-link" method="POST">
            <input type="hidden" name="_token" value="${csrfToken}">
            <input type="hidden" name="_method" value="PATCH">

            <div class="modal-verification">
                <i class="fa-solid fa-xmark close icon-close"></i>
                <div class="social-container">
                    <label class="form-details" onclick=" setActive('youtube')">
                        <input type="radio" class="youtube" name="youtube" id="youtube" value="youtube" hidden>
                        <i class="fa-brands fa-youtube"></i>
                        <p>youtube</p>
                    </label>
                    <label class="form-details" onclick=" setActive('linkedin')">
                        <input type="radio" class="linkedin" name="linkedin" id="linkedin" value="linkedin" hidden>
                        <i class="fa-brands fa-linkedin"></i>
                        <p>linkedIn</p>
                    </label>
                    <label class="form-details" onclick=" setActive('twitter')">
                        <input type="radio" class="twitter" name="twitter" id="twitter" value="twitter" hidden>
                        <i class="fa-brands fa-twitter"></i>
                        <p>twitter</p>
                    </label>
                    <label class="form-details" onclick=" setActive('facebook')">
                        <input type="radio" class="facebook" name="facebook" id="facebook" value="facebook" hidden>
                        <i class="fa-brands fa-facebook"></i>
                        <p>facebook</p>
                    </label>
                    <label class="form-details" onclick=" setActive('telegram')">
                        <input type="radio" class="telegram" name="telegram" id="telegram" value="telegram" hidden>
                        <i class="fa-brands fa-telegram"></i>
                        <p>telegram</p>
                    </label>
                </div>

                <div class="link-container">
                    <input type="text" class="link" name="link" placeholder="https://example.com">
                </div>
                <div class="addlink-action">
                    <button type="submit" class="btn-primary">Save</button>
                    <button type="button" class="close btn-normal"><b>Dismiss</b></button>
                </div>
            </div>                 
        </form>
    `;

    // Show the modal
    modal.classList.add("active");

    // Close modal when 'X' is clicked
    document.querySelectorAll('.close').forEach(button => {
        button.onclick = function () {
            modal.classList.remove("active");
        };
    });
});


function setActive(selectedItem) {
    // Remove 'active' class from all radio buttons
    document.querySelectorAll('.form-details').forEach(item => item.classList.remove('active'));

    // Add 'active' class to the selected radio button container
    const selectedElement = document.getElementById(selectedItem).parentElement;
    selectedElement.classList.add('active');

    // Set the radio button as checked
    document.getElementById(selectedItem).checked = true;
}

// Function to delete a link
document.querySelectorAll('.delete').forEach(deleteBtn => {
    deleteBtn.addEventListener('click', function () {
        let technicianID = this.getAttribute('data-technician-id');
        let social = this.getAttribute('data-social');
        deleteLink(technicianID, social);
        this.parentElement.remove();
    });
});

function deleteLink(technicianID, social){
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`/technician/profile/${technicianID}/social-link/remove/${social}`, {
        method: 'PATCH', // You can use 'PUT' or 'PATCH' depending on your API design
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        }
    })
    .then(response => {
        if (response.ok) {
            console.log('Link Deletion Successfully');
        } else {
            console.log('Link Deletion Unsuccessful');
        }
    })
    .catch(error => {
        console.log('There was an error with the request:', error);
    });
}


// Function to open modal with the image view
function viewImage(imageUrl) {
    const modal = document.getElementById('modal');

    // Set the modal content to display the image with a close button
    modal.innerHTML = `
        <div class="image-preview-container" style="background-image: url('${imageUrl}');">
            <i class="fa-solid fa-xmark close icon-close"></i>
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

// Attach event listeners to the "eye" icons
document.querySelectorAll('.preview-image').forEach(icon => {
    icon.addEventListener('click', function() {
        const imageUrl = this.getAttribute('data-image-url');
        viewImage(imageUrl);
    });
});