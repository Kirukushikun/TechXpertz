// Select navigation links and sections from both navigation types
const mainLinks = document.querySelectorAll('.right .profile-navigation a');
const collapseLinks = document.querySelectorAll('.right-collapse .profile-navigation a');
const sections = document.querySelectorAll('.account-form .form-section');

// Function to handle the display of sections
function displaySection(sectionId) {
    // Hide all sections
    sections.forEach(section => section.style.display = 'none');

    // Show the selected section
    const targetSection = document.querySelector(`.account-form .form-section#${sectionId}`);
    if (targetSection) {
        targetSection.style.display = 'flex';
    }
}

// Function to handle link activation
function activateLink(linkElement) {
    // Remove the 'active' class from all links in both navigation types
    mainLinks.forEach(link => link.classList.remove('active'));
    collapseLinks.forEach(link => link.classList.remove('active'));

    // Add 'active' class to the clicked link and its counterpart in both navigation types
    const targetSelector = linkElement.getAttribute('data-target');
    
    // Activate the clicked link
    linkElement.classList.add('active');
    
    // Find the corresponding link in the other navigation and activate it
    const correspondingLinkInMain = Array.from(mainLinks).find(link => link.getAttribute('data-target') === targetSelector);
    const correspondingLinkInCollapse = Array.from(collapseLinks).find(link => link.getAttribute('data-target') === targetSelector);
    
    if (correspondingLinkInMain) {
        correspondingLinkInMain.classList.add('active');
    }
    if (correspondingLinkInCollapse) {
        correspondingLinkInCollapse.classList.add('active');
    }
}

// Add event listeners to each link in both navigation types
[...mainLinks, ...collapseLinks].forEach(link => {
    link.addEventListener('click', function (event) {
        event.preventDefault();

        // Get the target section ID and display the section
        const sectionId = this.getAttribute('data-target');
        displaySection(sectionId);

        // Activate the clicked link in both navigation types
        activateLink(this);
    });
});

// Display the first section by default
if (sections.length > 0) {
    displaySection(sections[0].id);
}


// Display the first section by default
if (sections.length > 0) {
    displaySection(sections[0].id);
}

//PREVIEW IMAGE FUNCTION
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





//UPLOAD IMAGE FUNCTION
let uploadImage = document.querySelectorAll('button.upload-image');
let modal = document.getElementById('modal');
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

uploadImage.forEach(button => {
    button.addEventListener('click', function(){
        let customerID = this.getAttribute('data-customer-id');
        let actionType = this.getAttribute('data-action');
        
        if(actionType == 'upload'){
            modal.innerHTML = `                    
                <form class="modal-upload" action="/customer/myaccount/${actionType}/${customerID}"  method="POST" enctype="multipart/form-data">

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
        }else if(actionType == 'delete'){
            modal.innerHTML = `
                <form action="/customer/myaccount/${actionType}/${customerID}" method="POST">
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <input type="hidden" name="_method" value="PATCH">

                    <div class="modal-verification">
                        <i class="fa-solid fa-triangle-exclamation" id="repair"></i>
                        <div class="verification-message">
                            <h2>Delete Profile</h2>
                            <p>Are you sure you want to Delete your picture?</p>                        
                        </div>
                        <div class="verification-action">
                            <button type="submit" class="submit">Delete Picture</button>
                            <button type="button" class="close normal"><b>Dismiss</b></button>
                        </div>
                    </div>                 
                </form>
            `;
        }

        modal.classList.add('active');

        document.querySelector('.close').onclick = function () {
            modal.classList.remove('active');
        };
    })
});


//DISPLAYS SAVE BUTTON FOR EVERY CHANGES DETECTED
let profileSettings = document.getElementById('account-settings');
let inputs = profileSettings.querySelectorAll('input');

inputs.forEach(input => {
    input.addEventListener('input', function(){
        displaySaveChanges();
    });
});

function displaySaveChanges(){
    document.getElementById('form-action').classList.add('active');
}

//MARKING NOTIFICATION AS READ FUNCTION
document.querySelectorAll('.notification-action').forEach(notificationElement => {
    const markAsReadButton = notificationElement.querySelector('.submit');
    
    if (!markAsReadButton) return;  // Early return if no button is found
    
    const notificationID = markAsReadButton.getAttribute('data-notification-id');
    
    markAsReadButton.addEventListener('click', () => {
        // Disable the button to prevent multiple requests
        markAsReadButton.disabled = true;

        updateNotification(notificationID);

        // Change the button appearance after marking as read
        markAsReadButton.innerHTML = `
            <button style="color: #999" class="marked-as-read" disabled>
                <i class="fa-solid fa-envelope-open-text"></i>Marked as Read
            </button>
        `;
        
        console.log(`Notification ID: ${notificationID}`);
    });
});

function updateNotification(notificationID) {

    try {
        fetch(`/customer/myaccount/notification/update/${notificationID}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        })
        .then(response => {
            if (response.ok) {
                console.log('Notification marked as read successfully');
            } else {
                console.log('Failed to mark notification as read');
            }
        })
        .catch(error => {
            console.error('There was an error with the request:', error);
        });        
    } catch (error){
        console.error('An error occurred:', error);
    }

}

//DELETE ACCOUNT FUNCTION
let deleteBtn = document.getElementById('delete-account-btn');
deleteBtn.addEventListener('click', function(){
    let customerID = this.getAttribute('data-customer-id');
    modal.innerHTML = `
        <form action="/customer/myaccount/${customerID}" method="POST">
            <input type="hidden" name="_token" value="${csrfToken}">
            <input type="hidden" name="_method" value="PATCH">
            
            <div class="modal-verification">
                <i class="fa-solid fa-triangle-exclamation" id="exclamation"></i>
                
                <div class="verification-message">
                    <h2>Delete Account</h2>
                    <p>Are you sure you want to permanently delete your account? <br>This action cannot be undone.</p>                        
                </div>
                
                <div class="verification-action">
                    <button type="submit" class="danger">Confirm Account Deletion</button>
                    <button type="button" class="close normal"><b>Dismiss</b></button>
                </div>
            </div>                 
        </form>
    `;

    modal.classList.add('active');

    document.querySelector('.close').onclick = function () {
        modal.classList.remove('active');
    };
});
