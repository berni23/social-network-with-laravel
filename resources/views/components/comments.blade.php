<div class="comments">

    @php $heightLike = '16'@endphp
    @foreach (App\Models\Post::find($post->id)->comments as $comment)
        @include('components.comment')
    @endforeach
</div>
