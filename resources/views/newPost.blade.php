@extends ('layouts/app')
@section('head')
    <script src="{{ mix('js/newPost.js') }}" defer></script>
@endsection
@section('main')
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
        <label class="btn btn-sm btn-danger" id="formUpload">
            <input type="file" id="uploadFile" onchange="readURL(this)" />
        </label>
        <img id="visible-img-id">
        <div class="footer">
            <div class="post-description">
                <form class="edit-post-form" method="POST" action="posts/create">
                    <input type="text" class="hidden" id="image_path" name="image">
                    <textarea rows="4" cols="70" name="description" placeholder="What are you thinking about?"></textarea>
                    <button type="submit"
                        class="h-8 px-5  text-blue-100 transition-colors duration-150 bg-blue-400 rounded-lg focus:shadow-outline hover:bg-blue-100">Post</button>
                    <a href='/homr'
                        class="h-8 px-5 text-gray-100 transition-colors duration-150 bg-gray-400 rounded-lg focus:shadow-outline hover:bg-gray-100">Cancel</button>
                </form>
            </div>
        </div>
    </div>
    <script defer>
        let imgSlider = document.getElementById("visible-img-id");
        // input = e.currentTarget
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    imgSlider.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
@endsection
