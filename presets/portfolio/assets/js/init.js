(function($) {




    function initWoocommerceFilters() {
        if ($(".woocommerce-ordering").length > 0) {
            $(".woocommerce-ordering > select").select2({
                minimumResultsForSearch: Infinity
            });

        }
        if ($(".variations select").length > 0) {
            $(".variations select").select2({
                minimumResultsForSearch: Infinity
            });
        }
    }

    $(document).ready(function() {


        initWoocommerceFilters();
    });





}(jQuery));