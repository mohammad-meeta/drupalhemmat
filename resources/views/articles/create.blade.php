@extends ('layouts.app')

@section ('content')
    <div class="container">
        <h1 class="pb-2 border-bottom">ایجاد مطلب</h1>
        <form method="POST" action="/article">
            @csrf

            <div class="form-group">
                <label for="my-input">عنوان</label>
                <input id="title" class="form-control" type="text" name="title" required>
            </div>

            <div class="form-group">
                <label for="articleType">نوع مطلب</label>
                <select id="type" class="form-control" name="type" required>
                    @foreach ($articleTypes as $id => $type)
                        <option value="{{ $id }}">{{ $type }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="body">توضیحات</label>
                <textarea id="body" class="form-control" name="body" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">ذخیره</button>
        </form>
    </div>
@endsection
