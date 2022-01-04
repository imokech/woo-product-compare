(function ($) {
    'use strict';
    $(function () {
        console.log(WCP_OBJ.compare_page_url);
        $('.compare-product').on('click', function (event) {

            event.preventDefault();
            // Finding Prodct Card and Get Product Slug (sample)
            let productSlug  = $('.add-compare-product').href.substring($({'.add-compare-product'}).href.lastIndexOf('/') + 1);
            
            // Pop up display link (sample)
            let notify = $('.notification');

             // generate link 
            let compareUrl = localStorage.getItem('compareUrl');
            if (compareUrl) {
                compareUrl = '/' + productSlug;
            } else {
                compareUrl = WCP_OBJ.compare_page_url + productSlug ;
            }
          
            // it could be hashed !
            localStorage.setItem('compareUrl', compareUrl);

            // Add content to Popup
            //  notify.addClass('alert-success');
            //  notify.html('<a href="' + compareUrl + '">رفتن به صفحه مقایسه</a>');
            //  notify.show(400);

            alert(compareUrl);

         });
    });

})(jQuery);