@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="pb-2 border-bottom">ویرایش دستگاه اجرایی {{ $organ->title }}</h1>
        <form method="POST" action="{{ route('organ.update', $organ->id) }}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="my-input">عنوان</label>
                <input
                    id="title"
                    class="form-control"
                    type="text"
                    name="title"
                    value="{{ $organ->title }}">
            </div>

            <div class="form-group">
                <label for="city">شهر</label>
                <select id="city" class="form-control" name="city" required>
                    @foreach ($cities as $id => $city)
                        <option value="{{ $id }}">{{ $city }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">ویرایش</button>
        </form>
    </div>
@endsection
