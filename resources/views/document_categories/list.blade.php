<h2 v-if="! hasRecord">
    دسته بندی اسنادی وجود ندارد
</h2>
<table class="pp-striped-table" v-if="hasRecord">
    <thead>
        <tr>
            <th>دسته بندی</th>
            <th>عملکردها</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="documentCategory in documentCategories" :key="documentCategory.id">
            <td>@{{ documentCategory.title }}</td>
            <td>
                <a href="#" class="btn btn-primary" @click.prevent="showDocumentCategory(documentCategory)">مشاهده</a>
                <a href="#" class="btn btn-primary" @click.prevent="showEditForm(documentCategory)">ویرایش</a>
            </td>
        </tr>
    </tbody>
</table>
