@extends ('layouts.app')

@section('head')
    <script src="{{ mix('js/home.js') }}" defer></script>
@endsection

@section('main')
    {{-- @php echo json_encode($posts); @endphp --}}
    @foreach ($posts as $post)
        <div class="post" data-post={{ $post->id }}>
            <div class="header">
                <div class="wrapper">
                    @if (isset(App\Models\User::find($post->user_id)->profile_photo_path))
                        <img class="profile-pic"
                            src="{{ asset('/storage/' . App\Models\User::find($post->user_id)->profile_photo_path) }}">
                    @endif
                    <span class="name-profile">
                        {{ App\Models\User::find($post->user_id)->name }}
                    </span>
                </div>

                @if (auth()->user()->id == App\Models\User::find($post->user_id)->id)
                    <i class="dropdown fa fa-ellipsis-v post-edit-menu">
                        <div class="dropdown-content">
                            <a href="posts/edit/{{ $post->id }}">Edit</a>
                            <a class="modal-open-deletePost">Delete</a>
                        </div>
                    </i>
                @endif

            </div>
            @if (isset($post->image))
                <img class="image-post" src=" {{ asset('/storage/' . $post->image) }}">
            @endif
            <div class="footer">
                <div class="post-description">
                    <p>
                        {{ $post->description }}
                    </p>
                </div>
                <div class="post-options">
                    <div class="main-options">
                        <svg aria-label="Unlike" fill="#ed4956" height="24" viewBox="0 0 48 48" width="24">
                            <path
                                d="M34.6 3.1c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5s1.1-.2 1.6-.5c1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z">
                            </path>
                        </svg>
                        <svg class="modal-open-comment" aria-label="Comment" fill="#262626" height="24" viewBox="0 0 48 48"
                            width="24">
                            <path class="modal-open-comment " clip-rule="evenodd"
                                d="M47.5 46.1l-2.8-11c1.8-3.3 2.8-7.1 2.8-11.1C47.5 11 37 .5 24 .5S.5 11 .5 24 11 47.5 24 47.5c4 0 7.8-1 11.1-2.8l11 2.8c.8.2 1.6-.6 1.4-1.4zm-3-22.1c0 4-1 7-2.6 10-.2.4-.3.9-.2 1.4l2.1 8.4-8.3-2.1c-.5-.1-1-.1-1.4.2-1.8 1-5.2 2.6-10 2.6-11.4 0-20.6-9.2-20.6-20.5S12.7 3.5 24 3.5 44.5 12.7 44.5 24z"
                                fill-rule="evenodd"></path>
                        </svg>
                        <svg aria-label="Share Post" fill="#262626" height="24" viewBox="0 0 48 48" width="24">
                            <path
                                d="M47.8 3.8c-.3-.5-.8-.8-1.3-.8h-45C.9 3.1.3 3.5.1 4S0 5.2.4 5.7l15.9 15.6 5.5 22.6c.1.6.6 1 1.2 1.1h.2c.5 0 1-.3 1.3-.7l23.2-39c.4-.4.4-1 .1-1.5zM5.2 6.1h35.5L18 18.7 5.2 6.1zm18.7 33.6l-4.4-18.4L42.4 8.6 23.9 39.7z">
                            </path>
                        </svg>
                    </div>
                    <div class="save">
                        <svg aria-label="Save" fill="#262626" height="24" viewBox="0 0 48 48" width="24">
                            <path
                                d="M43.5 48c-.4 0-.8-.2-1.1-.4L24 29 5.6 47.6c-.4.4-1.1.6-1.6.3-.6-.2-1-.8-1-1.4v-45C3 .7 3.7 0 4.5 0h39c.8 0 1.5.7 1.5 1.5v45c0 .6-.4 1.2-.9 1.4-.2.1-.4.1-.6.1zM24 26c.8 0 1.6.3 2.2.9l15.8 16V3H6v39.9l15.8-16c.6-.6 1.4-.9 2.2-.9z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="liked-by">
                    <span><b>{{ $post->likes }} likes</b></span>
                    </span>
                </div>
                <div class="comments">
                    @foreach (App\Models\Post::find($post->id)->comments as $comment)
                        <div class="comment">
                            <p class="comment-content">
                                <b>{{ App\Models\Comment::find($comment->id)->user->name }}</b>
                                <span>{{ $comment->content }}</span>
                            </p>
                            <svg class="like" aria-label="Like" fill="#262626" height="24" viewBox="0 0 48 48" width="24">
                                <path
                                    d="M34.6 6.1c5.7 0 10.4 5.2 10.4 11.5 0 6.8-5.9 11-11.5 16S25 41.3 24 41.9c-1.1-.7-4.7-4-9.5-8.3-5.7-5-11.5-9.2-11.5-16C3 11.3 7.7 6.1 13.4 6.1c4.2 0 6.5 2 8.1 4.3 1.9 2.6 2.2 3.9 2.5 3.9.3 0 .6-1.3 2.5-3.9 1.6-2.3 3.9-4.3 8.1-4.3m0-3c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5.6 0 1.1-.2 1.6-.5 1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z">
                                </path>
                            </svg>
                        </div>
                    @endforeach
                </div>
                <span class="posted">
                    {{ App\Http\Controllers\postController::timeElapsed($post->created_at) }}
                </span>
            </div>
        </div>
    @endforeach

    <!--Modal create comment-->
    <div id="modal-comment" class="modal  @php if(!$errors->any()){ echo " opacity-0 pointer-events-none";}@endphp fixed
        w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <form method="POST" action="/comments/create" class="modal-content py-4 text-left px-6">
                @csrf
                <textarea name="content" rows="4" cols="40" class="input-comment resize-none border rounded-md "
                    placeholder="Comment.."></textarea>
                @if ($errors->has('content'))
                    <div class="error">
                        {{ $errors->first('content') }}
                    </div>
                @endif
                <input id="post-id" name="post_id" type="text" class="hidden" @if (Session::has('post_id')) value = {{ Session::get('post_id') }} @endif >
                <div class="flex justify-end pt-2justify">
                    <input type="submit" id="comment-send"
                        class="modal-close px-4 bg-transparent p-3 focus:outline-none rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2"
                        value="Post">
                    <button id="comment-close"
                        class="modal-close px-4 bg-transparent p-3 focus:outline-none  rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Close</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal Confirm delete -->

    <div id="modal-delete"
        class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
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
@endsection
