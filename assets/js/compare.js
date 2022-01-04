(function ($) {
    'use strict';
    $(function () {
        let slugs = [];
        
        $('.add-compare-product').on('click', function (event) {
            event.preventDefault();

            let localSlugs =  JSON.parse(localStorage.getItem('compareUrl'));

            if (localSlugs > 1) {
                slugs = compareUrl;
            }
            // Finding Prodct Card and Get Product Slug (sample)
            let productSlug  = $(this).attr('data-slug');

            // Pop up display link (sample)
            let notify = $('.notification');
            
            // generate link 
            if (!slugs.includes(productSlug)) {
                if (slugs.length > 1) {
                    slugs.shift()
                }
                slugs.push(productSlug);
            } else {
                alert('already selected!');
            }
            
            let productCompareSlugs = '';
            $.each(slugs, function( index, value ) {
                productCompareSlugs += value + '/';
            });

            let compareUrl = WCP_OBJ.compare_page_url + '/' + productCompareSlugs ;
            
            // it could be hashed !
            localStorage.setItem('compareUrl',  JSON.stringify(slugs));

            // Add content to Popup
            //  notify.addClass('alert-success');
            //  notify.html('<a href="' + compareUrl + '">رفتن به صفحه مقایسه</a>');
            //  notify.show(400);

            alert(compareUrl);
        
        });
    });

})(jQuery);