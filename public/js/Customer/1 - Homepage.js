const navLinks = document.querySelectorAll(".header nav a");
const shopCategories = document.querySelectorAll(".shop-category");

// Define items per page to match the PHP-defined value
const itemsPerPage = 4;  // Should match the $itemsPerPage set in PHP
const maxVisiblePages = 5;  // Maximum number of page links visible in pagination
let currentPage = 1;

// Function to handle navigation tab clicks
navLinks.forEach((link, index) => {
    link.addEventListener("click", (event) => {
        event.preventDefault();

        // Set the active tab and active category container
        navLinks.forEach(nav => nav.classList.remove("active"));
        shopCategories.forEach(container => container.classList.remove("active"));

        link.classList.add("active");
        shopCategories[index].classList.add("active");

        // Reset to page 1 on new category selection
        currentPage = 1;
        const activeShopContainer = shopCategories[index].querySelector(".shop-container");
        const paginationContainer = shopCategories[index].querySelector(".pagination");

        updatePagination(activeShopContainer, paginationContainer);
        displayPage(activeShopContainer, currentPage);
    });
});

// Function to calculate the total number of pages based on items per page
function calculateTotalPages(shopContainer) {
    const shopItems = shopContainer.querySelectorAll(".shop");
    return Math.ceil(shopItems.length / itemsPerPage);
}

// Function to display items for the selected page in the current category
function displayPage(shopContainer, page) {
    const shopItems = shopContainer.querySelectorAll(".shop");
    const totalPages = calculateTotalPages(shopContainer);

    shopItems.forEach((item, index) => {
        // Only show items that belong to the current page
        item.style.display = (index >= (page - 1) * itemsPerPage && index < page * itemsPerPage) ? "flex" : "none";
    });

    updatePaginationLinks(page, totalPages, shopContainer.parentNode.querySelector(".pagination"));
}

// Function to create and update pagination links with maxVisiblePages
function updatePaginationLinks(page, totalPages, paginationContainer) {
    paginationContainer.innerHTML = "";

    const startPage = Math.max(1, Math.min(page - Math.floor(maxVisiblePages / 2), totalPages - maxVisiblePages + 1));
    const endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

    // Previous button - only add if totalPages > maxVisiblePages
    if (totalPages > maxVisiblePages && page > 1) {
        const prevLink = document.createElement("a");
        prevLink.href = "#";
        prevLink.innerHTML = '<i class="fa-solid fa-caret-left"></i>';
        prevLink.addEventListener("click", (event) => {
            event.preventDefault();
            currentPage = page - 1;
            displayPage(paginationContainer.parentNode.querySelector(".shop-container"), currentPage);
        });
        paginationContainer.appendChild(prevLink);
    }

    // Page links
    for (let i = startPage; i <= endPage; i++) {
        const link = document.createElement("a");
        link.href = "#";
        link.textContent = i;
        link.classList.toggle("active", i === page);

        link.addEventListener("click", (event) => {
            event.preventDefault();
            currentPage = i;
            displayPage(paginationContainer.parentNode.querySelector(".shop-container"), currentPage);
        });

        paginationContainer.appendChild(link);
    }

    // Next button - only add if totalPages > maxVisiblePages
    if (totalPages > maxVisiblePages && page < totalPages) {
        const nextLink = document.createElement("a");
        nextLink.href = "#";
        nextLink.innerHTML = '<i class="fa-solid fa-caret-right"></i>';
        nextLink.addEventListener("click", (event) => {
            event.preventDefault();
            currentPage = page + 1;
            displayPage(paginationContainer.parentNode.querySelector(".shop-container"), currentPage);
        });
        paginationContainer.appendChild(nextLink);
    }
}

// Function to initialize pagination for the active shop container
function updatePagination(shopContainer, paginationContainer) {
    const totalPages = calculateTotalPages(shopContainer);
    updatePaginationLinks(currentPage, totalPages, paginationContainer);
}

// Initial load for the first tab
const initialShopContainer = shopCategories[0].querySelector(".shop-container");
const initialPaginationContainer = shopCategories[0].querySelector(".pagination");
updatePagination(initialShopContainer, initialPaginationContainer);
displayPage(initialShopContainer, currentPage);
