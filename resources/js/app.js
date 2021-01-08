require('./bootstrap');
require('alpinejs');
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
