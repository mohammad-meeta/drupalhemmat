@extends ('layouts.app')

@section ('content')
    <div class="container">
        <h1 class="pb-2 border-bottom">ایجاد کاربر</h1>
        <form method="POST" action="/article">
            @csrf

            <div class="form-group">
                <label for="name">نام کاربری</label>
                <input id="name" class="form-control" type="text" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">پست الکترونیک</label>
                <input id="email" class="form-control" type="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">گذرواژه</label>
                <input id="password" class="form-control" type="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="articleType">دستگاه اجرایی</label>
                <select id="organ" class="form-control" name="organ" required>
                    @foreach ($organs as $id => $organ)
                        <option value="{{ $id }}">{{ $organ }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="firstName">نام</label>
                <input id="firstName" class="form-control" type="text" name="first-name" required>
            </div>

            <div class="form-group">
                <label for="lastName">نام خانوادگی</label>
                <input id="lastName" class="form-control" type="text" name="last-name" required>
            </div>


            <div class="form-group">
                <label for="rolesGroup">نقش کاربری</label>
                    <div id="rolesGroup" class="form-check">
                        @foreach ($roles as $id => $role)
                            <input class="form-check-input" id={{ $id }} type="checkbox" name={{ $id }} value= {{ $id }}>
                            <label class="form-check-label" for={{ $id }}>{{ $role }}</label>
                        @endforeach
                    </div>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">ذخیره</button>
        </form>
    </div>
@endsection
