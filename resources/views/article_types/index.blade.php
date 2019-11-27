@extends ('layouts.app')

@section ('content')
    <div class="container">
        <h1 class="pb-2 border-bottom">انواع مطالب</h1>
        @foreach($articleTypes as $articleType)
            <div class="row">
                <a href=" {{ route('article-type.show', $articleType->id) }}">
                    {{ $articleType->title }}
                </a>
                <a class="mr-2" href=" {{ route('article-type.edit', $articleType->id) }}">
                    ویرایش
                </a>
            </div>
        @endforeach
    </div>

@endsection
