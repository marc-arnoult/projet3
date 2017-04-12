$(function () {
    var $home_last_comment = $('#home-page-lastComment');
    var $replys = $('.reply');

    var $window = $(window);

    $window.on('scroll', check_if_in_view);
    $window.on('scroll resize', check_if_in_view);
    $window.trigger('scroll');

    function check_if_in_view() {
        var window_height = $window.height();
        var window_top_position = $window.scrollTop();
        var window_bottom_position = (window_top_position + window_height);
        var duration = 1;

        $.each($home_last_comment, function () {
            var $element = $(this);
            var element_height = $element.outerHeight();
            var element_top_position = $element.offset().top;
            var element_bottom_position = (element_top_position + element_height);
            duration += 0.8;
            //check to see if this current container is within viewport
            if ((element_bottom_position >= window_top_position) &&
                (element_top_position <= window_bottom_position)) {
                $replys.css({
                    'transition-duration': duration + 's',
                    'opacity': '1',
                    'transform': 'translateY(-20px)'
                });

            }
        });
    }

    $('form').submit(function (e) {
        e.preventDefault();

        var $email = $('form input[name=email]').val();
        var $subject = $('form input[name=subject]').val();
        var $message = $('form textarea[name=message]').val();

        $.ajax({
            method: 'POST',
            url: '/send-email',
            data: {
                from: $email,
                subject: $subject,
                message: $message
            },
            error: function () {
                window.location.reload();
            }
        }).done(function () {
            window.location.reload();
        });
    });
});
