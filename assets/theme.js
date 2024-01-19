// Listeners for btn behavior

document.addEventListener('DOMContentLoaded', function() {
    // Burger menus
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

    // chevrons behavior for dropdown filter homepage
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

    // btn promotion toggle
     const btnPromotion = document.getElementById('btn-promotion');
    btnPromotion.addEventListener('click', function() {
        btnPromotion.classList.toggle('promotionToggle');
    }
    );

    // categories and subcategories toggle
   document.querySelectorAll('.category-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var category = this.textContent;
        var subCategories = document.querySelector('.sub-categories[data-category="' + category + '"]');

        // Vérifier si la catégorie actuelle est déjà ouverte
        if (this.classList.contains('active')) {
            // Fermer la catégorie actuelle
            this.classList.remove('active');
            subCategories.classList.remove('active');
            subCategories.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
                checkbox.checked = false;
            });
        } else {
            // Fermer toutes les catégories ouvertes et décocher leurs checkboxes
            document.querySelectorAll('.category-btn').forEach(function(otherBtn) {
                otherBtn.classList.remove('active');
                var otherCategory = otherBtn.textContent;
                var otherSubCategories = document.querySelector('.sub-categories[data-category="' + otherCategory + '"]');
                otherSubCategories.classList.remove('active');
                otherSubCategories.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
                    checkbox.checked = false;
                });
            });

            // Ouvrir la catégorie cliquée
            this.classList.add('active');
            subCategories.classList.add('active');
        }
    });
});
});



