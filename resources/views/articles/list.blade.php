<h2 v-if="! hasRecord">
    اطلاعاتی وجود ندارد
</h2>

<table class="pp-striped-table" v-if="hasRecord">
    <thead>
        <tr>
            <th>عنوان</th>
            <th>نوع مطلب</th>
            <th>عملکردها</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="article in articles" :key="article.id">
            <td>@{{ article.title }}</td>
            <td>@{{ article }}</td>
            <td>
                <a href="#" class="btn btn-primary" @click.prevent="showarticle(article)">
                    مشاهده
                </a>

                <a href="#" class="btn btn-primary" @click.prevent="showEditForm(article)">
                    ویرایش
                </a>
            </td>
        </tr>
    </tbody>
</table>

