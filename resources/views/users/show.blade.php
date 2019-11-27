@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="pb-2 border-bottom">{{ $user->name }}</h1>
        <div class="manage-post">
            <a class="mr-2" href=" {{ route('user.edit', $user->id) }}">
                <i class="fa fa-pencil-square-o"></i>
            </a>
        </div>
    </div>
@endsection
