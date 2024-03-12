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
    shuffleLi();
    verticalMenu();
    toggleAccount();
    searchToggle();



});





