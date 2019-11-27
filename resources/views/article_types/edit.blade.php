@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="pb-2 border-bottom">ویرایش نوع مطلب {{ $articleType->title }}</h1>
        <form method="POST" action="{{ route('article-type.update', $articleType->id) }}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="my-input">عنوان</label>
                <input
                    id="title"
                    class="form-control"
                    type="text"
                    name="title"
                    value="{{ $articleType->title }}">
            </div>
            <button type="submit" class="btn btn-primary">ویرایش</button>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">حذف</button>
        </form>

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">حذف {{$articleType->title}}</h4>
            </div>
            <div class="modal-body">
                آیا از حذف مطمئن هستید؟
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">لغو</button>
                <form action="{{ route('article-type.destroy', $articleType->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">حذف</button>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection
