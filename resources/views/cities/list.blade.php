<h2 v-if="! hasRecord">
    شهری وجود ندارد
</h2>
<table class="pp-striped-table" v-if="hasRecord">
    <thead>
        <tr>
            <th>نام شهر</th>
            <th>عملکردها</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="city in cities" :key="city.id">
            <td>@{{ city.title }}</td>
            <td>
                <a href="#" class="btn btn-primary" @click.prevent="showCity(city)">مشاهده</a>
                <a href="#" class="btn btn-primary" @click.prevent="showEditForm(city)">ویرایش</a>
            </td>
        </tr>
    </tbody>
</table>
