@extends ('layouts.app')

@section ('content')
    <div class="container">
        <h1 class="pb-2 border-bottom">ایجاد دستگاه اجرایی</h1>
        <form method="POST" action="/organ">
            @csrf

            <div class="form-group">
                <label for="my-input">عنوان</label>
                <input id="title" class="form-control" type="text" name="title" required>
            </div>

            <div class="form-group">
                <label for="city">شهر</label>
                <select id="city" class="form-control" name="city" required>
                    @foreach ($cities as $id => $city)
                        <option value="{{ $id }}">{{ $city }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">ذخیره</button>
        </form>
    </div>
@endsection
