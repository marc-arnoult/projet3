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
    })

    console.log($bars);

    if($(window).width() <= 780) {
        $bars.click(function (e) {
            e.preventDefault();

            if($nav.css('display') == 'none') {
                $nav.insertAfter('header');
                $nav.css({
                    display: 'block'
                })
            } else {
                $nav.css('display', 'none')
            }
        })
    }
    /*
     * Insert modal with the response flashbag
     * */
    var modalClose = document.querySelector('.alert-remove');

    if (modalClose) {
        var modal = modalClose.parentNode;

        $(modalClose).click(function () {
            modal.remove();
        });
        setTimeout(function () {
            modal.style.transition = "0.8s ease-in";
            modal.style.transform = "translateX(120px)";
            modal.style.opacity = 0;
        }, 2100);
        setTimeout(function () {
            modal.remove();
        }, 2900);
    }
    /*
     * Dynamic Title
     * */
    var $reportingBtn = $('.btn-reporting');

    if($reportingBtn) {
        $($reportingBtn).click(function (e) {
            e.preventDefault();
            $.ajax({
                url: '/reporting-comment',
                method: 'POST',
                data: {
                    id: $(this).parent().data('id'),
                    idArticle: $(this).parent().data('article_id')
                },
                success: function (response) {
                    window.location.reload();
                }
            })
        })
    }
});

