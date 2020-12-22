<x-app-layout>


    <section class="main">
        <div class="post">
            <div class="header">
                <div class="wrapper">
                    <div class="post-profile1"></div>
                    <span class="name-profile">
                        {{ auth()->user()->name }}
                    </span>

                </div>
                <div class="post-edit-options">
                    <img id="add-image-post" class="h-5" src="images/new_image.png">
                </div>

            </div>
            {{-- <div class="image1"></div> --}}
            {{-- <img src="/images/new_image.png"> --}}
            <div class="footer">

                <div class="post-description">

                    <form class="edit-post-form">
                        <textarea rows="4" cols="70" name="description"
                            placeholder="What are you thinking about?"></textarea>
                    </form>

                </div>
            </div>
        </div>
</x-app-layout>
