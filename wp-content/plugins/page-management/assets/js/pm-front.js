jQuery(document).ready(function($) {
    "use strict";

    function slider_recommended_products_mobile(sliderContainer) {

        const columns = sliderContainer.querySelectorAll('.woocommerce ul.products li');
        const prev = document.createElement('div');
        const next = document.createElement('div');

        next.classList.add('week-next');
        prev.classList.add('week-prev');

        sliderContainer.appendChild(prev);
        sliderContainer.appendChild(next);

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

    const sliders = document.querySelectorAll('.woocommerce.columns-2');
    sliders.forEach((sliderContainer) => {
        slider_recommended_products_mobile(sliderContainer);
    });

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

    slider_cert_mobile();
});






