jQuery(document).ready(function ($) {
    var liveSearchActivated = false;
    var resultsAppended = false;

    function activateLiveSearch() {
        console.log('Live search activated!');
        liveSearchActivated = true;
    }

    function performLiveSearch(searchQuery) {
        $.ajax({
            type: 'POST',
            url: toSearch.ajaxurl,
            data: {
                action: 'product_search',
                search_query: searchQuery,
                nonce: toSearch.nonce,
            },
            success: function (response) {
                console.log('AJAX Response:', response);
    
                if (response.success) {
                    var resultsHTML = response.data.results;
    
                    $('#search-results').html(resultsHTML);
                } else {
                    console.error('AJAX Error:', response.data);
                }
            },
        });
    }

    function close_search() {

        $(document).on('click', '.close-serch', function() {
            const search_data = $('#search-results');
            search_data.html('');
        });
    }


    $('#searchform').on('input', function (event) {
        event.preventDefault();

        var searchQuery = $('#s').val();

        if (!liveSearchActivated) {
            activateLiveSearch();
        }

        if (searchQuery.length >= 3) {
            performLiveSearch(searchQuery);
            close_search();
        } else {
            $('#search-results').html('');
        }
    });
});

