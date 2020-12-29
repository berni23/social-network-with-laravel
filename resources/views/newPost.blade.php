@extends ('layouts/app')
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
        <img id="visible-img-id">
        @if ($errors->has('image'))
            <div class="error">
                {{ $errors->first('image') }}
            </div>

        @endif
        <div class="footer">
            <p id="img-error-js" class="error">
            </p>
            <div class="post-description">
                <form class="edit-post-form" method="POST" action="/posts/create" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="uploadFile" name="image" onchange="readURL(this)" />
                    <textarea rows="4" cols="70" name="description" placeholder="What are you thinking about?"></textarea>
                    @if ($errors->has('description'))
                        <div class="error">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
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
            var imgError = document.getElementById('img-error-js');
            imgError.innerHTML = "";
            if (input.files && input.files[0]) {
                var size = input.files[0].size;
                console.log('image size:', size);
                if (size > 500000) {
                    imgError.innerHTML = 'Image size is ' + size / 1000 + ' KB, the maximum size is 500KB <br>';

                } else {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById("visible-img-id").src = e.target.result;
                        //document.getElementById("image-path").value = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        }

    </script>
@endsection
