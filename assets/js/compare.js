(function ($) {
    'use strict';
    $(function () {
        $('.compare-product').on('click', function (event) {

            event.preventDefault();
            // Finding Prodct Card and Get Product Slug (sample)
            let productSlug  = $({PRODUCT_CLASS}).href.substring($({PRODUCT_CLASS}).href.lastIndexOf('/') + 1);
            
            // Pop up display link (sample)
            let notify = $('.notification');

             // generate link 
            let compareUrl = localStorage.getItem('compareUrl');
            if (compareUrl) {
                compareUrl = '/' + productSlug;
            } else {
                let baseUrl = document.location.origin;
                compareUrl = baseUrl + '/compare/' + productSlug ;
            }
          
            // it could be hashed !
            localStorage.setItem('compareUrl', compareUrl);

            // Add content to Popup
             notify.addClass('alert-success');
             notify.html('<a href="' + compareUrl + '">رفتن به صفحه مقایسه</a>');
             notify.show(400);

         });

         $('.remove-item').on('click', function (event) {

            event.preventDefault();
            // Finding Prodct Card and Get Product Slug (sample)
            let productSlug  = $({PRODUCT_CLASS}).href.substring($({PRODUCT_CLASS}).href.lastIndexOf('/') + 1);
            
             // generate link 
            let compareUrl = localStorage.getItem('compareUrl');
            if (compareUrl) {
                compareUrl = compareUrl.replace('/'+productSlug, '');
            } else {
                let baseUrl = document.location.origin;
                compareUrl = baseUrl + '/compare/';
            }
          
            // it could be hashed !
            localStorage.setItem('compareUrl', compareUrl);

            // Add content to Popup
             notify.addClass('alert-success');
             notify.html('<a href="' + compareUrl + '">رفتن به صفحه مقایسه</a>');
             notify.show(400);

         });
    });

})(jQuery);