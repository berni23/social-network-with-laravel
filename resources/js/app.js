require('./bootstrap');
require('alpinejs');
require('./modals');
import $ from 'jquery';
window.$ = window.jQuery = $;

window.onload = function () {


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

    if (bell) {
        var notificationsList = document.getElementById('notifications-list');
        var modalRequest = document.getElementById('modalRequest');
        bell.addEventListener('click', toggleNotifications);
        notificationsList.addEventListener('click', function (event) {
            var list = event.target.classList;
            if (list.contains('notification')) {
                var name = event.target.getAttribute('data-name');
                var id = event.target.getAttribute('data-id');

                console.log(modalRequest);
                modalRequest.querySelector('#modal-headline').innerHTML = `<b>${name}</b> &nbsp sent you a friendship request 🤗 `
                modalRequest.querySelector('#modal-content').innerHTML = 'Become friends by pressing accept, or decline his / her request '
                modalRequest.querySelector('#form-request').action = `/user/respond/${id}`;
                modalRequest.querySelector('[name=relStatus').value = event.target.getAttribute('data-status');
            }
        })
        populateNotifications();
    }

    var userActions = document.getElementById('user-actions');

    if (userActions) {

        userActions.childNodes.forEach(function (child) {
            child.addEventListener('mouseenter', function (event) {
                var dataTooltip = this.getAttribute('data-tooltip');

                console.log(dataTooltip, event.target.id)
                if (dataTooltip) document.getElementById(dataTooltip).classList.remove('invisible');
            })

            child.addEventListener('mouseleave', function (event) {
                var dataTooltip = event.target.getAttribute('data-tooltip');
                if (dataTooltip) document.getElementById(dataTooltip).classList.add('invisible');

            })
        })
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
               but can be easily refactored in order to allow for  custom user messages*/

            data.forEach(function (pending) {
                    var notification = document.createElement('li');
                    notification.classList.add('notification');
                    notification.classList.add('modal-open');
                    notification.innerHTML = 'New request! &nbsp; 🎉';
                    notification.setAttribute('data-name', pending['name']);
                    notification.setAttribute('data-id', pending['id'])
                    notification.setAttribute('data-status', pending['status'])
                    notification.setAttribute('data-modal', 'modalRequest');
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

}
