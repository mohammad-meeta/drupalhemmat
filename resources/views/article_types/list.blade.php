<h2 v-if="! hasRecord">
    نوع مطلبی وجود ندارد
</h2>
<table class="pp-striped-table" v-if="hasRecord">
    <thead>
        <tr>
            <th>نوع مطلب</th>
            <th>عملکردها</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="articleType in articleTypes" :key="articleType.id">
            <td>@{{ articleType.title }}</td>
            <td>
                <a href="#" class="btn btn-primary" @click.prevent="showArticleType(articleType)">مشاهده</a>
                <a href="#" class="btn btn-primary" @click.prevent="showEditForm(articleType)">ویرایش</a>
            </td>
        </tr>
    </tbody>
</table>
