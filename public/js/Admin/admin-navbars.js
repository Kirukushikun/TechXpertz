document.addEventListener('DOMContentLoaded', function() {
    const currentPath = window.location.pathname; // /admin/reportmanagement
    console.log('Current Path:', currentPath);
    const sidebarLinks = document.querySelectorAll('.admin-navbar ul li a');

    sidebarLinks.forEach(link => {
        const linkPath = link.getAttribute('href'); // /admin/reportmanagement
        console.log('Link Path:', linkPath);
        if (currentPath === linkPath) {
            link.parentElement.classList.add('active');
            console.log('Active Link:', linkPath);
        } else {
            link.parentElement.classList.remove('active');
        }
    });
});