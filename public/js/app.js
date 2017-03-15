/*
* Insert a form on the click response comment
* */
var replyAll = document.querySelectorAll('.reply');
var form;
var formOpened = false;
var xhr = new XMLHttpRequest();

if (replyAll) {
    form = document.createElement('form');
    /*form.setAttribute('action', '/response-comment');
    form.setAttribute('method', 'post');*/
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
        reply.children[2].addEventListener('click', function (e) {
            e.stopPropagation();
            e.preventDefault();
            reply.parentNode.insertBefore(form, reply.nextSibling);
            commentId = this.parentNode.getAttribute('data-id');
            articleId = this.parentNode.getAttribute('data-article_id');
            formOpened = true;
        });
    });

    form.addEventListener('submit', function (e) {
        var content = this.firstChild.value;
        var self = this;

        e.preventDefault();

        $.post('/response-comment', {
            id_parent: commentId,
            id_article: articleId,
            content: content
        }).done(function () {
            self.firstChild.value = '';
            window.top.location.reload();
        })
    });

    form.addEventListener('click', function (e) {
        e.stopPropagation();
    });

    document.body.addEventListener('click', function() {
        if(formOpened) {
            form.firstChild.value = '';
            form.remove();
            formOpened = false;
        }
    });
}

/*
* Insert modal with the response flashbag
* */
var modalClose = document.querySelector('.alert-remove');

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

/*
* Dynamic Title
* */
var titleArticle = document.querySelector('#article-page article h2').textContent;
var title = document.querySelector('head title');

title.textContent = titleArticle;