@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="pb-2 border-bottom">ویرایش نوع مطلب {{ $role->title }}</h1>
        <form method="POST" action="{{ route('role.update', $role->id) }}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="my-input">عنوان</label>
                <input
                    id="title"
                    class="form-control"
                    type="text"
                    name="title"
                    value="{{ $role->title }}">
            </div>
            <button type="submit" class="btn btn-primary">ویرایش</button>
        </form>

    </div>
@endsection
