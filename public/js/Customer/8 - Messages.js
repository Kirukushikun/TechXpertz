function scrollToBottom() {
    var messageContainer = document.querySelector('.messages-container');
    if (messageContainer) {
        messageContainer.scrollTo({
            top: messageContainer.scrollHeight,
            behavior: 'smooth'
        });
    }
}

var messageContainer = document.querySelector('.messages-container');

// Create a new MutationObserver instance
const observer = new MutationObserver((mutationsList, observer) => {
    mutationsList.forEach((mutation) => {
        console.log(mutation); // This will log the mutation object when something changes
        // Scroll to bottom when a mutation occurs
        scrollToBottom();
    });
});

// Configure the observer to look for changes to child elements, attributes, or text content
const config = {
    childList: true, // Observe changes to the child elements (e.g., nodes added or removed)
    attributes: true, // Observe changes to attributes
    subtree: true, // Observe changes inside child elements of the div
    characterData: true // Observe changes to the text inside nodes
};

// Start observing the target div
if (messageContainer) {
    observer.observe(messageContainer, config);
}

// Ensure that it scrolls to the bottom on page load
scrollToBottom();

// // Select all contact elements, the chat area, and the sidebar
// let contacts = document.querySelectorAll('.contact');
// let chatArea = document.querySelector('.chat-area');
// let sidebar = document.querySelector('.sidebar');

// // Event listener for each contact
// contacts.forEach(contact => {
//     contact.addEventListener('click', function() {
//         // Hide the sidebar and show the chat area
//         sidebar.classList.add('hidden');
//         chatArea.classList.remove('hidden');
//     });
// });

// // Event listener for the back button
// document.querySelector('.back-btn').addEventListener('click', function() {
//     // Show the sidebar and hide the chat area
//     chatArea.classList.add('hidden');
//     sidebar.classList.remove('hidden');
// });