<h1 class="pb-2 border-bottom">
    @{{ pageTitle }}
    <span v-if="isEditMode">
        @{{ newCity.oldTitle }}
    </span>
</h1>

<nav class="nav">
    <li class="nav-item">
        <div v-if="savingSuccess" class="alert alert-success" role="alert">
            شهر @{{ newCity.title }} با موفقیت ثبت شد.
        </div>
        <a v-show="isListMode" class="nav-link active" href="#" @click.prevent="showCreateForm">
            ثبت شهر جدید
        </a>
    </li>
</nav>
