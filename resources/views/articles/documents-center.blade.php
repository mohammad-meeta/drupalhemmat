@extends ('layouts.app')

@section('title', "مرکز اسناد راهبردی استان")

@section ('content')
<div class="container">
    <h1 class="pb-2 border-bottom">
        مرکز اسناد راهبردی استان
    </h1>
    <div v-if="isLoading">
        @include('global.loading')
    </div>

    <div v-show="!isLoading">
        <article-detail v-show="isDetailMode" ref="articleDetail" show-url="{{ route('article.show', '_ID_') }}"
                        @on-back-pressed="cancelDetailForm"></article-detail>
        <article-documents-center v-show="isListMode" url="{{ route('api.article.documentsCenterList') }}"
        @on-show-article="showArticle">
        </article-documents-center>

    </div>


</div>
@endsection

@section('scripts')
<script defer src="{{ mix('js/pages/articles/documents_center/index.js') }}"></script>
@endsection
