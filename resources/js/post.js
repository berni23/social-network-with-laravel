var main = document.querySelector('main');
var modalComment = document.getElementById('modalComment');
var modalDelete = document.getElementById('modalDelete');
var formDelete = document.getElementById('form-delete');
var groupElem = document.getElementById('group');
var postGroup = 'all';
if (groupElem) postGroup = groupElem.getAttribute('data-group');
var content = groupElem.getAttribute('data-content');
let last_known_scroll_position = 0;
let ticking = false;
let page = 0;
let scrollActive = true;
const limit = 4;


nextPage();
main.addEventListener('click', function (event) {
    var list = event.target.classList;
    if (list.contains('openComment')) postId.value = event.target.closest('.post').getAttribute('data-post');
    else if (list.contains('post-edit-menu')) event.target.querySelector('.dropdown-content').classList.toggle('block');
    else if (list.contains('deletePost')) {
        event.target.closest('.post-edit-menu').click();
        var postId = event.target.closest('.post').getAttribute('data-post');
        formDelete.action = `posts/delete/${postId}`;
    } else if (event.target.closest('.likeComment')) {
        var like = event.target.closest('.likeComment')
        like.children[0].classList.toggle('hidden');
        like.children[1].classList.toggle('hidden');
        sendLike('comment', like.closest('.comment').getAttribute('data-comment')).then((data) => console.log(data));
    } else if (event.target.closest('.likePost')) {
        var like = event.target.closest('.likePost')
        like.children[0].classList.toggle('hidden');
        like.children[1].classList.toggle('hidden');
        console.log(like.closest('.post').getAttribute('data-post'));
        sendLike('post', like.closest('.post').getAttribute('data-post')).then((data) => console.log(data));
    }
});

document.addEventListener('scroll', scrollBottom);

async function sendLike(likeable, id) {

    const res = await fetch(`/likes/${likeable}/${id}`, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        method: 'GET'
    });
    return await res.text(); // view('postPopulate',compact('posts'))
}

function createFormData(data) {

    var formData = new FormData();
    Object.keys(data).forEach(function (key) {
        formData.append(key, data[key]);
    })
    return formData;
}


async function getPosts(_offset, _limit) {


    var data = {
        group: postGroup,
        offset: _offset,
        limit: _limit,
    }

    if (content) data['content'] = content;


    console.log(data);


    //var formData = new FormData();

    //formData.append('data', JSON.stringify(data));

    const res = await fetch('/posts/page', {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        method: 'POST',
        body: createFormData(data)

    });
    return await res.text(); // view('postPopulate',compact('posts'))
}

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
