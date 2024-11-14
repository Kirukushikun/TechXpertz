document.addEventListener('DOMContentLoaded', () => {
    const navItems = document.querySelectorAll('.nav-item');
    const formSteps = document.querySelectorAll('.form-step');
    const nextButtons = document.querySelectorAll('.next-btn');
    const prevButtons = document.querySelectorAll('.prev-btn');

    let currentStep = 1;

    navItems.forEach(item => {
        item.addEventListener('click', () => {
            const step = parseInt(item.getAttribute('data-step'));
            setActiveStep(step);
        });
    });

    nextButtons.forEach(button => {
        button.addEventListener('click', () => {
            if (currentStep < formSteps.length) {
                currentStep++;
                setActiveStep(currentStep);
            }
        });
    });

    prevButtons.forEach(button => {
        button.addEventListener('click', () => {
            if (currentStep > 1) {
                currentStep--;
                setActiveStep(currentStep);
            }
        });
    });

    function setActiveStep(step) {
        currentStep = step;
        formSteps.forEach((step, index) => {
            if (index + 1 === currentStep) {
                step.classList.add('active');
            } else {
                step.classList.remove('active');
            }
        });
        navItems.forEach((item, index) => {
            if (index + 1 === currentStep) {
                item.classList.add('active');
            } else {
                item.classList.remove('active');
            }
        });
    }
});

//--------------------------------------------------------------------------------------------------------//

// let documentCount = 1; // Start with the first document slot

// function addDocumentField() {
//     documentCount++;
//     const additionalDocuments = document.getElementById("document-fields");
//     const newFormGroup = document.createElement("div");
//     newFormGroup.className = "form-group";
//     const uniqueId = documentCount; // Ensure uniqueness with documentCount
//     newFormGroup.innerHTML = `
//         <select name="document-type-${uniqueId}" id="document-type-${uniqueId}">
//             <option value="business-permit">Business Permit</option>
//             <option value="tax-id">Tax Identification Number (TIN)</option>
//             <option value="lease-agreement">Lease Agreement</option>
//             <option value="business-license">Business License</option>
//             <option value="barangay-clearance">Barangay Clearance</option>
//         </select>
//         <div class="file-input-container">
//             <input type="file" name="document-file-${uniqueId}" id="document-file-${uniqueId}" class="file-input">
//             <label for="document-file-${uniqueId}" class="custom-file-label">Choose File</label>
//             <span class="file-name" id="fileName-${uniqueId}"></span>
//         </div>
//     `;
//     additionalDocuments.appendChild(newFormGroup);

//     // Add event listener to the new file input
//     document.getElementById(`document-file-${uniqueId}`).addEventListener('change', function() {
//         const fileName = this.files[0] ? this.files[0].name : 'No file chosen';
//         document.getElementById(`fileName-${uniqueId}`).textContent = fileName;
//     });
// }

// // Initial event listener for the first file input
// document.getElementById('document-file-1').addEventListener('change', function() {
//     const fileName = this.files[0] ? this.files[0].name : 'No file chosen';
//     document.getElementById('fileName-1').textContent = fileName;
// });

//--------------------------------------------------------------------------------------------------------//

// let proofCount = 1; // Start with the first proof slot

// function addProofField() {
//     proofCount++;
//     const proofFields = document.getElementById("proof-of-ownership-fields");
//     const newFormGroup = document.createElement("div");
//     newFormGroup.className = "form-group";
//     const uniqueId = proofCount; // Ensure uniqueness with proofCount
//     newFormGroup.innerHTML = `
//         <select name="proof-type-${uniqueId}" id="proof-type-${uniqueId}">
//             <option value="property-title">Property Title</option>
//             <option value="certificate-of-occupancy">Certificate of Occupancy</option>
//             <option value="insurance-policy">Commercial Insurance Policy</option>
//             <option value="utility-bills">Utility Bills</option>
//             <option value="tax-assessment">Tax Assessment</option>
//         </select>
//         <div class="file-input-container">
//             <input type="file" name="proof-file-${uniqueId}" id="proof-file-${uniqueId}" class="file-input">
//             <label for="proof-file-${uniqueId}" class="custom-file-label">Choose File</label>
//             <span class="file-name" id="proofFileName-${uniqueId}"></span>
//         </div>
//     `;
//     proofFields.appendChild(newFormGroup);

//     // Add event listener to the new file input
//     document.getElementById(`proof-file-${uniqueId}`).addEventListener('change', function() {
//         const fileName = this.files[0] ? this.files[0].name : 'No file chosen';
//         document.getElementById(`proofFileName-${uniqueId}`).textContent = fileName;
//     });
// }

// // Initial event listener for the first proof file input
// document.getElementById('proof-file-1').addEventListener('change', function() {
//     const fileName = this.files[0] ? this.files[0].name : 'No file chosen';
//     document.getElementById('proofFileName-1').textContent = fileName;
// });

//---------------------------------------------------------------

let emailInput = document.getElementById('email');
let emailPreview = document.getElementById('email-preview');

emailInput.addEventListener('input', function(){
    emailPreview.value = this.value;
});

emailPreview.addEventListener('input', function(){
    emailInput.value = this.value;
});

//--------------------------------------------------------------