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
        newFormGroup.appendChild(newTextarea);

        // Append the new form group to the form details
        formDetails.insertBefore(newFormGroup, addServiceButton);                    
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
            <i class="fa-solid fa-circle-check" id="repair"></i>
            <div class="verification-message">
                <h2>Confirm Save Changes</h2>
                <p>Are you sure you want to save these changes?</p>
            </div>
            <div class="verification-action">
                <button type="submit" class="submit" id="save-changes">Save Changes</button>
                <button type="button" class="normal"><b>Dismiss</b></button>
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
    document.querySelector('.normal').onclick = function () {
        modal.classList.remove("active");
    };
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
        <form action="/technician/profile/${technicianID}/${imageType}" class="modal-upload" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="_token" value="${csrfToken}">
            <input type="hidden" name="_method" value="PATCH">

            <h2>Upload Your Image</h2>
            <div class="image-upload">
                <label for="file-input" class="upload-label">
                    <img id="preview" src="https://via.placeholder.com/150" alt="Image Preview">
                    <div class="upload-text">Click to Upload Image</div>
                </label>
                <input id="file-input" type="file" name="image" onchange="previewImage(event)" />
            </div>
            <div class="modal-action">
                <button type="submit" class="submit">Save</button>  
                <button type="button" class="close normal">Dismiss</button> 
            </div>
        </form>
    `;

    modal.classList.add('active');

    document.querySelector('.close').onclick = function () {
        modal.classList.remove('active');
    };
}

//Preview Image upon upload
function previewImage(event) {
    const preview = document.getElementById('preview');
    const file = event.target.files[0];

    if (file) {
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
    if (input.type === 'text' || input.tagName.toLowerCase() === 'textarea') {
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


//ADD LINK FUNCTION
// Function to add a new link
document.querySelector('.add-link').addEventListener('click', function () {
    const shopLinks = document.querySelector('.shop-links');

    // Create a new link div
    const newLink = document.createElement('div');
    newLink.classList.add('link');

    // Add the inner HTML for the new link
    newLink.innerHTML = `
        <p><i class="fa-brands fa-youtube link-icon"></i><span>: https://www.w3.org/Provider/Style/dummy.html</span></p>
        <i class="fa-regular fa-trash-can delete"></i>
    `;

    // Append the new link to the container
    shopLinks.appendChild(newLink);

    // Add event listener to the delete icon for the newly created link
    newLink.querySelector('.delete').addEventListener('click', function () {
        newLink.remove();
    });
});

// Function to delete a link
document.querySelectorAll('.delete').forEach(deleteBtn => {
    deleteBtn.addEventListener('click', function () {
        this.parentElement.remove();
    });
});