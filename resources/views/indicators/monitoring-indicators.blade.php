@extends ('layouts.app')

@section('title', "شاخص های دیده بانی سلامت")

@section ('content')
<div class="container">
    <h1 class="pb-2 border-bottom">
        شاخص های دیده بانی سلامت
    </h1>
    <div v-if="isLoading">
        @include('global.loading')
    </div>

    <div v-show="!isLoading">
        <indicator-detail v-show="isDetailMode" ref="indicatorDetail" show-url="{{ route('indicator.show', '_ID_') }}"
                    @on-back-pressed="cancelDetailForm">
        </indicator-detail>
        <indicator-monitoring-indicators v-show="isListMode" url="{{ route('api.indicator.monitoringList') }}"
                    @on-show-indicator="showIndicator">
        </indicator-monitoring-indicators>

    </div>


</div>
@endsection

@section('scripts')
<script defer src="{{ mix('/js/pages/indicators/monitoring_indicators/index.js') }}"></script>
@endsection
