@extends ('layouts.app')

@section('title', "استان ها")

@section ('content')
<div class="container">
    <div v-if="isLoading">
        @include('global.loading')
    </div>

    <div v-show="!isLoading">
        <div>
            @include('provinces.header')
        </div>

        <province-detail v-show="isDetailMode"
            ref="provinceDetail"
            show-url="{{ route('province.show', '_ID_') }}"
            @on-back-pressed="cancelDetailForm"></province-detail>

        <province-list ref="provinceList" v-show="isListMode" url="{{ route('api.province.list') }}"
            @on-edit-province="showEditForm"
            @on-show-province="showProvince">
        </province-list>

        <province-create ref="provinceCreate" v-show="isCreateMode || isEditMode"
            store-url="{{ route('province.store') }}"
            update-url="{{ route('province.update', '_ID_') }}" show-url="{{ route('province.show', '_ID_') }}"
            @on-new-province="newProvince"
            @on-edit-province="editProvince" @on-cancel-create="hideCreateForm"></province-create>
    </div>
</div>
@endsection

@section('scripts')
<script defer src="{{ mix('js/pages/provinces/index/index.js') }}"></script>
@endsection
