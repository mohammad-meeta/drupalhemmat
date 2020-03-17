@extends('layouts.app')
@section ('content')
<div class="container">
    <h1 class="pb-2 border-bottom">
        هماهنگی درون بخشی
    </h1>
</div>

<div class="row justify-content-center m-0">
    <div class="intro-card col-md-3 mb-5 p-3 mx-4
                justify-content-center align-items-center d-flex flex-wrap">
        <div class="intro-card-head">
            <h2>رابطان درون بخشی سلامت استان</h2>
        </div>
        <div class="intro-card-body justify-content-center align-items-center d-flex flex-wrap">
            <a href="{{route('department.show', 1)}}" class="text-center w-100 my-1 p-1 d-block">شورای رابطان</a>
            <a href="{{route('department.show', 2)}}" class="text-center w-100 my-1 p-1 d-block">معاونت ها و واحدهای تابعه</a>
        </div>
    </div>

    <div class="intro-card col-md-3 mb-5 p-3 mx-4
                justify-content-center align-items-center d-flex flex-wrap">
        <div class="intro-card-head">
            <h2>شوراهای تصمیم گیری</h2>
        </div>
        <div class="intro-card-body justify-content-center align-items-center d-flex flex-wrap">
            <a href="{{route('department.show', 3)}}" class="text-center w-100 my-1 p-1 d-block">هیات امنای دانشگاه</a>
            <a href="{{route('department.show', 4)}}" class="text-center w-100 my-1 p-1 d-block">هیات رئیسه دانشگاه</a>
        </div>
    </div>
</div>

<div class="row justify-content-center m-0">
    <div class="intro-card col-md-3 p-3
                justify-content-center align-items-center d-flex flex-wrap">
        <div class="intro-card-head">
            <h2><a href="#">کارنامه هماهنگی درون بخشی</a></h2>
        </div>
    </div>
</div>

@endsection

