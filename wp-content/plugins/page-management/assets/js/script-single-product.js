document.addEventListener("DOMContentLoaded", function () {
    function slider_today_products(sliderContainer) {
        const find_frame = document.querySelector('.custom-single-slider .woocommerce .columns-4');
        const columns = sliderContainer.querySelectorAll('ul.products.columns-4 li');
        const prev = document.createElement('div');
        const next = document.createElement('div');

        next.classList.add('today-next');
        prev.classList.add('today-prev');

        find_frame.appendChild(prev);
        find_frame.appendChild(next);

        let elementsToShow = 4; // Default number of elements to show

        const transitionDuration = 1000; 
        const transitionTimingFunction = 'ease'; 
        let currentIndex = 0;

        function showElements(startIndex) {
            for (let i = 0; i < columns.length; i++) {
                const isVisible = i >= startIndex && i < startIndex + elementsToShow;
                const translateValue = isVisible ? '0%' : '-100%';
                columns[i].style.transform = `translateX(${translateValue})`;
                columns[i].style.transition = `transform ${transitionDuration}ms ${transitionTimingFunction}`;
                columns[i].style.display = isVisible ? "block" : "none";
            }
        }

        function updateVisibility() {
            showElements(currentIndex);
        }

        updateVisibility();

        next.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % (columns.length - elementsToShow + 1);
            updateVisibility();
        });

        prev.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + (columns.length - elementsToShow + 1)) % (columns.length - elementsToShow + 1);
            updateVisibility();
        });

        window.addEventListener('resize', function() {
            if (window.innerWidth >= 980) {
                elementsToShow = 4;
            } else {
                elementsToShow = 2;
            }
            updateVisibility();
        });
    }

    const find_trigger = document.querySelector('.custom-single-slider');
    slider_today_products(find_trigger);
});
