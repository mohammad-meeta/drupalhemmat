<div class="container">
    <form method="POST" action="/city">
        @csrf
        <div class="form-group">
            <label for="my-input">عنوان</label>
            <input class="form-control" type="text" required v-model="newCity.title">
        </div>
        <button type="submit" class="btn btn-primary" @click.prevent="saveNewCity">ذخیره</button>
        <button type="button" class="btn btn-danger" @click.prevent="hideCreateForm">لغو</button>
    </form>
</div>
