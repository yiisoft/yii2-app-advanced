jQuery(function ($) {

    // Global scripts here
    $(document).ajaxStart(function() { Pace.restart(); });

});