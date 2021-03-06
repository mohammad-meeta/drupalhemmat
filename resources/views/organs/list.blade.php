<h2 v-if="! hasRecord">
    اطلاعاتی وجود ندارد
</h2>

<table class="pp-striped-table" v-if="hasRecord">
    <thead>
        <tr>
            <th>عنوان</th>
            <th>شهرستان</th>
            <th>عملکردها</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="organ in organs" :key="organ.id">
            <td>@{{ organ.title }}</td>
            <td>@{{ organ.city.title }}</td>
            <td>
                <a href="#" class="btn btn-primary" @click.prevent="showOrganization(organ)">
                    مشاهده
                </a>

                <a href="#" class="btn btn-primary" @click.prevent="showEditForm(organ)">
                    ویرایش
                </a>
            </td>
        </tr>
    </tbody>
</table>
