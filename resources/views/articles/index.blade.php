@extends ('layouts.app')

@section ('content')
    <div class="container">
        <h1 class="pb-2 border-bottom">مطالب</h1>
        @foreach($articles as $article)
            <div class="row">
                <a href=" {{ route('article.show', $article->id) }}">
                    {{ $article->title }}
                </a>
            </div>
            <div class="row">
                {!! $article->body !!}
            </div>
        @endforeach
    </div>

@endsection
