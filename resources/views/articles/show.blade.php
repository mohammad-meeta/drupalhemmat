@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="pb-2 border-bottom">{{ $article->title }}</h1>
        <div class="manage-post">
            <a class="mr-2" href=" {{ route('article.edit', $article->id) }}">
                <i class="fa fa-pencil-square-o"></i>
            </a>
        </div>
        <div class="content-body">
            {!! $article->body !!}
        </div>
    </div>
@endsection
