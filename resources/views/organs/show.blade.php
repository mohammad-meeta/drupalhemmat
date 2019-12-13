@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="pb-2 border-bottom">{{ $organ->title }}</h1>
        <div class="manage-post">

        </div>
        <div class="row">
            {{ $organ->city->title }}
        </div>
    </div>
@endsection
