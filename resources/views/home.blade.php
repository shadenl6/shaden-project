@extends('layouts.app')

@section('content')
    <h1>Latest Posts</h1>

    @foreach($posts as $post)
        <div class="post-card">
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->excerpt }}</p>

            <h3>Comments</h3>
            @foreach($post->comments as $comment)
                <div class="comment">
                    {{ $comment->content }} - {{ $comment->user->name }}
                </div>
            @endforeach

            <form method="POST" action="{{ route('posts.comments.store', $post) }}">
                @csrf
                <textarea name="content" placeholder="Leave a comment"></textarea>
                <button type="submit">Comment</button>
            </form>
        </div>

        @if ($posts->hasMorePages())
            <a href="{{ $posts->nextPageUrl() }}">Load More Posts</a>
        @endif
    @endforeach
@endsection
