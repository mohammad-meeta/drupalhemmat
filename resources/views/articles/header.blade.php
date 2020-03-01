<h1 class="pb-2 border-bottom">
    @{{ pageTitle }}
</h1>

<nav class="nav">
    <li class="nav-item">
        <div v-if="savingSuccess" class="alert alert-success" role="alert">
            مطلب @{{ newArticle.title }} با موفقیت ثبت شد.
        </div>
        <a v-show="isListMode" class="nav-link active" href="#" @click.prevent="showCreateForm(null)">
            ثبت مطلب جدید
        </a>
    </li>
</nav>
