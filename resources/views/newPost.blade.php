@extends ('layouts/app')
@section('head')
@endsection
@section('main')
    <div class="post">
        <div class="header">
            <div class="wrapper">
                <div class="post-profile"></div>
                <span class="name-profile">
                    {{ auth()->user()->name }}
                </span>
            </div>
            <div class="post-edit-options">
                <img id="add-image-post" class="h-5" src="/images/new_image.png">
            </div>
        </div>
        <label class="btn btn-sm btn-danger" id="formUpload">
            <input type="file" id="uploadFile" onchange="readURL(this)" />
        </label>
        <img id="visible-img-id">
        <div class="footer">
            <div class="post-description">
                <form class="edit-post-form" method="POST" action="/posts/create">
                    @csrf
                    <input type="text" class="hidden" id="image_path" name="image">
                    <textarea rows="4" cols="70" name="description" placeholder="What are you thinking about?"></textarea>
                    <button type="submit"
                        class="h-8 px-5  text-blue-100 transition-colors duration-150 bg-blue-400 rounded-lg focus:shadow-outline hover:bg-blue-100">Post</button>
                    <button
                        class="h-8 px-5 text-gray-100 transition-colors duration-150 bg-gray-400 rounded-lg focus:shadow-outline hover:bg-gray-100">Cancel</button>
                </form>
            </div>
        </div>
    </div>
    <script defer>
        // input = e.currentTarget
        document.getElementById("add-image-post").addEventListener('click', () => document.getElementById("uploadFile")
            .click());

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById("visible-img-id").src = e.target.result;
                    document.getElementById("image-path").src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
@endsection
