require('./bootstrap');
require('alpinejs');
require('./modals');
import $ from 'jquery';
window.$ = window.jQuery = $;


var messageHidden = document.getElementById('messageHidden');
if (messageHidden) {
    var status = messageHidden.getAttribute('data-status');
    var msg = messageHidden.textContent;
    message(msg, status);
}



/**
 * @param {string} msg message to be displayed
 * @param {string} tag (optional), tag to be added to the message.possible tags: success, error
 * @description  displays a user-friendly message during 1.5 seconds
 */

function message(msg, tag = false) {
    if (tag == 200) tag = 'success';
    else if (tag == 400) tag = 'failure';
    var infoWindow = document.querySelector(".info-window");
    if (tag) infoWindow.classList.add(tag);
    infoWindow.textContent = msg;
    infoWindow.classList.add("show-info");
    infoWindow.classList.remove("hidden");
    setTimeout(function () {
        infoWindow.classList.remove("show-info");
        setTimeout(() => {
            infoWindow.classList.add("hidden");
            if (tag) infoWindow.classList.remove(tag);
        }, 1000);
    }, 1500);
}

function toggleNotifications() {
    document.getElementById('notifications-list').classList.toggle('block');
}

var bell = document.getElementById('bell');

console.log(bell);
if (bell) {

    console.log(' beeell!');
    var notificationsList = document.getElementById('notifications-list');
    bell.addEventListener('click', toggleNotifications);
    populateNotifications();

}

function populateNotifications() {
    getNotifications().then(function (data) {

        console.log(data);
        data = JSON.parse(data);
        if (!data) return;
        var num = data.length;
        if (num == 0) return;
        var badge = document.getElementById('badge');
        badge.textContent = num;
        badge.classList.add('badge');
        badge.classList.remove('hidden');

        /* for now, the only notifications are friendship requests,
           but can be easily refactored in order to allow custom user messages*/

        data.forEach(function (pending) {
                var notification = document.createElement('li');
                notification.innerHTML = '<b>New request!</b> &nbsp; 🎉';
                notification.setAttribute('data-name', pending['name']);
                notificationsList.append(notification);
            }

        )

    });
}

async function getNotifications() {
    const res = await fetch('/user/notifications/all', {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        method: 'GET'
    });

    return await res.text();
}
