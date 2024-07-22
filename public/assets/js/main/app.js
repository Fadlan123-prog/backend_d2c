// $(document).ready(function() {
//     $('#dropdownMenuLink3').on('click', function(e) {
//         e.preventDefault();
//         var $dropdownMenu = $(this).next('.dropdown-menu');
//         $dropdownMenu.toggleClass('show');
//     });

//     // Close the dropdown if the user clicks outside of it
//     $(document).on('click', function(e) {
//         if (!$(e.target).closest('.nav-item.dropdown').length) {
//             $('.dropdown-menu').removeClass('show');
//         }
//     });
// });

document.addEventListener("DOMContentLoaded", function() {
    var dropdowns = document.querySelectorAll(".sidedrop");

    // Fungsi untuk mendapatkan rute saat ini
    function getCurrentRoute() {
        return window.location.pathname;
    }

    dropdowns.forEach(function(dropdown) {
        var routes = dropdown.getAttribute('href').split(',');
        var dropdownContent = dropdown.nextElementSibling;
        var currentRoute = getCurrentRoute();

        // Jika rute saat ini termasuk dalam data-routes, tampilkan dropdown
        routes.forEach(function(route) {
            if (currentRoute.includes(route)) {
                dropdownContent.style.display = "block";
            }
        });

        dropdown.addEventListener("click", function(event) {
            event.preventDefault(); // Prevent the default link behavior

            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    });
});
