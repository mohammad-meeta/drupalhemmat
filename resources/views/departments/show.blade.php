@extends('layouts.app')

@section('content')
<div class="container">
    <department-detail show-url="{{ route('department.detail', '_ID_') }}"
        ref="departmentDetail" :show-back-button="false" department-id="{{ $id }}"
        data-dep-id="{{ $id }}"
        articles-url="{{ route('api.article.filter', '_ID_') }}">
    </department-detail>
</div>
@endsection

@section('scripts')
<script defer src="{{ mix('js/pages/departments/show/index.js') }}"></script>
@endsection
