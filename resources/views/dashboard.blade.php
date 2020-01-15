@extends('layouts.app')
@section ('content')
<div class="row">
    <div class="col-md-2 mb-3">
        <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="add-content-tab" data-toggle="tab" href="#add-content" role="tab" aria-controls="add-content"
                    aria-selected="true">افزودن محتوا</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="content-management-tab" data-toggle="tab" href="#content-management" role="tab"
                    aria-controls="content-management" aria-selected="false">مدیریت محتوا</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="report-tab" data-toggle="tab" href="#report" role="tab"
                    aria-controls="report" aria-selected="false">گزارشات</a>
            </li>
        </ul>
    </div>
    <!-- /.col-md-4 -->
    <div class="col-md-10">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="add-content" role="tabpanel" aria-labelledby="add-content-tab">
                <h2>افزودن محتوا</h2>
                <a class="btn btn-lg btn-primary p-3 m-2 w-25" href="{{route('article.index')}}">مطالب</a>
                <a class="btn btn-lg btn-primary p-3 m-2 w-25" href="{{route('organ.index')}}">دستگاه اجرایی</a>
                <a class="btn btn-lg btn-primary p-3 m-2 w-25" href="{{route('article-type.index')}}">نوع مطلب</a>
                <a class="btn btn-lg btn-primary p-3 m-2 w-25" href="{{route('city.index')}}">شهر</a>
            </div>
            <div class="tab-pane fade" id="content-management" role="tabpanel" aria-labelledby="content-management-tab">
                <h2>Profile</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, eveniet earum. Sed accusantium
                    eligendi molestiae quo hic velit nobis et, tempora placeat ratione rem blanditiis voluptates vel
                    ipsam? Facilis, earum!</p>
            </div>
            <div class="tab-pane fade" id="report" role="tabpanel" aria-labelledby="report-tab">
                <h2>Contact</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, eveniet earum. Sed accusantium
                    eligendi molestiae quo hic velit nobis et, tempora placeat ratione rem blanditiis voluptates vel
                    ipsam? Facilis, earum!</p>

            </div>
        </div>
    </div>
    <!-- /.col-md-8 -->
</div>
@endsection

@section('scripts')
<script defer src="{{ mix('js/pages/dashboard/index.js') }}"></script>
@endsection
