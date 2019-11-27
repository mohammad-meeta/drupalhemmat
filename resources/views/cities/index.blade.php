@extends ('layouts.app')

@section ('content')
    <div class="container">
        <h1 class="pb-2 border-bottom">شهرها</h1>
        @foreach($cities as $city)
            <div class="row">
                <a href=" {{ route('city.show', $city->id) }}">
                    {{ $city->title }}
                </a>
                <a class="mr-2" href=" {{ route('city.edit', $city->id) }}">
                    ویرایش
                </a>
            </div>
        @endforeach
    </div>

@endsection
