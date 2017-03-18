/*
* Insert a form on the click response comment
* */
$(function () {
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
});

