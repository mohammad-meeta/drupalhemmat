<h1 class="pb-2 border-bottom">
    @{{ pageTitle }}
    <span v-if="isEditMode">
        @{{ newProvince.oldTitle }}
    </span>
</h1>

<nav class="nav">
    <li class="nav-item">
        <div v-if="savingSuccess" class="alert alert-success" role="alert">
           استان @{{ newProvince.title }} با موفقیت ثبت شد.
        </div>
        <a v-show="isListMode" class="nav-link active" href="#" @click.prevent="showCreateForm">
            ثبت استان جدید
        </a>
    </li>
</nav>
