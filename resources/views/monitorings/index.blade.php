@extends ('layouts.app')

@section('title', "دیده بانی سلامت")

@section ('content')
<div class="container">
    <div v-if="isLoading">
        @include('global.loading')
    </div>

    <div v-show="!isLoading">
        <div>
            @include('monitorings.header')
        </div>

        <monitoring-detail v-show="isDetailMode"
            ref="monitoringDetail"
            show-url="{{ route('monitoring.show', '_ID_') }}"
            @on-back-pressed="cancelDetailForm"></monitoring-detail>

        <monitoring-list ref="monitoringList" v-show="isListMode" url="{{ route('api.monitoring.list') }}"
            @on-edit-monitoring="showEditForm"
            @on-show-monitoring="showMonitoring">
        </monitoring-list>

        <monitoring-create ref="monitoringCreate" v-show="isCreateMode || isEditMode"
            store-url="{{ route('monitoring.store') }}"
            update-url="{{ route('monitoring.update', '_ID_') }}"
            show-url="{{ route('monitoring.show', '_ID_') }}"
            indicators-url="{{ route('api.indicator.list') }}"
            provinces-url="{{ route('api.province.list') }}"
            @on-new-monitoring="newMonitoring"
            @on-edit-monitoring="editMonitoring"
            @on-cancel-create="hideCreateForm"></monitoring-create>
    </div>
</div>
@endsection

@section('scripts')
<script defer src="{{ mix('js/pages/monitorings/index/index.js') }}"></script>
@endsection
