@extends ('layouts.app')

@section('title', "سازمان ها")

@section ('content')
    <div class="container">
        <div v-if="isLoading">
            @include('global.loading')
        </div>

        <div v-show="!isLoading">
            <div>
                @include('organs.header')
            </div>

            <div v-if="isListMode">
                @include('organs.list')
            </div>

            <div v-if="isCreateMode">
                @include('organs.create')
            </div>

            <div v-if="isCreateMode || isEditMode">
                @include('organs.create')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.pageData = {
            url: {
                organStore: '{{ route('organ.store') }}',
                organUpdate: '{{ route('organ.update', '_ID_') }}',
                organShow: '{{ route('organ.show', '_ID_') }}',
                organList: '{{ route('api.organ.list') }}',
                cityList: '{{ route('api.city.list') }}'
            }
        };
    </script>
    <script defer src="{{ mix('js/pages/organ/index/index.js') }}"></script>
@endsection
