@extends ('layouts.app')

@section ('content')
    <div class="container">
        <h1 class="pb-2 border-bottom">کاربران</h1>
        <table class="table striped-table">
            <thead>
                <tr>
                    <th>نام کاربری</th>
                    <th>زمان ایجاد</th>
                </tr>
            </thead>
        @foreach($users as $user)
            <tr>
                <td>
                    <a href=" {{ route('user.show', $user->id) }}">
                        {{ $user->name }}
                    </a>
                </td>
                <td>
                    {{ $user->created_at }}
                </td>
            </tr>
        @endforeach
        </table>
    </div>

@endsection
