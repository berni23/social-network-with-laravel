@extends ('layouts.app')

@section('head')
    <script src="{{ mix('js/post.js') }}" defer></script>
@endsection


@section('modals')
    <!--Modal create comment-->
    @include('components.modalComment')
    <!-- Modal Confirm delete -->
    @include('components.modalDelete')

    <div class="hidden" id="group" data-group='all' @if (Session::has('content'))
        data-content = {{ Session::get('content') }}@endif >
    </div>

@endsection()
