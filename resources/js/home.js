var postId = document.getElementById('post-id');
var body = document.querySelector('body');
var main = document.querySelector('main');
var modalComment = document.getElementById('modal-comment');
var modalDelete = document.getElementById('modal-delete');
var formDelete = document.getElementById('form-delete');
var editMenu = document.querySelector('.post-edit-menu');

// the only eventlistener in home

document.querySelector('main').addEventListener('click', function (event) {
    var list = event.target.classList;
    if (list.contains('modal-open-comment')) {
        event.preventDefault();
        toggleModal(modalComment);
        postId.value = event.target.closest('.post').getAttribute('data-post');
    } else if (event.target.id == "comment-close") {
        event.preventDefault();
        toggleModal(modalComment);
    } else if (event.target.id == "delete-close") {
        event.preventDefault();
        toggleModal(modalDelete);
    } else if (list.contains('post-edit-menu')) {
        event.target.querySelector('.dropdown-content').classList.toggle('block');
    } else if (list.contains('modal-open-deletePost')) {
        toggleModal(modalDelete);
        editMenu.click();
        postId = event.target.closest('.post').getAttribute('data-post');
        formDelete.action = `posts/delete/${postId}`;
    }
});

function toggleModal(modal) {
    modal.classList.toggle('opacity-0')
    modal.classList.toggle('pointer-events-none')
    body.classList.toggle('modal-active')
}

async function getPosts(_offset, _limit) {

    var data = {
        offset: _offset,
        limit: _limit
    }
    const res = await fetch('/posts/page/', {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        method: 'POST',
        body: JSON.stringify(data)
    });
    return await res.text();
}


let last_known_scroll_position = 0;
let ticking = false;
let page = 0;
const limit = 5;
nextPage();

function nextPage() {

    page++;
    getPosts(limit * page, limit).then(function (postView) {
        if (postView == '0') document.removeEventListener("scroll");
        else {

            console.log(postView);
            main.insertAdjacentHTML('beforeend', postView);
        }
    })
}
document.addEventListener('scroll', function () {
    last_known_scroll_position = window.scrollY;
    if (!ticking) {
        window.requestAnimationFrame(function () {
            ticking = false;
            if (last_known_scroll_position > document.documentElement.scrollHeight - 100) nextPage();
        });
        ticking = true;
    }
});

// close-modal
// document.onkeydown =
//     function (evt) {
//         evt = evt || window.event;
//         var isEscape = false
//         if ("key" in evt) isEscape = (evt.key === "Escape" || evt.key === "Esc")
//         else isEscape = (evt.keyCode === 27)
//         if (isEscape && document.body.classList.contains('modal-active')) toggleModal()
//     };
