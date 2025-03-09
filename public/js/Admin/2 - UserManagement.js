const tabs = document.querySelectorAll(".tab-link");
const tabContentItems = document.querySelectorAll(".tab-content-item");
const searchInput = document.getElementById("search-input");
const itemsPerPage = 7; // Define how many items per page
let currentPage = 1; // Initial page number
let activeTab = "all-users"; // Default active tab

// Function to display items for a specific tab and page
function displayTabContent(tab, page = 1, search = "") {
    const table = document.getElementById(`${tab}-table`);
    if (!table) return; // Add this line to prevent errors if the table is missing

    const rows = Array.from(table.querySelector("tbody").rows);
    const filteredRows = search
        ? rows.filter(row => row.textContent.toLowerCase().includes(search.toLowerCase()))
        : rows;

    const totalItems = filteredRows.length;
    const start = (page - 1) * itemsPerPage;
    const end = page * itemsPerPage;
    
    // Hide all rows and show only the filtered rows for the current page
    rows.forEach(row => row.style.display = "none");
    filteredRows.slice(start, end).forEach(row => row.style.display = "");

    // Update pagination controls
    renderPagination(tab, page, Math.ceil(totalItems / itemsPerPage));
}


// Function to switch active tab
function switchTab(tab) {
    // Update active tab
    activeTab = tab;
    currentPage = 1; // Reset page to the first page

    // Toggle active class for tabs and tab content
    tabs.forEach(t => t.classList.toggle("active", t.dataset.tab === tab));
    tabContentItems.forEach(content => content.classList.toggle("active", content.id === tab));

    // Display content for the current tab
    displayTabContent(tab, currentPage, searchInput.value.trim());
}

// Function to render pagination
function renderPagination(tab, currentPage, totalPages) {
    const paginationContainer = document.querySelector(`#${tab} .pagination`);
    paginationContainer.innerHTML = "";

    // Calculate the range of page numbers to display
    const maxPagesToShow = 5;
    let startPage = Math.max(1, currentPage - Math.floor(maxPagesToShow / 2));
    let endPage = startPage + maxPagesToShow - 1;

    // Adjust if we're near the beginning or end of the page range
    if (endPage > totalPages) {
        endPage = totalPages;
        startPage = Math.max(1, endPage - maxPagesToShow + 1);
    }

    // Create "Previous" button
    if (currentPage > 1) {
        const prevButton = document.createElement("button");
        prevButton.innerHTML = '<i class="fa-solid fa-caret-left"></i>';
        prevButton.addEventListener("click", () => {
            currentPage -= 1;
            displayTabContent(tab, currentPage, searchInput.value.trim());
        });
        paginationContainer.appendChild(prevButton);
    }

    // Create page number buttons within the calculated range
    for (let i = startPage; i <= endPage; i++) {
        const pageButton = document.createElement("button");
        pageButton.textContent = i;
        pageButton.classList.toggle("active", i === currentPage);
        pageButton.addEventListener("click", () => {
            currentPage = i;
            displayTabContent(tab, currentPage, searchInput.value.trim());
        });
        paginationContainer.appendChild(pageButton);
    }

    // Create "Next" button
    if (currentPage < totalPages) {
        const nextButton = document.createElement("button");
        nextButton.innerHTML = '<i class="fa-solid fa-caret-right"></i>';
        nextButton.addEventListener("click", () => {
            currentPage += 1;
            displayTabContent(tab, currentPage, searchInput.value.trim());
        });
        paginationContainer.appendChild(nextButton);
    }
}

// Tab click event listener
tabs.forEach(tab => {
    tab.addEventListener("click", () => switchTab(tab.dataset.tab));
});

// Search input event listener
searchInput.addEventListener("input", () => {
    currentPage = 1; // Reset to the first page when searching
    displayTabContent(activeTab, currentPage, searchInput.value.trim());
});

// Initialize display for the default tab
switchTab(activeTab);