<form method="POST" action="/organ">
    @csrf

    <div class="form-group">
        <label for="my-input">عنوان</label>
        <input class="form-control" type="text" required v-model="newOrgan.title">
    </div>

    <div class="form-group">
        <label for="city">شهر</label>

        <select class="form-control" required v-model="newOrgan.city">
            <option v-for="city in cities" :key="city.id" :value="city.id">
                @{{ city.title }}
            </option>
        </select>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary" @click.prevent="saveNewOrgan">ذخیره</button>
        <button type="button" class="btn btn-danger" @click.prevent="hideCreateForm">لغو</button>
    </div>
</form>
