jQuery(document).ready(function($) {
    "use strict";

    function verticalMenu() {
        $('.menu-toggle').on("click", function() {
            $('.vertical-mobile-menu, .background-overlay, body').addClass('active mobile-menu-open');
        });

        $('.menu-close, .background-overlay').on("click", function() {
            $('.vertical-mobile-menu, .background-overlay, body').removeClass('active mobile-menu-open');
        });
    }

    function toggleAccount() {
        $('.account-toggle').click(function() {
            $(".account-container").slideToggle("medium");
        });

        $('.topbar-link').click(function() {
            $(".topbar-link-wrapper").slideToggle("medium");
        });

        $('.topbar-footer-link').click(function() {
            $(".topbar-link-wrapper").slideToggle("medium");
        });

        $('.widgets-headercontact .widget-title').click(function() {
            $(".widgets-headercontact .toggle-block").slideToggle("medium");
        });
    }

    function searchToggle() {
        $('.panel-search-mobile').click(function() {
            const header = $(".header-main");
            const header_fixed = $(".header-main-fixed");
    
            if (header.length) {
                header.removeClass("header-main").addClass("header-main-fixed");
            }
    
            if (header_fixed.length) {
                header_fixed.removeClass("header-main-fixed").addClass("header-main");
            }
        });
    }

    function shuffleLi() {
        const ul = document.getElementById('primary-menu-list');
        const lis = ul.getElementsByClassName('menu-item-info-custom');
        let currentIndex = 0;
    
        function showNextLi() {
            const currentA = lis[currentIndex].querySelector('a');
            const currentText = currentA.textContent;

            for (let i = 0; i < lis.length; i++) {
                lis[i].classList.remove('active');
            }
            lis[currentIndex].classList.add('active');
    
            currentIndex++;
    
            if (currentIndex >= lis.length) {
                currentIndex = 0;
            }
        }
        lis[currentIndex].classList.add('active');
    
        setInterval(showNextLi, 4000);
    }

    function slider_cert_mobile() {
        const columns = document.querySelectorAll('.certified-column-mobile');
        const prev = document.querySelector('.prev');
        const next = document.querySelector('.next');
        const elementsToShow = 2;
    
        let currentIndex = 0;
    
        function showElements(startIndex) {
            for (let i = 0; i < columns.length; i++) {
                const isVisible = i >= startIndex && i < startIndex + elementsToShow;
                columns[i].style.display = isVisible ? "block" : "none";
            }
        }
    
        function updateVisibility() {
            showElements(currentIndex);
        }
    
        updateVisibility();
    
        next.addEventListener('click', () => {
            currentIndex = (currentIndex + elementsToShow) % columns.length;
            updateVisibility();
        });
    
        prev.addEventListener('click', () => {
            currentIndex = (currentIndex - elementsToShow + columns.length) % columns.length;
            updateVisibility();
        });
    }

function footer_mobile() {
    const links = document.querySelectorAll('.footer-wrapper .nav-footer__link');

    links.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();

            const subMenu = this.nextElementSibling;

            if (subMenu) {
                subMenu.classList.toggle('sub-menu-visible');
                this.classList.toggle('sub-menu-visible');

                const arrowIcon = this;
                if (arrowIcon) {
                    arrowIcon.classList.toggle('after-transform');
                }

                const openSubmenus = document.querySelectorAll('.sub-menu-visible');
                openSubmenus.forEach(menu => {
                    if (menu !== subMenu) {
                        menu.classList.remove('sub-menu-visible');
                        
                        const otherArrowIcon = menu.previousElementSibling;
                        if (otherArrowIcon) {
                            otherArrowIcon.classList.remove('sub-menu-visible', 'after-transform');
                        }
                    }
                });
            }
        });
    });
}
    
    
    footer_mobile();
    slider_cert_mobile()
    shuffleLi();
    verticalMenu();
    toggleAccount();
    searchToggle();



});





