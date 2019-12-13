@extends ('layouts.app')

@section('title', "مطالب")

@section ('content')
    <div class="container">
        <div v-if="isLoading">
            @include('global.loading')
        </div>

        <div v-show="!isLoading">
            <div>
                @include('articles.header')
            </div>

            {{-- <article-list v-if="isListMode"></article-list> --}}
            <div v-if="isListMode">
                @include('articles.list')
            </div>

            <div v-if="isCreateMode || isEditMode">
                @include('articles.create')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.pageData = {
            url: {
                articleStore: '{{ route('article.store') }}',
                articleUpdate: '{{ route('article.update', '_ID_') }}',
                articleShow: '{{ route('article.show', '_ID_') }}',
                articleList: '{{ route('api.article.list') }}',
                articleTypeList: '{{ route('api.article-type.list') }}'
            }
        };
    </script>
    <script defer src="{{ mix('js/pages/articles/index/index.js') }}"></script>
@endsection
