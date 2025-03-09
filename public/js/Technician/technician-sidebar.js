
document.addEventListener('DOMContentLoaded', function() {
    const currentPath = window.location.pathname;
    console.log('Current Path:', currentPath);
    const sidebarLinks = document.querySelectorAll('.sidebar-main ul li a');

    sidebarLinks.forEach(link => {
        const linkPath = link.getAttribute('href');
        console.log('Link Path:', linkPath);
        if (currentPath === linkPath) {
            link.parentElement.classList.add('active');
            console.log('Active Link:', linkPath);
        } else {
            link.parentElement.classList.remove('active');
        }
    });
});

