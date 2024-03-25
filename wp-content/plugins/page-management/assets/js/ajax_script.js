let liveSearchActivated = false;

function quick_search_select() {
    if (liveSearchActivated) return;

    document.body.addEventListener("click", function (event) {
        const target = event.target;

        /* adding product in quick search*/

    const myCartSearchElement = target.closest('.my-cart-search');

    if (!myCartSearchElement) {
        return; 
    }

    const product_search_frame = myCartSearchElement.closest('.search-result');

    if (!product_search_frame) {
        return; 
    }

    activateLiveSearch();
    myCartSearchElement.childNodes.forEach(node => {
        if (node.nodeType === Node.TEXT_NODE) {
            node.textContent = '';
        }
    });
    const productSearchId = myCartSearchElement.getAttribute('data-product-id');
    const spinnerSearch = myCartSearchElement.querySelector('.loader-1');

    if (spinnerSearch && spinnerSearch.classList.contains('loader-1')) {
        spinnerSearch.classList.remove('spinner-hide');
        spinnerSearch.classList.add('spinner-show');
        myCartSearchElement.style.backgroundColor = "#3cb371"; 
    }

    if (productSearchId) {
            jQuery.ajax({
                url: toTheCart.ajaxurl,
                type: 'post',
                data: {
                    action: 'adding_item',
                    product_id: productSearchId
                },
                success: function (response) {
                        updateMiniCart();
                        updateMiniCartMobile();
                },
                error: function (xhr, status, error) {
                    if (spinnerSearch) {
                        spinnerSearch.classList.add('spinner-hide');
                        spinnerSearch.classList.remove('spinner-show');
                    }
                }
            });
            function updateMiniCart() {
                jQuery.ajax({
                    url: toTheCart.ajaxurl, 
                    type: 'POST',
                    data: {
                        action: 'update_mini_cart', 
                        product_id: productSearchId
                    },
                    success: function(response) {
                        jQuery('.header-cart-trigger').html(response.data.mini_cart_html);
                        if (spinnerSearch) {
                            spinnerSearch.classList.add('spinner-hide');
                            spinnerSearch.classList.remove('spinner-show');
                            select_mini_cart_header();
                            updatebutton();
                        }
                    },
                    error: function(xhr, status, error) {
                    }
                });
                }
                function updateMiniCartMobile() {
                    jQuery.ajax({
                        url: toTheCart.ajaxurl, 
                        type: 'POST',
                        data: {
                            action: 'update_mini_cart_mobile', 
                            product_id: productSearchId
                        },
                        success: function(response) {
                            jQuery('.footer-cart-trigger').html(response.data.mini_cart_html);
                            if (spinnerSearch) {
                                spinnerSearch.classList.add('spinner-hide');
                                spinnerSearch.classList.remove('spinner-show');
                                select_mini_cart_mobile();
                                updatebutton();
                            }
                        },
                    });
                }
                function updatebutton() {
                    jQuery.ajax({
                        url: toTheCart.ajaxurl, 
                        type: 'POST',
                        data: {
                            action: 'product_search_button_ajax', 
                            product_id: productSearchId
                        },
                        success: function(response) {
                            var buttonToUpdate = jQuery('[data-product-id="' + productSearchId + '"]');

                            buttonToUpdate.closest('.col-action').html(response); 
                        },
                        error: function(xhr, status, error) {
                        }
                    });
                }    
        }
    });
}

function quick_search_removal() {
    if (liveSearchActivated) return;

    document.body.addEventListener("click", function (event) {
        const target = event.target;

        /* adding product in quick search*/

    const myCartSearchElement = target.closest('.cart-icon-search');

    if (!myCartSearchElement) {
        return; 
    }

    const product_search_frame = myCartSearchElement.closest('.search-result');

    if (!product_search_frame) {
        return; 
    }

    activateLiveSearch();
    myCartSearchElement.childNodes.forEach(node => {
        if (node.nodeType === Node.TEXT_NODE) {
            node.textContent = '';
        }
    });
    const productSearchId = myCartSearchElement.getAttribute('data-product-id');
    const spinnerSearch = myCartSearchElement.querySelector('.loader-1');

    if (spinnerSearch && spinnerSearch.classList.contains('loader-1')) {
        spinnerSearch.classList.remove('spinner-hide');
        spinnerSearch.classList.add('spinner-show');
    }

    if (productSearchId) {
            jQuery.ajax({
                url: toTheCart.ajaxurl,
                type: 'post',
                data: {
                    action: 'substracting_item',
                    product_id: productSearchId
                },
                success: function (response) {
                        updateMiniCart();
                        updateMiniCartMobile();
                },
            });
            function updateMiniCart() {
                jQuery.ajax({
                    url: toTheCart.ajaxurl, 
                    type: 'POST',
                    data: {
                        action: 'update_mini_cart', 
                        product_id: productSearchId
                    },
                    success: function(response) {
                        jQuery('.header-cart-trigger').html(response.data.mini_cart_html);
                            select_mini_cart_header();
                            updatebutton();
                        
                    },
                });
                }
                function updateMiniCartMobile() {
                    jQuery.ajax({
                        url: toTheCart.ajaxurl, 
                        type: 'POST',
                        data: {
                            action: 'update_mini_cart_mobile', 
                            product_id: productSearchId
                        },
                        success: function(response) {
                            jQuery('.footer-cart-trigger').html(response.data.mini_cart_html);
                                select_mini_cart_mobile();
                                updatebutton();
                            
                        },
                    });
                }
                function updatebutton() {
                    jQuery.ajax({
                        url: toTheCart.ajaxurl, 
                        type: 'POST',
                        data: {
                            action: 'product_search_button_ajax', 
                            product_id: productSearchId
                        },
                        success: function(response) {
                            var buttonToUpdate = jQuery('[data-product-id="' + productSearchId + '"]');
                            if (spinnerSearch) {
                                spinnerSearch.classList.add('spinner-hide');
                                spinnerSearch.classList.remove('spinner-show');
                            }

                            buttonToUpdate.closest('.col-action').html(response); 
                        },
                    });
                }     
        } 
    });
}



function mySelectFunction() {
    if (liveSearchActivated) return;

    document.body.addEventListener("click", function (event) {
        const target = event.target;


        const myCartRemoveElement = target.closest('.cart-icon');

        if(myCartRemoveElement) {
            removeItem();
        }

        function removeItem() {

        if (!myCartRemoveElement) {
            return; 
        }

        const product_remove_frame = myCartRemoveElement.closest('li').querySelector('.product-block-inner');
        if (!product_remove_frame) {
            return; 
        }
        const productRemoveId = myCartRemoveElement.getAttribute('data-product-id');
        const spinnerRemove   = myCartRemoveElement.querySelector('.loader-1');

        myCartRemoveElement.childNodes.forEach(node => {
            if (node.nodeType === Node.TEXT_NODE) {
                node.textContent = '';
            }
        });

        if (spinnerRemove && spinnerRemove.classList.contains('loader-1')) {
            spinnerRemove.classList.remove('spinner-hide');
            spinnerRemove.classList.add('spinner-show');
        }
        if (productRemoveId) {
            jQuery.ajax({
                url: toTheCart.ajaxurl,
                type: 'post',
                data: {
                    action: 'substracting_item',
                    product_id: productRemoveId
                },
                success: function (response) {
                        updateMiniCart();
                        updateMiniCartMobile();
                },
            });
            function updateMiniCart() {
                jQuery.ajax({
                    url: toTheCart.ajaxurl, 
                    type: 'POST',
                    data: {
                        action: 'update_mini_cart', 
                        product_id: productRemoveId
                    },
                    success: function(response) {
                        jQuery('.header-cart-trigger').html(response.data.mini_cart_html);
                            select_mini_cart_header();
                            updatebutton();
                    },
                });
                }
                function updateMiniCartMobile() {
                    jQuery.ajax({
                        url: toTheCart.ajaxurl, 
                        type: 'POST',
                        data: {
                            action: 'update_mini_cart_mobile', 
                            product_id: productRemoveId
                        },
                        success: function(response) {
                            jQuery('.footer-cart-trigger').html(response.data.mini_cart_html);
                                select_mini_cart_mobile();
                                updatebutton();
                            
                        },
                    });
                }
                function updatebutton() {
                    jQuery.ajax({
                        url: toTheCart.ajaxurl, 
                        type: 'POST',
                        data: {
                            action: 'add_to_cart_button_to_products_template_ajax', 
                            product_id: productRemoveId
                        },
                        success: function(response) {
                            var buttonToUpdate = jQuery('[data-product-id="' + productRemoveId + '"]');
                            if (spinnerRemove) {
                                spinnerRemove.classList.add('spinner-hide');
                                spinnerRemove.classList.remove('spinner-show');
                            }

                            buttonToUpdate.closest('.woocommerce-product-item').html(response); 
                        },
                    });
                }
        }
    }


        /*adding products*/


        const myCartElement = target.closest('.my-cart');

        if (!myCartElement) {
            return; 
        }

        const product_frame = myCartElement.closest('li').querySelector('.product-block-inner');

        if (!product_frame) {
            return; 
        }

        activateLiveSearch();
        myCartElement.childNodes.forEach(node => {
            if (node.nodeType === Node.TEXT_NODE) {
                node.textContent = '';
            }
        });
        const productId = myCartElement.getAttribute('data-product-id');
        const spinner = myCartElement.querySelector('.loader-1');

        if (spinner && spinner.classList.contains('loader-1')) {
            spinner.classList.remove('spinner-hide');
            spinner.classList.add('spinner-show');
            myCartElement.style.backgroundColor = "#3cb371"; 
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
                        updateMiniCart();
                        updateMiniCartMobile();
                },
                error: function (xhr, status, error) {
                    if (spinner) {
                        spinner.classList.add('spinner-hide');
                        spinner.classList.remove('spinner-show');
                    }
                }
            });
            function updateMiniCart() {
                jQuery.ajax({
                    url: toTheCart.ajaxurl, 
                    type: 'POST',
                    data: {
                        action: 'update_mini_cart', 
                        product_id: productId
                    },
                    success: function(response) {
                        jQuery('.header-cart-trigger').html(response.data.mini_cart_html);
                        if (spinner) {
                            spinner.classList.add('spinner-hide');
                            spinner.classList.remove('spinner-show');
                            select_mini_cart_header();
                            updatebutton();
                        }
                    },
                });
                }
                function updateMiniCartMobile() {
                    jQuery.ajax({
                        url: toTheCart.ajaxurl, 
                        type: 'POST',
                        data: {
                            action: 'update_mini_cart_mobile', 
                            product_id: productId
                        },
                        success: function(response) {
                            jQuery('.footer-cart-trigger').html(response.data.mini_cart_html);
                            if (spinner) {
                                spinner.classList.add('spinner-hide');
                                spinner.classList.remove('spinner-show');
                                select_mini_cart_mobile();
                                updatebutton();
                            }
                        },
                    });
                }
                function updatebutton() {
                    jQuery.ajax({
                        url: toTheCart.ajaxurl, 
                        type: 'POST',
                        data: {
                            action: 'add_to_cart_button_to_products_template_ajax', 
                            product_id: productId
                        },
                        success: function(response) {
                            var buttonToUpdate = jQuery('[data-product-id="' + productId + '"]');

                            buttonToUpdate.closest('.woocommerce-product-item').html(response); 
                        },
                    });
                }    
        } 
    });

    
}

function select_mini_cart_header() {
    var mini_cart_click = document.querySelector('.header-cart-trigger');

    if (mini_cart_click) {
        var content = mini_cart_click.querySelector('.cart-content');
        
        content.addEventListener('click', (event) => {
            event.preventDefault();

            var mini_cart_area = mini_cart_click.querySelector('aside#woocommerce_widget_cart-1');
            if (mini_cart_area) {
                if (mini_cart_area.style.display === 'block') {
                    mini_cart_area.style.display = 'none';
                } else {
                    mini_cart_area.style.display = 'block';
                }
            }
        });
    }
}

function select_mini_cart_mobile() {
    var mini_cart_click = document.querySelector('.footer-cart-trigger');

    if (mini_cart_click) {
        var content = mini_cart_click.querySelector('.cart-content');
        
        content.addEventListener('click', (event) => {
            event.preventDefault();

            var mini_cart_area = mini_cart_click.querySelector('aside#woocommerce_widget_cart-1');
            if (mini_cart_area) {
                if (mini_cart_area.style.display === 'block') {
                    mini_cart_area.style.display = 'none';
                } else {
                    mini_cart_area.style.display = 'block';
                }
            }
        });
    }
}

function activateLiveSearch() {
    liveSearchActivated = true;
}

document.addEventListener("DOMContentLoaded", function () {
    mySelectFunction();
    quick_search_select();
    quick_search_removal();
});


