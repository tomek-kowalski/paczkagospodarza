let liveSearchActivated = false;

function mySelectFunction() {
    if (liveSearchActivated) return;

    document.body.addEventListener("click", function (event) {
        const target = event.target;
        const product_frame = target.closest('li');

        if (!product_frame) {
            return; 
        }

        const product_name_frame = product_frame.querySelector('.product-block-inner');

        if (!product_name_frame) {
            return; 
        }

        const product_name = product_name_frame.querySelector('.product-name').innerHTML;

        console.log(product_name);

        if (target.classList.contains('my-cart')) {
            activateLiveSearch();
            const classes = product_frame.classList;
            let productId = null;
            for (let i = 0; i < classes.length; i++) {
                const className = classes[i];
                if (className.startsWith('post-')) {
                    productId = className.replace('post-', '');
                    break;
                }
            }
            if (productId) {
                jQuery.ajax({
                    url: toTheCart.ajaxurl,
                    type: 'post',
                    data: {
                        action: 'adding_item',
                        product_id: productId
                    },
                    success: function (response) {
                        alert(product_name + ' :dodane do koszyka.');
                    }
                });
            } else {
                console.error('Product ID not found in the class');
            }
        }
    });
}

function activateLiveSearch() {
    console.log('Live search activated!');
    liveSearchActivated = true;
}

document.addEventListener("DOMContentLoaded", function () {
    mySelectFunction();
});


