<form method="POST" action="/article-type">
    @csrf
    <div class="form-group">
        <label for="my-input">عنوان</label>
        <input class="form-control" type="text" required v-model="newArticleType.title">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary" @click.prevent="saveNewArticleType">ذخیره</button>
        <button type="button" class="btn btn-danger" @click.prevent="hideCreateForm">لغو</button>
    </div>

</form>
