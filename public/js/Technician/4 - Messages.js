var messageContainer = document.querySelector('.messages-container');
var scrollToBottomDiv = document.getElementById('scrollToBottom');

function scrollToBottom() {
    var messageContainer = document.querySelector('.messages-container');
    var scrollToBottomDiv = document.getElementById('scrollToBottom');
    if (scrollToBottomDiv) {
        scrollToBottomDiv.scrollIntoView({ behavior: 'smooth' });
    }
}

// Create a new MutationObserver instance
const observer = new MutationObserver((mutationsList, observer) => {
    mutationsList.forEach((mutation) => {
        console.log(mutation); // This will log the mutation object when something changes
        // You can also trigger a function or update UI here
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
observer.observe(messageContainer, config);

scrollToBottom();