<div id="modalComment" class="z-50 modal  @php if(!$errors->any()){ echo " opacity-0 pointer-events-none";}@endphp fixed
    w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <form method="POST" action="/comments/create" class="modal-content py-4 text-left px-6">
            @csrf
            <textarea name="content" rows="4" cols="40" class="input-comment resize-none border rounded-md "
                placeholder="Comment.."></textarea>
            @if ($errors->has('content'))
                <div class="error">
                    POSTS {{ $errors->first('content') }}
                </div>
            @endif
            <input id="post-id" name="post_id" type="text" class="hidden" @if (Session::has('post_id')) value = {{ Session::get('post_id') }} @endif >
            <div class="flex justify-end pt-2justify">
                <input type="submit" id="comment-send"
                    class="px-4 bg-transparent p-3 focus:outline-none rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2"
                    value="Post">
                <button id="comment-close" data-modal='modalComment'
                    class="modal-close px-4 bg-transparent p-3 focus:outline-none  rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Close</button>
            </div>
        </form>
    </div>
</div>
