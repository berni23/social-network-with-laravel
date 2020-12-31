@extends ('layouts.app')
@section('main')

    {{-- @php echo json_encode($posts); @endphp --}}
    @foreach ($posts as $post)
        <div class="post">
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
                        <svg aria-label="Comment" fill="#262626" height="24" viewBox="0 0 48 48" width="24">
                            <path clip-rule="evenodd"
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
    <div class="post">
        <div class="header">
            <div class="wrapper">
                <div class="post-profile1"></div>
                <span class="name-profile">
                    Astronomy picture
                </span>
            </div>
        </div>
        <img class="image-post" src="/images/Ngc346_HubbleSchmidt_960.jpg">
        <div class="footer">
            <div class="post-options">
                <div class="main-options">

                    <svg aria-label="Unlike" fill="#ed4956" height="24" viewBox="0 0 48 48" width="24">
                        <path
                            d="M34.6 3.1c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5s1.1-.2 1.6-.5c1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z">
                        </path>
                    </svg>
                    <svg aria-label="Comment" fill="#262626" height="24" viewBox="0 0 48 48" width="24">
                        <path clip-rule="evenodd"
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
                    <svg aria-label="Save" class="_8-yf5 " fill="#262626" height="24" viewBox="0 0 48 48" width="24">
                        <path
                            d="M43.5 48c-.4 0-.8-.2-1.1-.4L24 29 5.6 47.6c-.4.4-1.1.6-1.6.3-.6-.2-1-.8-1-1.4v-45C3 .7 3.7 0 4.5 0h39c.8 0 1.5.7 1.5 1.5v45c0 .6-.4 1.2-.9 1.4-.2.1-.4.1-.6.1zM24 26c.8 0 1.6.3 2.2.9l15.8 16V3H6v39.9l15.8-16c.6-.6 1.4-.9 2.2-.9z">
                        </path>
                    </svg>
                </div>
            </div>
            <div class="liked-by">
                <img class="profile-pic" src="assets/images/bernat.jpg">
                <!-- <span class="iconify" data-icon="gg:profile" data-inline="false"></span> -->
                <span> Liked by <b>brny23</b> and <b>100,000 others</b></span></span>
            </div>
            <div class="post-description">
                <p> <b>Astronomy picture</b>
                    NGC 346: Star Forming Cluster in the SMC
                    <br>
                    Image Credit & License: NASA, ESA, Hubble; Processing: Judy Schmidt
                    <br>
                    <br>
                    <a class="notranslate" href="https://www.nasa.gov/" tabindex=" 0">@nasa</a>
                    <a class="notranslate" href="https://www.esa.int/" tabindex="0">@europeanspaceagency</a>
                    <a class="notranslate" href="https://www.nasa.gov/mission_pages/hubble/main/index.html"
                        tabindex="0">@nasahubble</a>
                    <br>
                    <br>
                    Are stars still forming in the Milky Way' s satellite galaxies? Found among the Small Magellanic
                    Cloud's (SMC's) clusters and nebulas, NGC 346 is a star forming region about 200 light-years across,
                    pictured here in the center of a Hubble Space Telescope image. A satellite galaxy of the Milky Way, the
                    Small Magellanic Cloud (SMC) is a wonder of the southern sky, a mere 210,000 light-years distant in the
                    constellation of the Toucan (Tucana). Exploring NGC 346, astronomers have identified a population of
                    embryonic stars strung along the dark, intersecting dust lanes visible here on the right. Still
                    collapsing within their natal clouds, the stellar infants' light is reddened by the intervening dust.
                    Toward the top of the frame is another star cluster with intrinsically older and redder stars. A small,
                    irregular galaxy, the SMC itself represents a type of galaxy more common in the early Universe. These
                    small galaxies, though, are thought to be building blocks for the larger galaxies present today. <br>
                    <br>
                    <a href="#">#apod</a>
                    <a href="#">#nasa</a>
                    <a href="#">#space</a>
                    <a href="#">#esa </a>
                    <a href="#">#science</a>
                    <a href="#">#hubbletelescope</a>
                    <a href="#">#astronomy</a>
                    <a href="#">#galaxy </a>
                    <a href="#">#hubble</a>
                </p>
            </div>
            <div class="comments">
                <div class="comment">
                    <p class="comment-content">
                        <b>brny23</b> Awesome!!
                    </p>
                    <svg class="like" aria-label="Like" class="_8-yf5 " fill="#262626" height="24" viewBox="0 0 48 48"
                        width="24">
                        <path
                            d="M34.6 6.1c5.7 0 10.4 5.2 10.4 11.5 0 6.8-5.9 11-11.5 16S25 41.3 24 41.9c-1.1-.7-4.7-4-9.5-8.3-5.7-5-11.5-9.2-11.5-16C3 11.3 7.7 6.1 13.4 6.1c4.2 0 6.5 2 8.1 4.3 1.9 2.6 2.2 3.9 2.5 3.9.3 0 .6-1.3 2.5-3.9 1.6-2.3 3.9-4.3 8.1-4.3m0-3c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5.6 0 1.1-.2 1.6-.5 1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z">
                        </path>
                    </svg>
                </div>
                <div class="comment">
                    <p class="comment-content">
                        <b>Alex</b> 210,000 light years ? Mind blowing!
                        <span class="iconify" data-icon="twemoji:exploding-head" data-inline="false"></span>
                        <span class="iconify" data-icon="twemoji:exploding-head" data-inline="false"></span>
                    </p>
                    <svg class="like" aria-label="Like" class="_8-yf5 " fill="#262626" height="24" viewBox="0 0 48 48"
                        width="24">
                        <path
                            d="M34.6 6.1c5.7 0 10.4 5.2 10.4 11.5 0 6.8-5.9 11-11.5 16S25 41.3 24 41.9c-1.1-.7-4.7-4-9.5-8.3-5.7-5-11.5-9.2-11.5-16C3 11.3 7.7 6.1 13.4 6.1c4.2 0 6.5 2 8.1 4.3 1.9 2.6 2.2 3.9 2.5 3.9.3 0 .6-1.3 2.5-3.9 1.6-2.3 3.9-4.3 8.1-4.3m0-3c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5.6 0 1.1-.2 1.6-.5 1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z">
                        </path>
                    </svg>
                </div>
            </div>
            <span class="posted">
                4 DAYS AGO
            </span>
        </div>
    </div>
    <div class="post">
        <div class="header">
            <div class="wrapper">
                <div class="post-profile2"></div>
                <span class="name-profile">
                    SpaceX
                </span>
            </div>
        </div>
        {{-- <div class="image2"></div> --}}

        <img src="/images/spacex_astronauts.jpg">

        <div class="footer">
            <div class="post-options">
                <div class="main-options">
                    <svg aria-label="Like" fill="#262626" height="24" viewBox="0 0 48 48" width="24">
                        <path
                            d="M34.6 6.1c5.7 0 10.4 5.2 10.4 11.5 0 6.8-5.9 11-11.5 16S25 41.3 24 41.9c-1.1-.7-4.7-4-9.5-8.3-5.7-5-11.5-9.2-11.5-16C3 11.3 7.7 6.1 13.4 6.1c4.2 0 6.5 2 8.1 4.3 1.9 2.6 2.2 3.9 2.5 3.9.3 0 .6-1.3 2.5-3.9 1.6-2.3 3.9-4.3 8.1-4.3m0-3c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5.6 0 1.1-.2 1.6-.5 1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z">
                        </path>
                    </svg>
                    <svg aria-label="Comment" fill="#262626" height="24" viewBox="0 0 48 48" width="24">
                        <path clip-rule="evenodd"
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
                <span> 300,102 likes</span>
            </div>

            <div class="post-description">
                <p> <b>spaceX</b>
                    Ready to launch !!!
                    <br>
                    <br>
                    <a href="#">#spaceX</a>
                    <a href="#">#nasa</a>
                    <a href="#">#space</a>
                    <a href="#">#esa </a>
                </p>
            </div>
            <div class="comments">

            </div>
            <span class="posted">
                16 DAYS AGO
            </span>
        </div>
    </div>


    <button
        class="modal-open bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full">Open
        Modal</button>

    <!--Modal-->
    <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div
                class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                    viewBox="0 0 18 18">
                    <path
                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                    </path>
                </svg>
                <span class="text-sm">(Esc)</span>
            </div>

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="modal-content py-4 text-left px-6">

                <!--Body-->
                <textarea rows="4" cols="40" class="input-comment resize-none border rounded-md "
                    placeholder="Comment.."></textarea>

                <!--Footer-->
                <div class="flex justify-end pt-2">
                    <button
                        class="px-4 bg-transparent p-3 focus:outline-none rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Post</button>
                    <button
                        class="px-4 bg-transparent p-3 focus:outline-none  rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Close</button>
                </div>

            </div>
        </div>
    </div>

    <script>
        var openmodal = document.querySelectorAll('.modal-open')
        for (var i = 0; i < openmodal.length; i++) {
            openmodal[i].addEventListener('click', function(event) {
                event.preventDefault()
                toggleModal()
            })
        }

        const overlay = document.querySelector('.modal-overlay')
        overlay.addEventListener('click', toggleModal)

        var closemodal = document.querySelectorAll('.modal-close')
        for (var i = 0; i < closemodal.length; i++) {
            closemodal[i].addEventListener('click', toggleModal)
        }

        document.onkeydown = function(evt) {
            evt = evt || window.event
            var isEscape = false
            if ("key" in evt) {
                isEscape = (evt.key === "Escape" || evt.key === "Esc")
            } else {
                isEscape = (evt.keyCode === 27)
            }
            if (isEscape && document.body.classList.contains('modal-active')) {
                toggleModal()
            }
        };


        function toggleModal() {
            const body = document.querySelector('body')
            const modal = document.querySelector('.modal')
            modal.classList.toggle('opacity-0')
            modal.classList.toggle('pointer-events-none')
            body.classList.toggle('modal-active')
        }

    </script>



@endsection
