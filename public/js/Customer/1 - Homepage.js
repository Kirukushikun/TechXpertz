// Selectors for navigation, shop containers, pagination, and items
const navLinks = document.querySelectorAll(".header nav a");
const shopContainers = document.querySelectorAll(".shop-container");
const paginationContainer = document.querySelector(".pagination");
const shopItems = document.querySelectorAll(".shop");

let currentPage = 1;
const maxVisiblePages = 5;

// Function to handle nav link clicks
navLinks.forEach((link, index) => {
    link.addEventListener("click", (event) => {
        event.preventDefault();
        navLinks.forEach(nav => nav.classList.remove("active"));
        shopContainers.forEach(container => container.classList.remove("active"));

        link.classList.add("active");
        shopContainers[index].classList.add("active");
    });
});

if(paginationContainer){
    // Calculate total number of pages based on items
    const totalPages = Math.max(...Array.from(shopItems, item => parseInt(item.getAttribute("data-page"))));

    // Function to display items for the selected page
    function displayPage(page) {
        shopItems.forEach(item => {
            item.style.display = parseInt(item.getAttribute("data-page")) === page ? "flex" : "none";
        });
        updatePaginationLinks(page);
    }

    // Function to create pagination links with max 5 visible pages and handle "Previous" and "Next" sections
    function updatePaginationLinks(page) {
        paginationContainer.innerHTML = "";

        const startPage = Math.max(1, Math.min(page - Math.floor(maxVisiblePages / 2), totalPages - maxVisiblePages + 1));
        const endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

        // Previous button
        if (startPage > 1) {
            const prevLink = document.createElement("a");
            prevLink.href = "#";
            prevLink.innerHTML = '<i class="fa-solid fa-caret-left"></i>';
            prevLink.addEventListener("click", (event) => {
                event.preventDefault();
                currentPage = startPage - 1;
                displayPage(currentPage);
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
                displayPage(currentPage);
            });

            paginationContainer.appendChild(link);
        }

        // Next button
        if (endPage < totalPages) {
            const nextLink = document.createElement("a");
            nextLink.href = "#";
            nextLink.innerHTML = '<i class="fa-solid fa-caret-right"></i>';
            nextLink.addEventListener("click", (event) => {
                event.preventDefault();
                currentPage = endPage + 1;
                displayPage(currentPage);
            });
            paginationContainer.appendChild(nextLink);
        }
    }

    // Initial load for the first page
    displayPage(currentPage);
}
