/*
* Insert a form on the click response comment
* */
$(function () {
    var $nav = $('#responsive-menu');
    var $bars = $('header .fa-bars');

    $bars.css({
        position: 'absolute',
        top: '30px',
        right: '5%',
        color: '#000'
    });

    if($(window).width() <= 980) {
        $bars.click(function (e) {
            e.preventDefault();

            if($nav.css('display') == 'none') {
                $nav.insertAfter('header');
                $nav.css({
                    display: 'block'
                })
            } else {
                $nav.css('display', 'none');
            }
        })
    }
    /*
     * Insert modal with the response flashbag
     * */
    $('.alert-remove').click(function () {
        $(this).parent().remove();
    });

    setTimeout(function () {
        $('.alert-remove').parent().animate({
            left:"+=100",
            opacity: 0
        }, 1800, function () {
           $('.alert-remove').parent().remove();
        });
    }, 2100);

    /*
     * Dynamic Title
     * */
    var $reportingBtn = $('.btn-reporting');

    if($reportingBtn) {
        $($reportingBtn).click(function (e) {
            e.preventDefault();
            e.stopPropagation();

            $.ajax({
                url: '/reporting-comment',
                method: 'POST',
                data: {
                    id: $(this).parent().data('id'),
                    idArticle: $(this).parent().data('article_id')
                }
            }).done(function () {
                top.location.reload();
            });
        })
    }
});

