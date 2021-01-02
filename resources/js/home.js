var postId = document.getElementById('post-id');
var body = document.querySelector('body');
var modalComment = document.getElementById('modal-comment');
var modalDelete = document.getElementById('modal-delete');
var formDelete = document.getElementById('form-delete');

document.querySelector('main').addEventListener('click', function (event) {
    var list = event.target.classList;
    if (list.contains('modal-open-comment')) {
        event.preventDefault();
        toggleModal(modalComment);
        postId.value = event.target.closest('.post').getAttribute('data-post');
    } else if (event.target.id == "comment-close") {
        event.preventDefault();
        toggleModal(modalComment);
    } else if (list.contains('post-edit-menu')) {
        event.target.querySelector('.dropdown-content').classList.toggle('block');
    } else if (list.contains('modal-open-deletePost')) {
        toggleModal(modalDelete);
        postId = event.target.closest('.post').getAttribute('data-post');
        formDelete.action = `posts/delete/${postId}`;

    }
});

document.onkeydown =
    function (evt) {
        evt = evt || window.event;
        var isEscape = false
        if ("key" in evt) isEscape = (evt.key === "Escape" || evt.key === "Esc")
        else isEscape = (evt.keyCode === 27)
        if (isEscape && document.body.classList.contains('modal-active')) toggleModal()
    };

function toggleModal(modal) {
    modal.classList.toggle('opacity-0')
    modal.classList.toggle('pointer-events-none')
    body.classList.toggle('modal-active')
}
