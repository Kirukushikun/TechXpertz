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
