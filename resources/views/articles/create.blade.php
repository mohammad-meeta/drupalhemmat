<form method="POST" action="/article">
    @csrf

    <div class="form-group">
        <label for="my-input">عنوان</label>
        <input class="form-control" type="text" required v-model="newArticle.title">
    </div>

    <div class="form-group">
        <label for="articleType">نوع مطلب</label>
        <select class="form-control" required v-model="newArticle.articleType">
            <option v-for="articleType in articleTypes" :key="articleType.id" :value="articleType.id">
                @{{ articleType.title }}
            </option>
        </select>
    </div>

    <div class="form-group">
        <label for="body">توضیحات</label>
        <textarea id="editor" class="form-control cke_rtl" rows="3" required v-model="newArticle.body"></textarea>
    </div>

        <div class="form-group">
        <button type="submit" class="btn btn-primary" @click.prevent="saveNewArticle">ذخیره</button>
        <button type="button" class="btn btn-danger" @click.prevent="hideCreateForm">لغو</button>
    </div>
</form>

