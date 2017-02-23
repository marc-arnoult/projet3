var modalClose = document.querySelector('.alert-remove');


if (modalClose) {
    var modal = modalClose.parentNode;

    modalClose.addEventListener('click', function (e) {
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