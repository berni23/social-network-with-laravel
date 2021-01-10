var body = document.querySelector('body');

body.addEventListener('click',

    function (event) {

        var list = event.target.classList;
        if (list.contains('modal-open') || list.contains('modal-close')) {
            event.preventDefault();
            var modalId = event.target.getAttribute('data-modal')
            var modal = document.getElementById(modalId)
            toggleModal(modal)
        }
    }
);


function toggleModal(modal) {
    modal.classList.toggle('opacity-0')
    modal.classList.toggle('pointer-events-none')
    body.classList.toggle('modal-active')
}
