// Burger menus
document.addEventListener('DOMContentLoaded', function() {
    // open
    const burger = document.querySelectorAll('.navbar-burger');
    const menu = document.querySelectorAll('.navbar-menu');

    if (burger.length && menu.length) {
        for (var i = 0; i < burger.length; i++) {
            burger[i].addEventListener('click', function() {
                console.log('====================================');
                console.log('click');
                console.log('====================================');
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('d-none');
                }
            });
        }
    }

    // close
    const close = document.querySelectorAll('.navbar-close');
    const backdrop = document.querySelectorAll('.navbar-backdrop');

    if (close.length) {
        for (var i = 0; i < close.length; i++) {
            close[i].addEventListener('click', function() {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('d-none');
                }
            });
        }
    }

    if (backdrop.length) {
        for (var i = 0; i < backdrop.length; i++) {
            backdrop[i].addEventListener('click', function() {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('d-none');
                }
            });
        }
    }
});

document.addEventListener('DOMContentLoaded', function() {
   const chevronSortBy = document.getElementById('chevron-icon-sortby');
   const dropdownSortBy = document.getElementById('select-dropdown-sortby');

   const chevronOrigin = document.getElementById('chevron-icon-origin');
   const dropdownOrigin = document.getElementById('select-dropdown-origin');

    function toggleChevron(chevron) {
        chevron.classList.toggle('chevron-down');
        chevron.classList.toggle('chevron-up');
    }

    if (chevronSortBy && dropdownSortBy) {
        dropdownSortBy.addEventListener('click', function() {
            toggleChevron(chevronSortBy, dropdownSortBy);
        });
    }

    if (chevronOrigin && dropdownOrigin) {
        dropdownOrigin.addEventListener('click', function() {
            toggleChevron(chevronOrigin, dropdownOrigin);
        });
    }
});