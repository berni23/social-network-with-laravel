<div class="comment" data-comment=' {{ $comment->id }}'>
    <p class="comment-content">
        <b>{{ App\Models\Comment::find($comment->id)->user->name }}</b>
        <span> @php echo html_entity_decode(arrayTools::addMentions($comment->content)); @endphp
        </span>
    </p>
    <div class="likeComment">
        @php
        $query = App\Models\Like::queryLike($comment->id,'App\\Models\\Comment');
        $heightLike = '16';
        @endphp
        @if (isset($query) && $query->like)

            @include('components/unlike')
        @else @include('components/like')
        @endif
    </div>
</div>
