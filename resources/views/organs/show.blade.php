@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="pb-2 border-bottom">{{ $organ->title }}</h1>
        <div class="manage-post">
            <a class="mr-2" href=" {{ route('organ.edit', $organ->id) }}">
                <i class="fa fa-pencil-square-o"></i>ویرایش
            </a>
        </div>
        <div class="row">
            {{ $organ->city->title }}
        </div>
    </div>
@endsection
