document.addEventListener("DOMContentLoaded", function () {

    const select = document.querySelector('.my-custom-select select');
    const target = document.querySelector('.products');
    const pagination = document.querySelector(".woocommerce-pagination");
    const notice = document.querySelector('.woocommerce-result-count');
    let selectedValue;
    let currentPaged = 1;

    if (select && target) {

        select.addEventListener('change', function (event) {
            console.log('select');
            selectedValue = select.value;
            const metaKey = getDynamicMetaKey(selectedValue);

            jQuery.ajax({
                url: filterCatToday.ajaxurl,
                type: 'post',
                data: {
                    action: 'custom_product_filter_today',
                    select: selectedValue,
                    meta_key: metaKey,
                    nonce: filterCatToday.nonce,
                    paged: currentPaged,
                },
                success: function (response) {
                    target.innerHTML = response;
 
                    var delay = 500;
                    setTimeout(function () {
                        jQuery("ul.products li span.product-loading").hide();
                    }, delay);
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
            if(pagination) {
                jQuery.ajax({
                    url: filterCatToday.ajaxurl,
                    type: "post",
                    data: {
                        action: "display_pagination_today",
                        pagedPagination: currentPaged,
                        nonce: filterCatToday.nonce,
                    },
                    success: function (response) {
                        const trimmedResponse = response.trim();
                        pagination.innerHTML = trimmedResponse;
                    },
                });
            }
            jQuery.ajax({
                url: filterCatToday.ajaxurl,
                type: "post",
                data: {
                    action: "template_count_ajax_today",
                    paged: currentPaged,
                    nonce: filterCatToday.nonce,
                },
                success: function (response) {
                    const trimmedNotice = response.trim();
                    notice.innerHTML = trimmedNotice;
                },
            });
        });
        if(pagination) {
            pagination.addEventListener("click", function (event) {
                if (event.target.classList.contains("page-numbers")) {
                    event.preventDefault();
                    const pageNum = event.target.textContent;
                    currentPaged = parseInt(pageNum);
    
                    const metaKey = getDynamicMetaKey(selectedValue);
    
                    jQuery.ajax({
                        url: filterCatToday.ajaxurl,
                        type: "post",
                        data: {
                            action: "custom_product_archive_today",
                            paged: currentPaged,
                            select: metaKey,
                            nonce: filterCatToday.nonce,
                        },
                        success: function (response) {
                            target.innerHTML = response;
    
                            var delay = 500;
                            setTimeout(function () {
                                jQuery("ul.products li span.product-loading").hide();
                            }, delay);
                        },
                    });
                    jQuery.ajax({
                        url: filterCatToday.ajaxurl,
                        type: "post",
                        data: {
                            action: "display_pagination_today",
                            pagedPagination: currentPaged,
                            nonce: filterCatArchive.nonce,
                        },
                        success: function (response) {
                            const trimmedResponse = response.trim();
                            pagination.innerHTML = trimmedResponse;
                        },
                    });
                    jQuery.ajax({
                        url: filterCatToday.ajaxurl,
                        type: "post",
                        data: {
                            action: "template_count_ajax_today",
                            paged: currentPaged,
                            nonce: filterCatToday.nonce,
                        },
                        success: function (response) {
                            const trimmedNotice = response.trim();
                            notice.innerHTML = trimmedNotice;
                        },
                    });
                }
            });
        }
    }

    function getDynamicMetaKey(selectedValue) {
        switch (selectedValue) {
            case 'popularity':
                return 'popularity';
            case 'rating':
                return 'rating';
            case 'price':
                return 'price';
            case 'price_desc':
                return 'price_desc';
            default:
                return '';
        }
    }
});
