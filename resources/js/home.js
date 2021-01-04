var postId = document.getElementById('post-id');
var body = document.querySelector('body');
var main = document.querySelector('main');
var modalComment = document.getElementById('modal-comment');
var modalDelete = document.getElementById('modal-delete');
var formDelete = document.getElementById('form-delete');
// var editMenu = document.querySelector('.post-edit-menu');

// the only eventlistener in home

document.querySelector('main').addEventListener('click', function (event) {
    var list = event.target.classList;
    if (list.contains('modal-open-comment')) {
        event.preventDefault();
        toggleModal(modalComment);
        postId.value = event.target.closest('.post').getAttribute('data-post');
    } else if (list.contains('post-edit-menu')) {
        event.target.querySelector('.dropdown-content').classList.toggle('block');
    } else if (list.contains('modal-open-deletePost')) {
        toggleModal(modalDelete);
        event.target.closest('.post-edit-menu').click();
        postId = event.target.closest('.post').getAttribute('data-post');
        formDelete.action = `posts/delete/${postId}`;
    }
});


document.getElementById('delete-close').addEventListener('click', function (event) {
    event.preventDefault();
    toggleModal(modalDelete);
})

document.getElementById('comment-close').addEventListener('click', function (event) {
    event.preventDefault();
    toggleModal(modalComment);
})


function toggleModal(modal) {
    modal.classList.toggle('opacity-0')
    modal.classList.toggle('pointer-events-none')
    body.classList.toggle('modal-active')
}

async function getPosts(offset, limit) {

    const res = await fetch(`/posts/page/${offset}/${limit}`, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        method: 'GET'
    });
    return await res.text(); // view('postPopulate',compact('posts'))
}

let last_known_scroll_position = 0;
let ticking = false;
let page = 0;
const limit = 4;
nextPage();

function nextPage() {
    getPosts(limit * page, limit).then(function (postView) {
        console.log(postView);
        if (postView == 0) {
            console.log('eventlistener removed');
            document.removeEventListener('scroll', scrollBottom);
        } else {

            main.insertAdjacentHTML('beforeend', postView);
            page++;
        }
    })
}

document.addEventListener('scroll', scrollBottom);


var scrollActive = true;

function scrollBottom() {

    last_known_scroll_position = $(window).scrollTop() + $(window).height();
    var docHeight = $(document).height();
    if (!ticking && scrollActive) {
        window.requestAnimationFrame(function () {
            ticking = false;
            // console.log(last_known_scroll_position, docHeight - 50);
            if (last_known_scroll_position > docHeight - 50) {
                nextPage();
                scrollActive = false;
                setTimeout(() => scrollActive = true, 500);
            }
        });
        ticking = true;
    }
}

// close-modal
// document.onkeydown =
//     function (evt) {
//         evt = evt || window.event;
//         var isEscape = false
//         if ("key" in evt) isEscape = (evt.key === "Escape" || evt.key === "Esc")
//         else isEscape = (evt.keyCode === 27)
//         if (isEscape && document.body.classList.contains('modal-active')) toggleModal()
//     };
