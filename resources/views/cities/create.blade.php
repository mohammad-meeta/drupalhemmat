@extends ('layouts.app')

@section ('content')
    <div class="container">
        <h1 class="pb-2 border-bottom">ایجاد شهر</h1>
        <form method="POST" action="/city">
            @csrf
            <div class="form-group">
                <label for="my-input">عنوان</label>
                <input id="title" class="form-control" type="text" name="title">
            </div>
            <button type="submit" class="btn btn-primary">ذخیره</button>
        </form>
    </div>
@endsection
