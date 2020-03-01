@extends ('layouts.app')

@section('title', "قسمت ها")

@section ('content')
<div class="container">
    <div v-if="isLoading">
        @include('global.loading')
    </div>

    <div v-show="!isLoading">
        <div>
            @include('departments.header')
        </div>

        <department-detail v-show="isDetailMode"
            ref="departmentDetail"
            show-url="{{ route('department.show', '_ID_') }}"
            @on-back-pressed="cancelDetailForm"></department-detail>

        <department-list ref="departmentList" v-show="isListMode" url="{{ route('api.department.list') }}"
            @on-edit-department="showEditForm"
            @on-show-department="showDepartment">
        </department-list>

        <department-create ref="departmentCreate" v-show="isCreateMode || isEditMode"
            store-url="{{ route('department.store') }}"
            update-url="{{ route('department.update', '_ID_') }}" show-url="{{ route('department.show', '_ID_') }}"
            @on-new-department="newDepartment"
            @on-edit-department="editDepartment" @on-cancel-create="hideCreateForm"></department-create>
    </div>
</div>
@endsection

@section('scripts')
<script defer src="{{ mix('js/pages/departments/index/index.js') }}"></script>
@endsection
