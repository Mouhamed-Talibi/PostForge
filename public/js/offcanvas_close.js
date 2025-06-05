// Wait for the DOM to be ready
document.addEventListener("DOMContentLoaded", function() {
    // Select all navigation links in the offcanvas menu
    const navLinks = document.querySelectorAll('.mobile-nav-link');

    // Select the offcanvas element
    const offcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasNavbar'));

    // Add event listener to each nav link
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            // Close the offcanvas when a link is clicked
            offcanvas.hide();
        });
    });
});