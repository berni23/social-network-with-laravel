@extends ('layouts/app')
@section('main')

    <div class="container my-12 mx-auto px-4 md:px-12">
        <div class="flex flex-wrap -mx-1 lg:-mx-4">
            <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                @php $array=[1,1,1,1,1,1,1,1,1];
                @endphp
                @foreach ($array as $a)
                    @include('components.friendCard')
            </div>
        </div>
    </div>
