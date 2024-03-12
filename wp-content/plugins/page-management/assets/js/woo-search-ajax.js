document.addEventListener("DOMContentLoaded", function () {

    const select = document.querySelector('.my-custom-select select');
    const target = document.querySelector('.products');
    const pagination = document.querySelector(".woocommerce-pagination");
    const notice = document.querySelector('.woocommerce-result-count');
    const search = document.querySelector('#searchform .search-input').value;

    let selectedValue;
    let currentPaged = 1;

    if (select && target && search) {

        select.addEventListener('change', function (event) {

            selectedValue = select.value;
            const metaKey = getDynamicMetaKey(selectedValue);

            jQuery.ajax({
                url: filterCatSearch.ajaxurl,
                type: 'post',
                data: {
                    action: 'custom_product_search_filter',
                    select: selectedValue,
                    search_query: search,
                    meta_key: metaKey,
                    nonce: filterCatSearch.nonce,
                    paged: currentPaged,
                },
                success: function (response) {
                    target.innerHTML = response;

                    var delay = 500;
                    setTimeout(function () {
                        jQuery("ul.products li span.product-loading").hide();
                    }, delay);
                },
            });
            if(pagination) {
                jQuery.ajax({
                    url: filterCatSearch.ajaxurl,
                    type: "post",
                    data: {
                        action: "display_pagination_ajax_search",
                        pagedPagination: currentPaged,
                        search_query: search,
                        nonce: filterCatSearch.nonce,
                    },
                    success: function (response) {
                        const trimmedResponse = response.trim();
                        pagination.innerHTML = trimmedResponse;
                    },
                });
            }
            if(search) {
                jQuery.ajax({
                    url: filterCatSearch.ajaxurl,
                    type: "post",
                    data: {
                        action: "template_count_ajax_search",
                        paged: currentPaged,
                        search_query: search,
                        nonce: filterCatSearch.nonce,
                    },
                    success: function (response) {
                        const trimmedNotice = response.trim();
                        notice.innerHTML = trimmedNotice;
                    },
                });
            }
        });
        if(pagination) {
            pagination.addEventListener("click", function (event) {
                if (event.target.classList.contains("page-numbers")) {
                    event.preventDefault();
                    const pageNum = event.target.textContent;
                    currentPaged = parseInt(pageNum);
    
                    const metaKey = getDynamicMetaKey(selectedValue);
    
                    jQuery.ajax({
                        url: filterCatSearch.ajaxurl,
                        type: "post",
                        data: {
                            action: "custom_product_search_filter",
                            paged: currentPaged,
                            select: metaKey,
                            search_query: search,
                            nonce: filterCatSearch.nonce,
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
                        url: filterCatSearch.ajaxurl,
                        type: "post",
                        data: {
                            action: "display_pagination_ajax_search",
                            pagedPagination: currentPaged,
                            search_query: search,
                            nonce: filterCatSearch.nonce,
                        },
                        success: function (response) {
                            const trimmedResponse = response.trim();
                            pagination.innerHTML = trimmedResponse;
                        },
                    });
                    jQuery.ajax({
                        url: filterCatSearch.ajaxurl,
                        type: "post",
                        data: {
                            action: "template_count_ajax_search",
                            paged: currentPaged,
                            search_query: search,
                            nonce: filterCatSearch.nonce,
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
