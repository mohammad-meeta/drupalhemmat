<h2 v-if="! hasRecord">
    NO DATA
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
                <a href="#" class="btn btn-primary" @click.prevent="showOrganization(organ)">مشاهده</a>
            </td>
        </tr>
    </tbody>
</table>
