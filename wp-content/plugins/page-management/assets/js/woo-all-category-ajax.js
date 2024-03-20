document.addEventListener("DOMContentLoaded", function () {
    const select = document.querySelector('.my-custom-select select');
    const target = document.querySelector('.products');
    const pagination = document.querySelector(".woocommerce-pagination");
    const notice = document.querySelector('.woocommerce-result-count');
    let selectedValue;
    let currentPaged = 1;

var bodyClasses = document.body.className;
var classArray = bodyClasses.split(' ');
var termId = null;

for (var i = 0; i < classArray.length; i++) {
    var currentClass = classArray[i];
    if (currentClass.match(/^term-\d+$/)) {
        termId = currentClass.substring(5);
        break; 
    }
}
termId = parseInt(termId);

if (isNaN(termId)) {
    termId = null;
}

    if (select && target) {
        select.addEventListener('change', function (event) {
            selectedValue = select.value;
            const metaKey = getDynamicMetaKey(selectedValue);

            jQuery.ajax({
                url: filterCatAll.ajaxurl,
                type: 'post',
                data: {
                    action: 'custom_product_general_archive_filter',
                    select: selectedValue,
                    meta_key: metaKey,
                    nonce: filterCatAll.nonce,
                    paged: currentPaged,
                    termId: termId
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
                    url: filterCatAll.ajaxurl,
                    type: "post",
                    data: {
                        action: "display_pagination_general_archive",
                        pagedPagination: currentPaged,
                        termId: termId,
                        nonce: filterCatAll.nonce,
                    },
                    success: function (response) {
                        const trimmedResponse = response.trim();
                        pagination.innerHTML = trimmedResponse;
                    },
                });
            }

            jQuery.ajax({
                url: filterCatAll.ajaxurl,
                type: "post",
                data: {
                    action: "template_count_ajax",
                    paged: currentPaged,
                    termId: termId,
                    nonce: filterCatAll.nonce,
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
                        url: filterCatAll.ajaxurl,
                        type: "post",
                        data: {
                            action: "custom_product_general_archive_filter",
                            paged: currentPaged,
                            select: metaKey,
                            termId: termId,
                            nonce: filterCatAll.nonce,
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
                        url: filterCatAll.ajaxurl,
                        type: "post",
                        data: {
                            action: "display_pagination_general_archive",
                            pagedPagination: currentPaged,
                            termId: termId,
                            nonce: filterCatAll.nonce,
                        },
                        success: function (response) {
                            const trimmedResponse = response.trim();
                            pagination.innerHTML = trimmedResponse;
                        },
                    });
                    jQuery.ajax({
                        url: filterCatAll.ajaxurl,
                        type: "post",
                        data: {
                            action: "template_count_ajax",
                            termId: termId,
                            paged: currentPaged,
                            nonce: filterCatAll.nonce,
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
