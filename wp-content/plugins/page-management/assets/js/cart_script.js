document.addEventListener("DOMContentLoaded", function () {
    function setupCartQuantityButtons() {
        jQuery(document.body).on('click', '.quantity .plus', function () {
            var button = this;
            setTimeout(function () {
                calculatePrices(button.closest('.cart_item'));
                updateCartTotal();
            }, 100);
        });

        jQuery(document.body).on('click', '.quantity .minus', function () {
            var button = this;
            setTimeout(function () {
                calculatePrices(button.closest('.cart_item'));
                updateCartTotal();
            }, 100); 
        });
    }

    function calculatePrices(cartItem) {
        var price = parseFloat(cartItem.querySelector('.product-price .woocommerce-Price-amount').innerText.replace(',', '.'));
        var quantity = parseInt(cartItem.querySelector('.qty').value);
        var subtotal = price * quantity;
        cartItem.querySelector('.product-subtotal .woocommerce-Price-amount').innerText = subtotal.toFixed(2).replace('.', ',') + ' zł';
    }

    function updateCartTotal() {
        var subtotalElements = document.querySelectorAll('.product-subtotal .woocommerce-Price-amount');
        var subtotal = 0;
        subtotalElements.forEach(function (element) {
            var price = parseFloat(element.innerText.replace(',', '.'));
            subtotal += price;
            
            if (!element.closest('.product-subtotal').querySelector('.total-text')) {
                add_total_text(element.closest('.product-subtotal'));
            }
        });
    
        var subtotalElement = document.querySelector('.cart-subtotal .woocommerce-Price-amount');    
        var totalElement = document.querySelector('.order-total .woocommerce-Price-amount');
        subtotalElement.innerText  = subtotal.toFixed(2).replace('.', ',') + ' zł';
        totalElement.innerText = subtotal.toFixed(2).replace('.', ',') + ' zł';
    }

    var homeLink = document.querySelector('#breadcrumbs span span a');
    homeLink.innerText = 'Sklep';

    var breadcrumbSpan = document.querySelector('#breadcrumbs span');
    breadcrumbSpan.innerHTML = breadcrumbSpan.innerHTML.replace('»', '/');

    function tr () {

        var tr = document.querySelector('.shop_table tbody tr:last-child');

        if (tr) {
            var fragment = document.createDocumentFragment();
            while (tr.firstChild) {
                fragment.appendChild(tr.firstChild);
            }
            
            tr.parentNode.replaceChild(fragment, tr);
        }
    }

    function add_total_text(subtotalElement) {
        var newElement = document.createElement('span');
        newElement.innerText = ' Razem: ';
        newElement.classList.add('total-text'); 
        
        subtotalElement.insertBefore(newElement, subtotalElement.firstChild);
    }

    function reloadRazem() {
        var subtotalElements = document.querySelectorAll('.product-subtotal .woocommerce-Price-amount');
        subtotalElements.forEach(function (element) {
            if (!element.closest('.product-subtotal').querySelector('.total-text')) {
                add_total_text(element.closest('.product-subtotal'));
            }
        });
    }
    setupCartQuantityButtons();

    jQuery(document).ajaxComplete(function() {
        reloadRazem();
        tr();
    });

    reloadRazem();
    tr();

});
