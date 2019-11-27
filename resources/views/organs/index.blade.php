@extends ('layouts.app')

@section ('content')
    <div class="container">
        <h1 class="pb-2 border-bottom">دستگاه‌های اجرایی</h1>
        <table class="table striped-table bordered-table">
            <thead>
                <tr>
                    <th>عنوان</th>
                    <th>شهرستان</th>
                    <th>عملکردها</th>
                </tr>
            </thead>
        @foreach($organs as $organ)
            <tr>
                <td>
                    <a href=" {{ route('organ.show', $organ->id) }}">
                        {{ $organ->title }}
                    </a>
                </td>

                <td>
                        {{ $organ->city->title }}
                </td>

                <td>
                    <a class="mr-2" href=" {{ route('organ.edit', $organ->id) }}">
                        ویرایش
                    </a>
                </td>
            </tr>
        @endforeach
        </table>
    </div>

@endsection
