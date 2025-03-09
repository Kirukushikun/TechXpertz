// Get the close icon element
const closeNotification = document.getElementById('close-notification');
// Get the push notification element (assuming it has a class 'push-notification')
const pushNotification = document.querySelector('.push-notification');

if (closeNotification) {
    // Add a click event listener to the close icon
    closeNotification.addEventListener('click', function() {
        // Remove the 'active' class to hide the notification
        if (pushNotification) {
            pushNotification.classList.remove('active');
        }
    });
}

if (pushNotification) {
    // Show the push notification by adding the 'active' class
    setTimeout(() => {
        pushNotification.classList.add('active');
    }, 500);

    // Automatically hide the notification after 5 seconds
    setTimeout(() => {
        pushNotification.classList.remove('active');
    }, 5500);
}