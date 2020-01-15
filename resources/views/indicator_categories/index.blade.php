@extends ('layouts.app')

@section('title', "دسته بندی شاخص ها")

@section ('content')
<div class="container">
    <div v-if="isLoading">
        @include('global.loading')
    </div>

    <div v-show="!isLoading">
        <div>
            @include('indicator_categories.header')
        </div>

        <indicator-category-detail v-show="isDetailMode"
            ref="indicatorCategoryDetail"
            show-url="{{ route('indicator-category.show', '_ID_') }}"
            @on-back-pressed="cancelDetailForm"></indicator-category-detail>

        <indicator-category-list ref="indicatorCategoryList" v-show="isListMode" url="{{ route('api.indicator-category.list') }}"
            @on-edit-indicator-category="showEditForm"
            @on-show-indicator-category="showIndicatorCategory">
        </indicator-category-list>

        <indicator-category-create ref="indicatorCategoryCreate" v-show="isCreateMode || isEditMode"
            store-url="{{ route('indicator-category.store') }}"
            update-url="{{ route('indicator-category.update', '_ID_') }}" show-url="{{ route('indicator-category.show', '_ID_') }}"
            @on-new-indicator-category="newIndicatorCategory"
            @on-edit-indicator-category="editIndicatorCategory" @on-cancel-create="hideCreateForm"></indicator-category-create>
    </div>
</div>
@endsection

@section('scripts')
<script defer src="{{ mix('js/pages/indicator_categories/index/index.js') }}"></script>
@endsection
