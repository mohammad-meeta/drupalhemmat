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

            <article-detail v-show="isDetailMode"
                ref="articleDetail"
                show-url="{{ route('article.show', '_ID_') }}"
                @on-back-pressed="cancelDetailForm"></article-detail>

            <article-list ref="articleList" v-show="isListMode" url="{{ route('api.article.list') }}"
                @on-edit-article="showEditForm"
                @on-show-article="showArticle">
            </article-list>

            <article-create ref="articleCreate" v-show="isCreateMode || isEditMode"
                upload-url="{{ route('article.file-upload', '_ID_') }}"
                store-url="{{ route('article.store') }}"
                update-url="{{ route('article.update', '_ID_') }}"
                show-url="{{ route('article.show', '_ID_') }}"
                article-types-url="{{ route('api.article-type.list') }}"
                document-categories-url="{{ route('api.document-category.list') }}"
                departments-url="{{ route('api.department.list') }}"
                @on-new-article="newArticle"
                @on-edit-article="editArticle"
                @on-cancel-create="hideCreateForm"
                ></article-create>
        </div>
    </div>
@endsection

@section('scripts')
<script defer src="{{ mix('js/ckeditor/ckeditor.js') }}"></script>
<script defer src="{{ mix('js/pages/articles/index/index.js') }}"></script>
@endsection
