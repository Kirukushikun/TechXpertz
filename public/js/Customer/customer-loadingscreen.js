document.addEventListener('DOMContentLoaded', () => {
    const loadingScreen = document.querySelector('.loading-screen');
    const buttons = document.querySelectorAll('.load');

    // Function to show loading screen
    const showLoadingScreen = () => {
        loadingScreen.classList.add('active'); // Show the loading screen

        // Disable all buttons to prevent multiple clicks
        buttons.forEach(button => {
            button.disabled = true;
        });

        // Set a timeout to remove the active class after 5 seconds (5000 milliseconds)
        setTimeout(() => {
            loadingScreen.classList.remove('active'); // Hide the loading screen
            buttons.forEach(button => {
                button.disabled = false; // Re-enable all buttons
            });
        }, 5000);
    };

    // Attach event listener to each button
    buttons.forEach(button => {
        button.addEventListener('click', showLoadingScreen);
    });
}); 