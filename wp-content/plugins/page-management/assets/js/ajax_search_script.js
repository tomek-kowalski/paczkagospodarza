jQuery(document).ready(function ($) {
    var liveSearchActivated = false;
    var xhr; 

    function activateLiveSearch() {
        liveSearchActivated = true;
    }

    function performLiveSearch(searchQuery) {
        if (xhr && xhr.readyState !== 4) {
            xhr.abort();
        }

        xhr = $.ajax({
            type: 'POST',
            url: toSearch.ajaxurl,
            data: {
                action: 'product_search',
                search_query: searchQuery,
                nonce: toSearch.nonce,
            },
            success: function (response) {
                if (response.success) {
                    var resultsHTML = response.data.results;

                    if (resultsHTML.includes('No products found')) {
                        $('#search-results').html('<p>No products found</p>');
                    } else {
                        $('#search-results').html(resultsHTML);
                    }
                }
            },
        });
    }

    function close_search() {
        $('#search-results').html('');
    }

    $('#searchform').on('input', function (event) {
        event.preventDefault();

        var searchQuery = $('#s').val();

        if (!liveSearchActivated) {
            activateLiveSearch();
        }

        if (searchQuery.length >= 4) {
            performLiveSearch(searchQuery);
        } else {
            close_search(); 
        }
    });

    $(document).on('click', '.close-serch', function() {
        close_search();
    });
});
