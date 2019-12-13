@extends ('layouts.app')

@section('title', "انواع مطالب")

@section ('content')
    <div class="container">
        <div v-if="isLoading">
            @include('global.loading')
        </div>

        <div v-show="!isLoading">
            <div>
                @include('article_types.header')
            </div>

            <div v-if="isListMode">
                @include('article_types.list')
            </div>

            <div v-if="isCreateMode || isEditMode">
                @include('article_types.create')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.pageData = {
            url: {
                articleTypeStore: '{{ route('article-type.store') }}',
                articleTypeUpdate: '{{ route('article-type.update', '_ID_') }}',
                articleTypeShow: '{{ route('article-type.show', '_ID_') }}',
                articleTypeList: '{{ route('api.article-type.list') }}'
            }
        };
    </script>
    <script defer src="{{ mix('js/pages/article_types/index/index.js') }}"></script>
@endsection
