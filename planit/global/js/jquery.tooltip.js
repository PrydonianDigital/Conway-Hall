(function ($) {
    $.fn.tooltip = function (options) {

        var defaults = {
            color: '#ffffff',
            tipColor: '#000000'
        };
        var options = $.extend(defaults, options);

        $(this).hover(

        function () {
            $(this).append($('<div class="tooltip" style="color:' + options.color + '; background-color:' + options.tipColor + ';">' + $(this).attr('title') + ' <div class="tip-bottom"></div></div>'));
        }, function () {
            $(this).find('.tooltip').remove();
        });

    };
})(jQuery);