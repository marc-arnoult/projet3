var modalClose = document.querySelector('.alert-remove');
var replyAll = document.querySelectorAll('.reply');
var form;
var formOpened = false;

if (modalClose) {
    var modal = modalClose.parentNode;

    modalClose.addEventListener('click', function () {
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
var xhr = new XMLHttpRequest();

if (replyAll) {
    form = document.createElement('form');
    form.setAttribute('action', '/response-comment');
    form.style.display = 'flex';
    form.style.width = '100%';
    form.style.alignItems = 'center';
    form.style.marginTop = '8px';

    var textarea = document.createElement('textarea');
    textarea.style.width = '75%';
    textarea.style.height = '90px';
    textarea.setAttribute('name', 'content');

    var submit = document.createElement('input');
    submit.setAttribute('type', 'submit');
    submit.setAttribute('value', 'Envoyer');

    form.appendChild(textarea);
    form.appendChild(submit);

    var commentId;
    var articleId;

    replyAll.forEach(function (reply) {
        reply.addEventListener('click', function (e) {
            e.stopPropagation();
            e.preventDefault();
            this.parentNode.insertBefore(form, this.nextSibling);
            commentId = JSON.parse(this.getAttribute('data-id'));
            articleId = JSON.parse(this.getAttribute('data-article_id'));
            formOpened = true;
        });
    });
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        console.log(commentId);
        console.log($.post('/response-comment', {
            id_comment: commentId,
            id_article: articleId,
            content: this.firstChild.value
        }));
    });
    form.addEventListener('click', function (e) {
        e.stopPropagation();
    })
    document.body.addEventListener('click', function(e) {
        if(formOpened) {
            form.firstChild.value = '';
            form.remove();
            formOpened = false;
        }
    });
}
