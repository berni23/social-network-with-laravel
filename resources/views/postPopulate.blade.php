@if (isset($noPosts))


    <h2 class="noPosts-message">{{ $noPosts }}</h2>
    <div class="mx-auto my-auto content-center">
        <br>
        <img class="w-50 noPosts" src='/images/no_results.svg'>
        <br>
        <br>
    </div>
@else

    @foreach ($posts as $post)

        @php $heightLike = '24'@endphp

        <div class="post" data-post='{{ $post->id }}'>
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
                @if (auth()->user()->id == $post->user_id)
                    <i class="dropdown fa fa-ellipsis-v post-edit-menu">
                        <div class="dropdown-content">
                            <a href="posts/edit/{{ $post->id }}">Edit</a>
                            <a class="modal-open deletePost" data-modal='modalDelete'>Delete</a>
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
                        @php echo html_entity_decode($post->description);
                        @endphp
                    </p>
                </div>
                <div class="post-options">
                    <div class="main-options">
                        <div class="likePost">
                            @php
                            $query = App\Models\Like::queryLike($post->id,'App\\Models\\Post');
                            @endphp
                            @if (isset($query) && $query->like)
                                @include('components/unlike')
                            @else @include('components/like')
                            @endif
                        </div>
                        <svg class="modal-open openComment" data-modal='modalComment' aria-label="Comment"
                            fill="#262626" height="24" viewBox="0 0 48 48" width="24">
                            <path class="modal-open openComment" clip-rule="evenodd" data-modal='modalComment'
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
                    <span><b>{{ $post->likes }}</b> likes</span>
                    </span>
                </div>
                <div class="comments">

                    @php $heightLike = '16'@endphp
                    @foreach (App\Models\Post::find($post->id)->comments as $comment)
                        <div class="comment" data-comment=' {{ $comment->id }}'>
                            <p class="comment-content">
                                <b>{{ App\Models\Comment::find($comment->id)->user->name }}</b>
                                <span> @php echo html_entity_decode(arrayTools::addMentions($comment->content)); @endphp
                                </span>
                            </p>
                            <div class="likeComment">
                                @php
                                $query = App\Models\Like::queryLike($comment->id,'App\\Models\\Comment');
                                $heightLike = '16';
                                @endphp
                                @if (isset($query) && $query->like)

                                    @include('components/unlike')
                                @else @include('components/like')
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <span class="posted">
                    {{ App\Http\Controllers\postController::timeElapsed($post->created_at) }}
                </span>
            </div>
        </div>
    @endforeach
@endif
