@extends ('layouts.app')

@section('title', "دسته بندی اسناد")

@section ('content')
<div class="container">
    <div v-if="isLoading">
        @include('global.loading')
    </div>

    <div v-show="!isLoading">
        <div>
            @include('document_categories.header')
        </div>

        <div v-if="isListMode">
            @include('document_categories.list')
        </div>

        <div v-if="isCreateMode || isEditMode">
            @include('document_categories.create')
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.pageData = {
            url: {
                documentCategoryStore: '{{ route('document-category.store') }}',
                documentCategoryUpdate: '{{ route('document-category.update', '_ID_') }}',
                documentCategoryShow: '{{ route('document-category.show', '_ID_') }}',
                documentCategoryList: '{{ route('api.document-category.list') }}'
            }
        };
</script>
<script defer src="{{ mix('js/pages/document_categories/index/index.js') }}"></script>
@endsection
