@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="pb-2 border-bottom">{{ $articleType->title }}</h1>
        <div class="manage-post">
            <a class="mr-2" href=" {{ route('article-type.edit', $articleType->id) }}">
                <i class="fa fa-pencil-square-o"></i>ویرایش
            </a>
        </div>
    </div>
@endsection
