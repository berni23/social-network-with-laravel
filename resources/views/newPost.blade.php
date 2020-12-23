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

        <label class="btn btn-sm btn-danger" id="formUpload" type="submit">
            <input type="file" name="image_path" id="uploadFile" />

        </label>
        <img id="postedImage" src="/images/new_image.png">
        <div class="footer">
            <div class="post-description">
                <form class="edit-post-form" method="POST" action="posts/create">
                    <textarea rows="4" cols="70" name="description" placeholder="What are you thinking about?"></textarea>
                    <button type="submit"
                        class="h-8 px-5  text-blue-100 transition-colors duration-150 bg-blue-400 rounded-lg focus:shadow-outline hover:bg-blue-100">Post</button>
                    <button
                        class="h-8 px-5 text-gray-100 transition-colors duration-150 bg-gray-400 rounded-lg focus:shadow-outline hover:bg-gray-100">Cancel</button>
                </form>
            </div>
        </div>
    </div>

@endsection
