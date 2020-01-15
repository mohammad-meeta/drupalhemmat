@extends ('layouts.app')

@section('title', "شاخص ها")

@section ('content')
<div class="container">
    <div v-if="isLoading">
        @include('global.loading')
    </div>

    <div v-show="!isLoading">
        <div>
            @include('indicators.header')
        </div>

        <indicator-detail v-show="isDetailMode"
            ref="indicatorDetail"
            show-url="{{ route('indicator.show', '_ID_') }}"
            @on-back-pressed="cancelDetailForm"></indicator-detail>

        <indicator-list ref="indicatorList" v-show="isListMode" url="{{ route('api.indicator.list') }}"
            @on-edit-indicator="showEditForm"
            @on-show-indicator="showIndicator">
        </indicator-list>

        <indicator-create ref="indicatorCreate" v-show="isCreateMode || isEditMode"
            store-url="{{ route('indicator.store') }}"
            update-url="{{ route('indicator.update', '_ID_') }}"
            show-url="{{ route('indicator.show', '_ID_') }}"
            indicator-categories-url="{{ route('api.indicator-category.list') }}"
            @on-new-indicator="newIndicator"
            @on-edit-indicator="editIndicator"
            @on-cancel-create="hideCreateForm"></indicator-create>
    </div>
</div>
@endsection

@section('scripts')
<script defer src="{{ mix('js/pages/indicators/index/index.js') }}"></script>
@endsection
