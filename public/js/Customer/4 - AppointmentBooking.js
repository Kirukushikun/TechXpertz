// Function to update the summary
function updateSummary(inputId, summaryClass) {
    const inputElement = document.getElementById(inputId);
    const summaryElement = document.querySelector(summaryClass + ' h4');

    inputElement.addEventListener('input', function () {
        summaryElement.textContent = inputElement.value;
    });
}

// Update Full Name
document.getElementById('firstname').addEventListener('input', function () {
    const firstName = document.getElementById('firstname').value;
    const lastName = document.getElementById('lastname').value;
    document.querySelector('.contact-summary .detail-group:nth-child(1) h4').textContent = `${firstName} ${lastName}`;
});

document.getElementById('lastname').addEventListener('input', function () {
    const firstName = document.getElementById('firstname').value;
    const lastName = document.getElementById('lastname').value;
    document.querySelector('.contact-summary .detail-group:nth-child(1) h4').textContent = `${firstName} ${lastName}`;
});

// Update Contact
updateSummary('contact_no', '.contact-summary .detail-group:nth-child(2)');

// Update Email
updateSummary('email', '.contact-summary .detail-group:nth-child(3)');

// Update Device Type
updateSummary('device_type', '.device-summary .detail-group:nth-child(1)');

// Update Brand
updateSummary('device_brand', '.device-summary .detail-group:nth-child(2)');

// Update Model
updateSummary('device_model', '.device-summary .detail-group:nth-child(3)');

// Update Serial Number
updateSummary('device_serial', '.device-summary .detail-group:nth-child(4)');

// Update Request Date
updateSummary('appointment_date', '.schedule-summary .detail-group:nth-child(1)');

// Update Request Time
updateSummary('appointment_time', '.schedule-summary .detail-group:nth-child(2)');

// Update Urgency Level
updateSummary('appointment_urgency', '.schedule-summary .detail-group:nth-child(3)');

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