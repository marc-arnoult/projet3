$(function () {

    if ($(window).width() < 780) {
        $('.reply').css({
            'width': '320px'
        });
    } else {
        $('.reply').css({
            'width': '520px'
        });
    }

    var $replyElt = $('.reply');

    var $window = $(window);

    $window.on('scroll', check_if_in_view);
    $window.on('scroll resize', check_if_in_view);
    $window.trigger('scroll');

    function check_if_in_view() {
        var window_height = $window.height();
        var window_top_position = $window.scrollTop();
        var window_bottom_position = (window_top_position + window_height);
        var duration = 1.2;

        $.each($replyElt, function () {
            var $element = $(this);
            var element_height = $element.outerHeight();
            var element_top_position = $element.offset().top;
            var element_bottom_position = (element_top_position + element_height);
            duration += 0.5;
            //check to see if this current container is within viewport
            if ((element_bottom_position >= window_top_position) &&
                (element_top_position <= window_bottom_position)) {
                $element.css({
                    'transition-duration': duration + 's',
                    'transition-delay': '0.2s',
                    'opacity': '1',
                    'transform': 'translateY(0px)'
                });

            } else {
                $element.css({
                    'transition-duration': 'none',
                    'transition-delay': 'none',
                    'opacity': '0',
                    'transform': 'translateY(200px)'
                });
            }
        });
    }
});
