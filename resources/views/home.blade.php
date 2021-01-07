@extends ('layouts.app')

@section('head')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{ mix('js/post.js') }}" defer></script>

@endsection


{{-- @include('postPopulate') --}}

@section('modals')
    <!--Modal create comment-->
     @include('components.modalComment')
    <!-- Modal Confirm delete -->
     @include('components.modalDelete')
    {{-- <div class = "hidden" id="group" data-group="user"></div> --}}

@endsection()
