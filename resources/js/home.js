var postId = document.getElementById('post-id');
const body = document.querySelector('body')
const modal = document.querySelector('.modal')

document.querySelector('main').addEventListener('click', function (event) {
    var list = event.target.classList;
    if (list.contains('modal-open')) {
        event.preventDefault();
        toggleModal();
        postId.value = event.target.getAttribute('data-post');
    } else if (event.target.id == "comment-close") {
        event.preventDefault();
        toggleModal();
    } else if (list.contains('modal-close') || list.contains('modal-overlay')) {}

});

document.onkeydown =
    function (evt) {
        evt = evt || window.event;
        var isEscape = false
        if ("key" in evt) isEscape = (evt.key === "Escape" || evt.key === "Esc")
        else isEscape = (evt.keyCode === 27)
        if (isEscape && document.body.classList.contains('modal-active')) toggleModal()
    };

function toggleModal() {
    modal.classList.toggle('opacity-0')
    modal.classList.toggle('pointer-events-none')
    body.classList.toggle('modal-active')
}
