@extends ('layouts.app')

@section('title', "لیست شهرها")

@section ('content')
    <div class="container">
        <div v-if="isLoading">
            @include('global.loading')
        </div>

         <div v-show="!isLoading">
            <div>
                @include('cities.header')
            </div>

            <div v-if="isListMode">
                @include('cities.list')
            </div>

            <div v-if="isCreateMode || isEditMode">
                @include('cities.create')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.pageData = {
            url: {
                cityStore: '{{ route('city.store') }}',
                cityUpdate: '{{ route('city.update', '_ID_') }}',
                cityShow: '{{ route('city.show', '_ID_') }}',
                cityList: '{{ route('api.city.list') }}',
            }
        };
    </script>
    <script defer src="{{ mix('js/pages/city/index/index.js') }}"></script>
@endsection
