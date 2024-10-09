document.addEventListener('DOMContentLoaded', function(){
    // <--- POPULATING SHOP BADGES INPUT DROPDOOWNS
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

    // POPULATING SHOP BADGES INPUT DROPDOOWNS --->

    // <--- SPECIALIZATION ONCLICK TOOGGLE ---------------------------------------

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

    // SPECIALIZATION ONCLICK TOOGGLE ---> ----------------------------------------------- 

    // <--- SERVICES ADD BUTTON ----------------------------------------------- 

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

    // SERVICES ADD BUTTON ---> ----------------------------------------------- 

    // <--- REPAIRSHOP SCHEDULE TOGGLE BUTTONS ----------------------------------------------- 

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

    // REPAIRSHOP SCHEDULE TOGGLE BUTTONS ---> ----------------------------------------------- 

    // <--- MODAL SAVE CHANGES VERIFICATION ----------------------------------------------- 

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

    // MODAL SAVE CHANGES VERIFICATION ---> ----------------------------------------------- 
});


