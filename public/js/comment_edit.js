$(function () {
    $(".btn-delete").click(function (e) {
        e.preventDefault();

        $.ajax({
            url: '/delete-comment',
            type: 'DELETE',
            data: {
                id: this.parentNode.getAttribute('data-id')
            },
            success: function () {
                window.location.reload();
            }
        });
    });

    var formEditOpened = false;

    var formEdit = document.createElement('form');
    /*form.setAttribute('action', '/response-comment');
     form.setAttribute('method', 'post');*/
    formEdit.style.display = 'flex';
    formEdit.style.width = '100%';
    formEdit.style.alignItems = 'center';
    formEdit.style.marginTop = '8px';

    var textarea = document.createElement('textarea');
    textarea.style.width = '75%';
    textarea.setAttribute('name', 'content');

    var submit = document.createElement('input');
    submit.setAttribute('type', 'submit');
    submit.setAttribute('value', 'Envoyer');

    formEdit.appendChild(textarea);
    formEdit.appendChild(submit);
    formEdit.addEventListener('click', function (e) {
        e.stopPropagation();
    });

    var btnEdit = document.querySelectorAll(".btn-edit");
    var commentId;
    var newContent;
    var oldContent;

    btnEdit.forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            e.preventDefault();

            if(formEditOpened) {
                $(formEdit).each(function() {
                    $(this.firstChild).animate({
                        height: 0
                    }, "normal");
                });

                setTimeout(function () {
                    formEdit.remove();
                }, 300);

                formEditOpened = false;
            } else {
                commentId = this.parentNode.getAttribute('data-id');
                oldContent = this.parentNode.childNodes[11].textContent;
                formEdit.firstChild.textContent = oldContent;

                $(formEdit).insertAfter(this.parentNode);

                $(formEdit).each(function() {
                    $(this.firstChild).animate({
                        height: 100
                    }, "normal");
                });

                formEditOpened = true;
            }

        });
    });

    formEdit.addEventListener('submit', function (e) {
        newContent = this.firstChild.value;
        e.preventDefault();
        $.ajax({
            url: '/edit-comment',
            type: 'PUT',
            data: {
                content: newContent,
                id: commentId
            },
            success: function () {
                window.location.reload();
            }
        });
    });

    document.body.addEventListener('click', function() {
        if(formEditOpened) {
            $(formEdit).each(function() {
                $(this.firstChild).animate({
                    height: 0
                }, "normal");
            });
            setTimeout(function () {
                formEdit.remove();
            }, 300);

            formEditOpened = false;
        }
    });

    $('.reply').each(function (e) {
        this.style.opacity = '0';
    });

    var $animation_elements = $('.reply');
    var $window = $(window);

    $window.on('scroll', check_if_in_view);
    $window.on('scroll resize', check_if_in_view);
    $window.trigger('scroll');

    function check_if_in_view() {
        var window_height = $window.height();
        var window_top_position = $window.scrollTop();
        var window_bottom_position = (window_top_position + window_height);

        $.each($animation_elements, function() {
            var $element = $(this);
            var element_height = $element.outerHeight();
            var element_top_position = $element.offset().top;
            var element_bottom_position = (element_top_position + element_height);

            //check to see if this current container is within viewport
            if ((element_bottom_position >= window_top_position) &&
                (element_top_position <= window_bottom_position)) {
                $element.css({
                    'transition-duration': '1.4s',
                    'transition-delay': '0.1s',
                    'opacity': '1',
                    'transform': 'translateX(0px)'
                });
            } else {
                $element.css({
                    'transition-duration': 'none',
                    'transition-delay': 'none',
                    'opacity': '0',
                    'transform': 'translateX(-220px)'
                });
            }
        });
    }

    var titleArticle = document.querySelector('#article-page article h2').textContent;
    var title = document.querySelector('head title');

    title.textContent = titleArticle;
});