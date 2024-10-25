// Get the close icon element
const closeNotification = document.getElementById('close-notification');

// Add a click event listener to the close icon
closeNotification.addEventListener('click', function() {
    // Get the push notification container
    const notification = document.querySelector('.push-notification');
    
    // Remove the 'active' class to hide the notification
    notification.classList.remove('active');
});