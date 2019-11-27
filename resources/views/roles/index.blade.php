@extends ('layouts.app')

@section ('content')
    <div class="container">
        <h1 class="pb-2 border-bottom">نقش های کاربری</h1>
        <table class="table striped-table">
            <thead>
                <tr>
                    <th>نقش کاربری</th>
                </tr>
            </thead>
        @foreach($roles as $role)
            <tr>
                <td>
                    <a href=" {{ route('role.show', $role->id) }}">
                        {{ $role->title }}
                    </a>
                </td>
            </tr>
        @endforeach
        </table>
    </div>

@endsection
