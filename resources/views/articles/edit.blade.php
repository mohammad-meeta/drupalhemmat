@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="pb-2 border-bottom">ویرایش مطلب {{ $article->title }}</h1>
        <form method="POST" action="{{ route('article.update', $article->id) }}">
            @csrf
            @method('PATCH')
                <div class="form-group">
                    <label for="my-input">عنوان</label>
                    <input
                    id="title"
                    class="form-control"
                    type="text"
                    name="title"
                    value="{{ $article->title }}">
                </div>

                <div class="form-group">
                    <label for="articleType">نوع مطلب</label>
                    <select id="type" class="form-control" name="type" required>
                        @foreach ($articleTypes as $id => $type)
                            <option <?php if($article->type_id == $id){ echo "selected";} ?> value="{{ $id }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="body">توضیحات</label>
                <textarea id="editor" name="body" class="form-control cke_rtl" rows="3" required>{{ $article->body }}</textarea>
                </div>
            <button type="submit" class="btn btn-primary">ویرایش</button>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">حذف</button>
        </form>

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">حذف {{$article->title}}</h4>
            </div>
            <div class="modal-body">
                آیا از حذف مطمئن هستید؟
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">لغو</button>
                <form action="{{ route('article.destroy', $article->id)}}" method="post">
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

@section('scripts')

    <script defer src="{{ mix('js/pages/articles/edit.js') }}"></script>
    <script src="../node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
    <script src="../node_modules/@ckeditor/ckeditor5-vue/dist/ckeditor.js"></script>

@endsection
