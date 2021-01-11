@extends ('layouts/app')
@section('main')

    <div class="container my-12 mx-auto px-4 md:px-12">
        <div class="friends-wrapper flex flex-wrap -mx-1 lg:-mx-4">


            @php $array=[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1];
            @endphp
            @foreach ($array as $friend)
                {{-- @php
                $name= $friend->name;
                $photo = $friend->profile_photo_path;
                @endphp --}}
                @include('components.friendCard')

            @endforeach
        </div>
    </div>

@endsection
