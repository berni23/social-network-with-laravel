    <div id="modal-delete"
        class="modal z-50 opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <br>
            <h3 class="flex justify-center text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                Are you sure? This operation can not be undone
            </h3>
            <br><br>
            <form id="form-delete" method="POST" class="modal-content py-4 text-left px-6">
                @csrf

                <div class="flex justify-center pt-2justify">
                    <input type="submit" id="delete-confirm"
                        class="modal-close px-4 bg-red-400 p-3 focus:outline-none rounded-lg text-white-500 hover:bg-gray-100 hover:text-indigo-400 mr-2"
                        value="delete">
                    <button id="delete-close"
                        class="modal-close px-4 bg-transparent p-3 focus:outline-none  rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Cancel</button>
                </div>
            </form>
        </div>
    </div>
